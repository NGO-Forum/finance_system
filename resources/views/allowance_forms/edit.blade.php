@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-slate-100 text-slate-800 antialiased" x-data="allowanceMatrix()">
        <div class="max-w-full mx-auto bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">

            <!-- Header Sheet Meta -->
            <div class="bg-green-700 px-6 py-4 text-white flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-bold tracking-tight">ALLOWANCE FOR PARTICIPANTS</h1>
                    <p class="text-xs text-slate-200 mt-0.5">Matrix Entry Form matching Sheet FM02-07</p>
                </div>
            </div>

            <!-- Validation Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6 text-xs text-red-700 rounded shadow-xs">
                    <p class="font-bold mb-2">Please correct the following errors:</p>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Main Form Wrapper enclosing all buttons and summary parameters -->
            <form id="matrix-form" action="{{ route('allowance-forms.update', $allowanceForm) }}" method="POST"
                class="p-6">

                @csrf
                @method('PUT')

                <template x-for="(day, index) in dates" :key="'date-' + index">
                    <input type="hidden" :name="`dates[${index}]`" :value="day">
                </template>

                <!-- Section 1: Top Metadata Grid -->
                <div
                    class="grid grid-cols-1 md:grid-cols-6 gap-4 bg-slate-50 p-5 rounded-xl border border-slate-200/80 mb-6 text-sm shadow-xs">
                    <div class="col-span-5">
                        <label class="block font-bold text-slate-600 mb-2 tracking-wide uppercase text-sm">For Activity
                            *</label>
                        <input type="text" name="activity" value="{{ old('activity', $allowanceForm->activity) }}"
                            class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 transition focus:border-green-700 focus:ring-1 focus:ring-green-700 text-slate-800 shadow-xs"
                            placeholder="Activity description..." required>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-600 mb-2 tracking-wide uppercase text-sm">
                            Program
                            <span class="text-red-500">*</span>
                        </label>

                        <select name="program"
                            class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 transition focus:border-green-700 focus:ring-1 focus:ring-green-700 text-slate-800 shadow-xs"
                            required>

                            <option value="">Select Program</option>

                            <option value="RITI"
                                {{ old('program', $allowanceForm->program) == 'RITI' ? 'selected' : '' }}>
                                RITI
                            </option>

                            <option value="SACHAS"
                                {{ old('program', $allowanceForm->program) == 'SACHAS' ? 'selected' : '' }}>
                                SACHAS
                            </option>

                            <option value="MACOR"
                                {{ old('program', $allowanceForm->program) == 'MACOR' ? 'selected' : '' }}>
                                MACOR
                            </option>

                            <option value="PALI"
                                {{ old('program', $allowanceForm->program) == 'PALI' ? 'selected' : '' }}>
                                PALI
                            </option>

                        </select>

                        @error('program')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-bold text-slate-600 mb-2 tracking-wide uppercase text-sm">Place of
                            Conduct</label>
                        <input type="text" name="venue" value="{{ old('venue', $allowanceForm->venue) }}"
                            class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 transition focus:border-green-700 focus:ring-1 focus:ring-green-700 text-slate-800 shadow-xs"
                            placeholder="Location...">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-600 mb-2 tracking-wide uppercase text-sm">Budget
                            Line/Code</label>
                        <input type="text" name="budget_code"
                            value="{{ old('budget_code', $allowanceForm->budget_code) }}"
                            class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 transition focus:border-green-700 focus:ring-1 focus:ring-green-700 text-slate-800 shadow-xs"
                            placeholder="e.g., 51-11-01-3">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-600 mb-2 tracking-wide uppercase text-sm">Donor</label>
                        <input type="text" name="donor" value="{{ old('donor', $allowanceForm->donor) }}"
                            class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 transition focus:border-green-700 focus:ring-1 focus:ring-green-700 text-slate-800 shadow-xs"
                            placeholder="Donor entity...">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-600 mb-2 tracking-wide uppercase text-sm">Donor
                            Code</label>
                        <input type="text" name="donor_code" value="{{ old('donor_code', $allowanceForm->donor_code) }}"
                            class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 transition focus:border-green-700 focus:ring-1 focus:ring-green-700 text-slate-800 shadow-xs"
                            placeholder="Donor code entity...">
                    </div>
                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-bold uppercase tracking-wide text-slate-600">
                            start Date <span class="text-red-500">*</span>
                        </label>

                        <input type="date" id="start_date" name="start_date"
                            value="{{ old('start_date', $allowanceForm->start_date) }}"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm transition
                            focus:border-green-700 focus:ring-2 focus:ring-green-700/20 required">

                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-bold uppercase tracking-wide text-slate-600">
                            end Date <span class="text-red-500">*</span>
                        </label>

                        <input type="date" id="end_date" name="end_date"
                            value="{{ old('end_date', $allowanceForm->end_date) }}"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 shadow-sm transition
                            focus:border-green-700 focus:ring-2 focus:ring-green-700/20 required">

                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white shadow-sm col-span-6">

                        <div class="border-b px-6 py-5">
                            <h2 class="text-lg font-semibold text-green-700">
                                Choose Donor Logo(s)
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Select one or more donor logos for this allowance form.
                            </p>
                        </div>

                        <div class="p-4">

                            <div class="flex items-center gap-12 flex-wrap">

                                @foreach ($donorLogos as $donor)
                                    <label
                                        class="flex items-center gap-4 cursor-pointer rounded-lg p-3 hover:bg-green-50 transition">

                                        <input type="checkbox" name="donor_logo_ids[]" value="{{ $donor->id }}"
                                            class="h-6 w-6 rounded border-gray-300 text-green-600 focus:ring-green-500"
                                            @checked(in_array($donor->id, $selectedDonors))>

                                        <span class="text-lg font-medium text-gray-700">
                                            {{ $donor->name }}
                                        </span>

                                    </label>
                                @endforeach

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Dynamic Controls Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-green-700 tracking-tight">Participant Matrix Records</h2>
                    <div class="flex gap-2">
                        <button type="button" @click="addParticipant"
                            class="bg-green-600 text-white hover:bg-green-700 px-3 py-1.5 text-sm font-semibold rounded-lg shadow-xs flex items-center gap-1 transition">
                            <span class="text-white font-bold">+</span> Add Participant
                        </button>
                    </div>
                </div>

                <!-- Section 2: Matrix Table Grid -->
                <div class="overflow-x-auto border border-slate-200 rounded-xl bg-white shadow-xs">
                    <table class="w-full text-xs text-left border-collapse min-w-[1250px]">
                        <thead>
                            <tr
                                class="bg-slate-100 border-b border-slate-300 text-slate-700 font-bold text-[12px] uppercase tracking-wider">
                                <th class="p-2.5 border-r border-slate-300 w-[2%] text-center">No</th>
                                <th class="p-2.5 border-r border-slate-300 w-[18%]">Name (Position & organization)</th>
                                <th class="p-2.5 border-r border-slate-300 w-[6%] text-center">Sex</th>
                                <th class="p-2.5 border-r border-slate-300 text-center w-[20%]">Village, Commune, District,
                                    Province (be specific)</th>
                                <th class="p-2.5 border-r border-slate-300 w-[10%] bg-slate-50 text-slate-500">Allowance
                                    Type</th>

                                <!-- Dynamic Date Headings -->
                                <template x-for="(day, dIdx) in dates" :key="dIdx">
                                    <th class="w-16 min-w-[48px] border-r border-slate-300 bg-slate-50/80 p-1 text-center">

                                        <div class="text-[8px] font-bold uppercase tracking-wide text-slate-400">
                                            <span x-text="`D${dIdx + 1}`"></span>
                                        </div>

                                        <div class="mt-1 text-[10px] font-semibold text-slate-700 leading-tight"
                                            x-text="formatDate(day)">
                                        </div>

                                    </th>
                                </template>

                                <th class="p-2.5 border-r border-slate-300 w-24 text-right bg-slate-100/80">Total</th>
                                <th class="p-2.5 w-32 text-center bg-slate-200/50">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <template x-for="(p, pIdx) in participants" :key="pIdx">
                                <tr class="border-b-2 border-slate-300 group hover:bg-slate-50/40 transition">

                                    <!-- Index Counter -->
                                    <td class="p-2 border-r border-slate-200 text-center font-bold align-middle bg-slate-50/50 text-slate-500"
                                        x-text="pIdx + 1"></td>

                                    <!-- Identity Details -->
                                    <td class="p-2 border-r border-slate-200 align-middle space-y-1.5">
                                        <input type="text" :name="`participants[${pIdx}][name]`" x-model="p.name"
                                            class="w-full bg-white border border-slate-300 rounded-md px-2 py-1.5 text-[12px] font-semibold text-slate-900 transition focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-xs"
                                            placeholder="Full Name" required>

                                        <input type="text" :name="`participants[${pIdx}][organization]`"
                                            x-model="p.organization"
                                            class="w-full bg-slate-50/50 border border-slate-200 text-slate-600 rounded-md px-2 py-1 text-[12px] transition focus:bg-white focus:border-green-700 focus:ring-1 focus:ring-green-700"
                                            placeholder="Organization">

                                        <input type="text" :name="`participants[${pIdx}][position]`"
                                            x-model="p.position"
                                            class="w-full bg-slate-50/50 border border-slate-200 text-slate-600 rounded-md px-2 py-1 text-[12px] transition focus:bg-white focus:border-green-700 focus:ring-1 focus:ring-green-700"
                                            placeholder="Position / Role">
                                    </td>

                                    <!-- Gender Dropdown -->
                                    <td class="p-2 border-r border-slate-200 align-middle">
                                        <select :name="`participants[${pIdx}][gender]`" x-model="p.gender"
                                            class="w-full bg-white border border-slate-300 rounded-md p-1 text-xs text-center font-medium transition focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-xs">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                    </td>

                                    <!-- Address / Distance Details -->
                                    <td class="p-2 border-r border-slate-200 align-middle space-y-1.5">
                                        <input type="text" :name="`participants[${pIdx}][province]`"
                                            x-model="p.province"
                                            class="w-full bg-white border border-slate-300 rounded-md px-2 py-1.5 text-[12px] transition focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-xs"
                                            placeholder="Province/Commune">

                                        <div class="flex items-center gap-1">
                                            <span class="text-[12px] text-slate-400 font-bold uppercase w-20">Dist
                                                (km)</span>
                                            <input type="number" step="0.1"
                                                :name="`participants[${pIdx}][distance]`" x-model.number="p.distance"
                                                class="w-full bg-slate-50/50 border border-slate-200 text-slate-600 rounded-md px-2 py-1 text-[11px] transition focus:bg-white focus:border-green-700 focus:ring-1 focus:ring-green-700">
                                        </div>

                                        <input type="text" :name="`participants[${pIdx}][remarks]`"
                                            x-model="p.remarks"
                                            class="w-full bg-slate-50/50 border border-slate-200 text-slate-500 rounded-md px-2 py-1 text-[12px] transition focus:bg-white focus:border-green-700 focus:ring-1 focus:ring-green-700"
                                            placeholder="Remarks/Notes">
                                    </td>

                                    <!-- Allowance Label Pane -->
                                    <td
                                        class="p-0 border-r border-slate-300 bg-slate-50 align-middle divide-y divide-slate-200 font-semibold text-slate-500 text-[11px] uppercase tracking-wider">
                                        <div class="px-2 py-1.5">Breakfast</div>
                                        <div class="px-2 py-1.5">Lunch</div>
                                        <div class="px-2 py-1.5">Dinner</div>
                                        <div class="px-2 py-1.5">Acc.</div>
                                        <div class="px-2 py-1.5">Taxi/Bus</div>
                                        <div class="px-2 py-1.5">L. Transport</div>
                                    </td>

                                    <!-- Dynamic Inputs Grid Matrix -->
                                    <td class="p-0 border-r border-slate-300 align-middle text-center"
                                        :colspan="dates.length">
                                        <div class="grid grid-cols-1 divide-y divide-slate-200">
                                            <template
                                                x-for="type in ['breakfast', 'lunch', 'dinner', 'accommodation', 'taxi', 'local_transport']">
                                                <div class="flex divide-x divide-slate-200">
                                                    <template x-for="(day, dIdx) in dates" :key="dIdx">
                                                        <input type="number" step="0.01"
                                                            :name="`participants[${pIdx}][costs][${dIdx}][${type}]`"
                                                            x-model.number="p.costs[dIdx][type]"
                                                            @focus="$el.value == 0 ? $el.value = '' : null"
                                                            @blur="$el.value == '' ? $el.value = 0 : null"
                                                            class="w-full bg-transparent border-0 text-center text-xs px-1 py-1.5 font-medium
                                                                    focus:ring-1 focus:ring-green-700 focus:bg-green-50/40"
                                                            placeholder="-">
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </td>

                                    <!-- Category Total Breakdowns -->
                                    <td
                                        class="p-0 border-r border-slate-300 bg-slate-50/50 text-right font-bold text-slate-700 align-middle divide-y divide-slate-200 tracking-tight pr-3">
                                        <div class="py-1.5"
                                            x-text="sumCategory(p, 'breakfast') > 0 ? `$${sumCategory(p, 'breakfast').toFixed(2)}` : '-'">
                                        </div>
                                        <div class="py-1.5"
                                            x-text="sumCategory(p, 'lunch') > 0 ? `$${sumCategory(p, 'lunch').toFixed(2)}` : '-'">
                                        </div>
                                        <div class="py-1.5"
                                            x-text="sumCategory(p, 'dinner') > 0 ? `$${sumCategory(p, 'dinner').toFixed(2)}` : '-'">
                                        </div>
                                        <div class="py-1.5"
                                            x-text="sumCategory(p, 'accommodation') > 0 ? `$${sumCategory(p, 'accommodation').toFixed(2)}` : '-'">
                                        </div>
                                        <div class="py-1.5"
                                            x-text="sumCategory(p, 'taxi') > 0 ? `$${sumCategory(p, 'taxi').toFixed(2)}` : '-'">
                                        </div>
                                        <div class="py-1.5"
                                            x-text="sumCategory(p, 'local_transport') > 0 ? `$${sumCategory(p, 'local_transport').toFixed(2)}` : '-'">
                                        </div>
                                    </td>

                                    <!-- Form Array Hooks Linked to Controller Variables -->
                                    <td
                                        class="p-3 bg-slate-100/60 text-center align-middle font-bold text-slate-900 border-l border-slate-200 relative">
                                        <div class="text-sm uppercase text-slate-400 tracking-wider font-bold">Total</div>
                                        <div class="text-sm tracking-tight text-slate-900 font-black mt-0.5"
                                            x-text="`$${calculateParticipantTotal(p).toFixed(2)}`"></div>

                                        <!-- Hidden Inputs Sent Directly inside $request->participants array -->
                                        <input type="hidden" :name="`participants[${pIdx}][breakfast]`"
                                            :value="sumCategory(p, 'breakfast')">
                                        <input type="hidden" :name="`participants[${pIdx}][lunch]`"
                                            :value="sumCategory(p, 'lunch')">
                                        <input type="hidden" :name="`participants[${pIdx}][dinner]`"
                                            :value="sumCategory(p, 'dinner')">
                                        <input type="hidden" :name="`participants[${pIdx}][accommodation]`"
                                            :value="sumCategory(p, 'accommodation')">
                                        <input type="hidden" :name="`participants[${pIdx}][taxi]`"
                                            :value="sumCategory(p, 'taxi')">
                                        <input type="hidden" :name="`participants[${pIdx}][local_transport]`"
                                            :value="sumCategory(p, 'local_transport')">
                                        <input type="hidden" :name="`participants[${pIdx}][other]`"
                                            :value="0">
                                        <input type="hidden" :name="`participants[${pIdx}][total]`"
                                            :value="calculateParticipantTotal(p)">

                                        <div class="mt-4 pt-2 border-t border-dashed border-slate-300">
                                            <button type="button" @click="removeParticipant(pIdx)"
                                                class="text-[12px] font-bold uppercase tracking-wider text-red-600 hover:text-white hover:bg-red-600 transition bg-white border border-red-200 px-2 py-1 rounded shadow-xs">
                                                Remove
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Bottom Summary Aggregations Display -->
                <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-5 items-stretch">
                    <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Food Expense Card -->
                        <div
                            class="p-4 bg-slate-50 border border-slate-200/80 rounded-xl flex flex-col justify-between shadow-xs shadow-md">
                            <div>
                                <span class="block font-bold text-slate-400 uppercase tracking-wider text-[11px]">Food
                                    Expenses</span>
                                <span class="block text-xs text-slate-500 mt-0.5 font-medium">(Breakfast + Lunch +
                                    Dinner)</span>
                            </div>
                            <div class="mt-4 flex items-baseline gap-1 text-slate-900 font-black text-xl tracking-tight">
                                <span x-text="`$${grandFoodTotal().toFixed(2)}`"></span>
                            </div>
                        </div>

                        <!-- Accommodation Card -->
                        <div
                            class="p-4 bg-slate-50 border border-slate-200/80 rounded-xl flex flex-col justify-between shadow-xs shadow-md">
                            <div>
                                <span
                                    class="block font-bold text-slate-400 uppercase tracking-wider text-[11px]">Accommodation</span>
                                <span class="block text-xs text-slate-500 mt-0.5 font-medium">(Lodging Metric)</span>
                            </div>
                            <div class="mt-4 flex items-baseline gap-1 text-slate-900 font-black text-xl tracking-tight">
                                <span x-text="`$${grandCategoryTotal('accommodation').toFixed(2)}`"></span>
                            </div>
                        </div>

                        <!-- Transport Logistics Card -->
                        <div
                            class="p-4 bg-slate-50 border border-slate-200/80 rounded-xl flex flex-col justify-between shadow-xs shadow-md">
                            <div>
                                <span class="block font-bold text-slate-400 uppercase tracking-wider text-[11px]">Transport
                                    Logistics</span>
                                <span class="block text-xs text-slate-500 mt-0.5 font-medium">(Taxi & Local Transit)</span>
                            </div>
                            <div class="mt-4 flex items-baseline gap-1 text-slate-900 font-black text-xl tracking-tight">
                                <span
                                    x-text="`$${(grandCategoryTotal('taxi') + grandCategoryTotal('local_transport')).toFixed(2)}`"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Master Total Card Panel -->
                    <div
                        class="bg-green-600 text-white border border-green-600 rounded-xl p-5 shadow-sm flex items-center justify-between">
                        <div class="space-y-0.5">
                            <h4 class="text-[11px] font-bold uppercase tracking-widest text-white">Grand Total
                                Aggregate</h4>
                            <p class="text-xs text-slate-200 font-medium">Real-time form computations</p>
                        </div>
                        <div class="text-3xl font-black text-white tracking-tight drop-shadow-xs"
                            x-text="`$${grandFormTotal().toFixed(2)}`"></div>
                    </div>
                </div>

                <!-- Footer Action Buttons (Now safely enclosed inside form block) -->
                <div class="flex mt-8 items-center gap-3 justify-end border-t border-slate-100 pt-4">
                    <a href="{{ route('allowance-forms.index') }}"
                        class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-bold tracking-wide uppercase bg-amber-500 hover:bg-amber-600 border border-slate-300 hover:border-slate-400 text-white rounded-lg shadow-xs transition select-none">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold tracking-wide uppercase bg-green-600 hover:bg-green-500 text-white rounded-lg shadow-sm hover:shadow-md transition cursor-pointer select-none">
                        Update Sheet Data
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Alpine.js Matrix Control Handler -->
    <script>
        function allowanceMatrix() {

            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            return {

                dates: @json(old('dates', $allowanceForm->dates ?? [])),
                participants: @json($participants ?? []),

                init() {

                    // Generate dates from Start & End Date
                    this.generateDates();

                    // Create one participant if empty
                    if (this.participants.length === 0) {
                        this.addParticipant();
                    }

                    // Ensure every participant has enough cost objects
                    this.participants.forEach(p => {

                        if (!Array.isArray(p.costs)) {
                            p.costs = [];
                        }

                        while (p.costs.length < this.dates.length) {
                            p.costs.push(this.emptyCost());
                        }

                        while (p.costs.length > this.dates.length) {
                            p.costs.pop();
                        }

                    });

                    startDateInput?.addEventListener('change', () => {
                        this.generateDates();
                    });

                    endDateInput?.addEventListener('change', () => {
                        this.generateDates();
                    });

                },

                generateDates() {

                    if (!startDateInput?.value || !endDateInput?.value) {
                        return;
                    }

                    const newDates = [];

                    let current = new Date(startDateInput.value);
                    const end = new Date(endDateInput.value);

                    while (current <= end) {
                        newDates.push(current.toISOString().split('T')[0]);
                        current.setDate(current.getDate() + 1);
                    }

                    this.dates = newDates;

                    this.participants.forEach(p => {

                        if (!Array.isArray(p.costs)) {
                            p.costs = [];
                        }

                        while (p.costs.length < this.dates.length) {
                            p.costs.push(this.emptyCost());
                        }

                        while (p.costs.length > this.dates.length) {
                            p.costs.pop();
                        }

                    });

                },

                formatDate(date) {

                    if (!date) return '';

                    return new Date(date).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short'
                    });

                },

                emptyCost() {

                    return {
                        breakfast: 0,
                        lunch: 0,
                        dinner: 0,
                        accommodation: 0,
                        taxi: 0,
                        local_transport: 0
                    };

                },

                emptyParticipant(costMatrix) {

                    return {
                        name: '',
                        organization: '',
                        position: '',
                        gender: 'M',
                        province: '',
                        distance: 0,
                        remarks: '',
                        costs: costMatrix
                    };

                },

                addParticipant() {

                    const costMatrix = [];

                    this.dates.forEach(() => {
                        costMatrix.push(this.emptyCost());
                    });

                    this.participants.push(this.emptyParticipant(costMatrix));

                },

                removeParticipant(index) {

                    if (this.participants.length <= 1) {

                        Swal.fire({
                            icon: 'warning',
                            title: 'Cannot Remove',
                            text: 'At least one participant is required.'
                        });

                        return;
                    }

                    this.participants.splice(index, 1);

                },

                sumCategory(p, category) {

                    return p.costs.reduce((sum, day) => {
                        return sum + (parseFloat(day[category]) || 0);
                    }, 0);

                },

                calculateParticipantTotal(p) {

                    return [
                        'breakfast',
                        'lunch',
                        'dinner',
                        'accommodation',
                        'taxi',
                        'local_transport'
                    ].reduce((sum, category) => {
                        return sum + this.sumCategory(p, category);
                    }, 0);

                },

                grandCategoryTotal(category) {

                    return this.participants.reduce((sum, p) => {
                        return sum + this.sumCategory(p, category);
                    }, 0);

                },

                grandFoodTotal() {

                    return this.grandCategoryTotal('breakfast') +
                        this.grandCategoryTotal('lunch') +
                        this.grandCategoryTotal('dinner');

                },

                grandFormTotal() {

                    return this.participants.reduce((sum, p) => {
                        return sum + this.calculateParticipantTotal(p);
                    }, 0);

                }

            };

        }
    </script>
@endsection
