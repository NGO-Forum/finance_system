@extends('layout.app')


@section('content')

    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div
            class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 bg-gradient-to-r from-green-600 to-emerald-500 rounded-2xl shadow-lg p-6 text-white">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-6h13M9 5h13M3 5h.01M3 11h.01M3 17h.01" />

                    </svg>

                </div>

                <div>

                    <h1 class="text-3xl font-bold">

                        Create DSA Claim

                    </h1>

                    <p class="text-green-100 mt-1">

                        Daily Subsistence Allowance Claim Form

                    </p>

                </div>

            </div>

        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mt-6 bg-red-100 border border-red-300 rounded-xl p-4">

                <h2 class="font-semibold text-red-700 mb-2">

                    Please fix the following errors:

                </h2>

                <ul class="list-disc list-inside text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <form action="{{ route('dsa-claims.store') }}" method="POST">

            @csrf

            {{-- Claim Information --}}
            <div class="mt-4 bg-white rounded-2xl shadow-lg border border-gray-100">

                <div class="px-6 py-4 border-b bg-green-600 rounded-t-2xl">

                    <h2 class="text-lg font-semibold text-white">

                        DSA Claim Information

                    </h2>

                </div>

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">

                        {{-- Claim No --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">

                                DSA Claim No

                            </label>

                            <input type="text" value="{{ $claimNo }}" readonly
                                class="w-full rounded-xl border-gray-300 bg-gray-100 focus:ring-green-500 focus:border-green-500">

                        </div>

                        {{-- Request Date --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">

                                Request Date <span class="text-red-500">*</span>

                            </label>

                            <input type="date" name="date_requested" value="{{ old('date_requested', date('Y-m-d')) }}"
                                class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500"
                                required>

                        </div>

                        {{-- Department --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">

                                Department <span class="text-red-500">*</span>

                            </label>

                            <select name="department_id"
                                class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500"
                                required>

                                <option value="">

                                    Select Department

                                </option>

                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>

                                        {{ $department->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        {{-- Budget Code --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">

                                Budget Code <span class="text-red-500">*</span>

                            </label>

                            <input type="text" name="budget_code" value="{{ old('budget_code') }}" required
                                class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        </div>

                        {{-- Donor --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">

                                Donor <span class="text-red-500">*</span>

                            </label>

                            <input type="text" name="donor" value="{{ old('donor') }}" required
                                class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        </div>

                        {{-- Donor Code --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">

                                Donor Code <span class="text-red-500">*</span>

                            </label>

                            <input type="text" name="donor_code" value="{{ old('donor_code') }}" required
                                class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        </div>

                    </div>

                    {{-- Purpose --}}
                    <div class="mt-6">

                        <label class="block text-sm font-medium text-gray-700 mb-2">

                            Purpose of Travel <span class="text-red-500">*</span>

                        </label>

                        <textarea name="purpose_of_travel" rows="4" required
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">{{ old('purpose_of_travel') }}</textarea>

                    </div>

                </div>

            </div>

            {{-- Travel Information --}}
            <div class="mt-4 bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">

                {{-- Header --}}
                <div
                    class="bg-gradient-to-r from-green-600 via-emerald-600 to-green-700 px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A2 2 0 013 15.382V5.618a2 2 0 011.553-1.959L9 2m0 18l6-2m-6 2V2m6 16l5.447 2.724A2 2 0 0021 18.382V8.618a2 2 0 00-1.553-1.959L15 6m0 12V6m-6-4l6 4" />

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-white">
                                Travel Information
                            </h2>

                            <p class="text-green-100 text-sm mt-1">
                                Record every trip related to this DSA claim.
                            </p>

                        </div>

                    </div>

                    <button type="button" onclick="addTravelRow()"
                        class="inline-flex items-center gap-2 bg-white text-green-700 hover:bg-green-50 font-semibold px-5 py-3 rounded-xl shadow transition duration-200">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        Add

                    </button>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-green-50">

                            <tr class="text-sm uppercase tracking-wider text-gray-700">

                                <th class="px-4 py-4 border text-center">
                                    #
                                </th>

                                <th class="px-4 py-4 border">
                                    Date
                                </th>

                                <th class="px-4 py-4 border">
                                    From
                                </th>

                                <th class="px-4 py-4 border">
                                    To
                                </th>

                                <th class="px-4 py-4 border">
                                    Dist (km)
                                </th>

                                <th class="px-4 py-4 border">
                                    Purpose
                                </th>

                                <th class="px-4 py-4 border">
                                    Leaving Time
                                </th>

                                <th class="px-4 py-4 border">
                                    Arriving Time
                                </th>

                                <th class="px-4 py-4 border text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody id="travelTable" class="divide-y divide-gray-100">

                            <tr class="hover:bg-green-50 transition">

                                <td class="border px-4 py-4 text-center font-semibold text-green-700 row-number">

                                    1

                                </td>

                                <td class="border px-4 py-4 w-20">

                                    <input type="date" name="travel_date[]"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="text" name="from_location[]" placeholder="Departure Location"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="text" name="to_location[]" placeholder="Destination"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">
                                    <input type="number" name="km[]" step="0.01" min="0" placeholder="KM"
                                        class="w-24 rounded-lg border border-slate-300
                                            px-3 py-2 text-sm
                                            focus:border-green-500
                                            focus:ring-4 focus:ring-green-100">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="text" name="purpose[]" placeholder="Meeting / Workshop / Training..."
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4 w-16">

                                    <input type="time" name="departure_time[]"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4 w-16">

                                    <input type="time" name="arrival_time[]"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4 text-center w-10">

                                    <button type="button" onclick="removeTravelRow(this)"
                                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />

                                        </svg>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Expense Claim --}}
            <div class="mt-4 bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">

                {{-- Header --}}
                <div
                    class="bg-gradient-to-r from-green-600 via-green-500 to-green-700 px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 14l2 2 4-4m5-2a9 9 0 11-18 0 9 9 0 0118 0z" />

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-white">

                                Expense Claim

                            </h2>

                            <p class="text-green-100 text-sm">

                                Enter your Daily Subsistence Allowance expenses.

                            </p>

                        </div>

                    </div>

                    <button type="button" onclick="addExpenseRow()"
                        class="inline-flex items-center gap-2 bg-white text-green-700 hover:bg-green-50 font-semibold px-5 py-3 rounded-xl shadow transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        Add

                    </button>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-green-50">

                            <tr class="text-xs uppercase tracking-wider text-gray-700">

                                <th class="border px-4 py-4 text-center">#</th>

                                <th class="border px-4 py-4">Date</th>

                                <th class="border px-4 py-4 text-center">Breakfast</th>

                                <th class="border px-4 py-4 text-center">Lunch</th>

                                <th class="border px-4 py-4 text-center">Dinner</th>

                                <th class="border px-4 py-4 text-center">Accommodation</th>

                                <th class="border px-4 py-4 text-center">Transport</th>

                                <th class="border px-4 py-4 text-center">Incident</th>

                                <th class="border px-4 py-4 text-center bg-green-100">Total</th>

                                <th class="border px-4 py-4 text-center">Action</th>

                            </tr>

                        </thead>

                        <tbody id="expenseTable" class="divide-y divide-gray-100">

                            <tr class="hover:bg-green-50 transition">

                                <td class="border px-4 py-4 text-center font-semibold text-green-700 expense-row">

                                    1

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="date" name="expense_date[]"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="number" step="0.01" value="0" name="breakfast[]"
                                        class="expense-input w-full rounded-lg border-gray-300 text-right focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="number" step="0.01" value="0" name="lunch[]"
                                        class="expense-input w-full rounded-lg border-gray-300 text-right focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="number" step="0.01" value="0" name="dinner[]"
                                        class="expense-input w-full rounded-lg border-gray-300 text-right focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="number" step="0.01" value="0" name="accommodation[]"
                                        class="expense-input w-full rounded-lg border-gray-300 text-right focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="number" step="0.01" value="0" name="transport[]"
                                        class="expense-input w-full rounded-lg border-gray-300 text-right focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4">

                                    <input type="number" step="0.01" value="0" name="incident[]"
                                        class="expense-input w-full rounded-lg border-gray-300 text-right focus:border-green-500 focus:ring-green-500">

                                </td>

                                <td class="border px-4 py-4 bg-green-50">

                                    <input type="text" readonly value="0.00" name="total[]"
                                        class="row-total w-full rounded-lg bg-green-100 border-green-300 text-right font-bold text-green-700">

                                </td>

                                <td class="border px-4 py-4 text-center">

                                    <button type="button" onclick="removeExpenseRow(this)"
                                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />

                                        </svg>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 border-t px-6 py-5">

                    <div class="flex justify-end">

                        <div class="w-full md:w-96">

                            <div
                                class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl text-white p-5 shadow-lg">

                                <div class="flex justify-between items-center">

                                    <div>

                                        <p class="text-sm text-green-100">

                                            Grand Total

                                        </p>

                                        <h3 class="text-3xl font-bold">

                                            $<span id="grandTotal">0.00</span>

                                        </h3>

                                    </div>

                                    <div class="text-5xl opacity-30">

                                        💰

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Additional Information --}}
            <div class="mt-4 bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">

                {{-- Header --}}
                <div class="bg-gradient-to-r from-green-700 via-green-600 to-green-800 px-6 py-5">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2m-1 0v14m-7-4h14" />

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-white">
                                Additional Information
                            </h2>

                            <p class="text-green-100 text-sm mt-1">
                                Add remarks or any important information related to this DSA claim.
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Body --}}
                <div class="p-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-3">

                        Notes / Remarks

                    </label>

                    <textarea name="note" rows="2" placeholder="Enter your note"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-300 transition resize-none">{{ old('note') }}</textarea>

                    <div class="mt-4 flex items-start gap-3 rounded-xl bg-green-50 border border-green-200 p-4">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />

                        </svg>

                        <div>

                            <h4 class="font-semibold text-green-800">

                                Information

                            </h4>

                            <p class="text-sm text-green-700 mt-1">

                                This field is optional. Include any additional explanations, supporting details, or comments
                                that will help reviewers understand your DSA claim.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="mt-4 bg-gradient-to-r from-green-600 to-emerald-500 rounded-2xl shadow-lg text-white">

                <div class="p-6">

                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-6">

                        <div>

                            <h2 class="text-2xl font-bold">

                                Total Claim Amount

                            </h2>

                            <p class="text-green-100 mt-1">

                                Automatically calculated from all expense items.

                            </p>

                        </div>

                        <div class="text-right w-40">

                            <div class="flex justify-between items-center">

                                <div>

                                    <p class="text-sm text-green-100">

                                        Grand Total

                                    </p>

                                    <h3 class="text-3xl font-bold">

                                        $<span id="grandTotal">0.00</span>

                                    </h3>

                                </div>

                                <div class="text-5xl opacity-30">

                                    💰

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Action Buttons --}}
            <div class="mt-4 bg-white rounded-2xl shadow-xl border border-gray-200">

                <div class="px-6 py-5 flex flex-col sm:flex-row justify-between items-center gap-4">

                    <div>

                        <h3 class="text-lg font-semibold text-gray-800">
                            Ready to Submit?
                        </h3>

                        <p class="text-sm text-gray-500">
                            Review your information before saving the DSA Claim.
                        </p>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        {{-- Cancel --}}
                        <a href="{{ route('dsa-claims.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold hover:bg-gray-100 hover:border-gray-400 transition duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 17l-5-5m0 0l5-5m-5 5h12" />

                            </svg>

                            Cancel

                        </a>

                        {{-- Save --}}
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold shadow-lg hover:shadow-xl transition duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />

                            </svg>

                            Save

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function() {

            Swal.fire({

                title: "Saving...",

                text: "Please wait.",

                allowOutsideClick: false,

                didOpen: () => {

                    Swal.showLoading();

                }

            });

        });

        function addTravelRow() {
            let tbody = document.getElementById('travelTable');

            let row = tbody.rows[0].cloneNode(true);

            row.querySelectorAll('input').forEach(function(input) {

                input.value = '';

            });

            tbody.appendChild(row);

            updateTravelNumber();
        }

        function removeTravelRow(button) {
            let tbody = document.getElementById('travelTable');

            if (tbody.rows.length === 1) {

                return;

            }

            button.closest('tr').remove();

            updateTravelNumber();
        }

        function updateTravelNumber() {
            document.querySelectorAll('#travelTable .row-number')
                .forEach(function(td, index) {

                    td.innerHTML = index + 1;

                });
        }

        function addExpenseRow() {
            let tbody = document.getElementById('expenseTable');

            let row = tbody.rows[0].cloneNode(true);

            row.querySelectorAll('input').forEach(function(input) {

                if (input.type == "number")
                    input.value = 0;

                else if (input.name == "total[]")
                    input.value = '0.00';

                else
                    input.value = '';

            });

            tbody.appendChild(row);

            updateExpenseRows();

            bindExpenseEvents();
        }

        function removeExpenseRow(button) {
            let tbody = document.getElementById('expenseTable');

            if (tbody.rows.length == 1)
                return;

            button.closest('tr').remove();

            updateExpenseRows();

            calculateGrandTotal();
        }

        function updateExpenseRows() {
            document.querySelectorAll('.expense-row')
                .forEach(function(td, index) {

                    td.innerHTML = index + 1;

                });
        }

        function bindExpenseEvents() {
            document.querySelectorAll('#expenseTable tr').forEach(function(row) {

                row.querySelectorAll('.expense-input').forEach(function(input) {

                    input.onkeyup = function() {

                        calculateRow(row);

                    };

                    input.onchange = function() {

                        calculateRow(row);

                    };

                });

            });
        }

        function calculateRow(row) {
            let total = 0;

            row.querySelectorAll('.expense-input').forEach(function(input) {

                total += parseFloat(input.value) || 0;

            });

            row.querySelector('.row-total').value = total.toFixed(2);

            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let grand = 0;

            document.querySelectorAll('.row-total').forEach(function(input) {

                grand += parseFloat(input.value) || 0;

            });

            document.getElementById('grandTotal').innerHTML = grand.toFixed(2);

            document.getElementById('grandTotalDisplay').innerHTML = grand.toFixed(2);

            document.getElementById('grand_total').value = grand.toFixed(2);
        }

        bindExpenseEvents();
    </script>

@endsection
