<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register for {{ $attendantList->title }}</title>

    <link rel="icon" href="/logo.png" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-emerald-700 via-green-600 to-lime-500 px-4 py-4">

    <div class="mx-auto max-w-3xl">
        <div class="overflow-hidden rounded-[28px] border border-white/30 bg-white/95 shadow-2xl backdrop-blur-sm">
            <div class="relative px-6 py-8 md:px-10 md:py-10">
                <div
                    class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(34,197,94,0.10),transparent_30%),radial-gradient(circle_at_bottom_left,rgba(16,185,129,0.10),transparent_28%)]">
                </div>

                <div class="relative">
                    <div class="mb-4 text-center">
                        <img src="/images/logo.png" alt="Logo" class="mx-auto mb-5 h-20 md:h-28" />

                        <div
                            class="inline-flex items-center rounded-full border border-green-200 bg-green-50 px-4 py-1.5 text-xs md:text-sm font-semibold text-green-700">
                            Event Registration
                        </div>

                        <h2 class="mt-4 text-base text-left font-semibold tracking-tight text-slate-700 md:text-lg">
                            Register for: <span
                                class="mt-2 ml-2 text-lg font-bold text-green-700 tracking-tight md:text-xl">
                                {{ $attendantList->title }}
                            </span>
                        </h2>

                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-sm">
                            <div class="mb-2 flex items-center gap-2 text-sm font-bold">
                                <span>⚠</span>
                                <span>Please fix the following errors:</span>
                            </div>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div
                            class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-center text-green-700 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div
                            class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-center text-red-700 shadow-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('attendant.register.store', $attendantList->registration_token) }}"
                        method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        @csrf

                        {{-- =========================
                            Personal Information
                        ========================== --}}

                        <div class="md:col-span-2">
                            <h3 class="text-sm md:text-lg font-bold text-green-700">
                                ព័ត៌មានផ្ទាល់ខ្លួន (Personal Information)
                            </h3>
                            <hr>
                        </div>

                        {{-- Full Name --}}
                        <div>
                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ឈ្មោះពេញ (Full Name) <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                placeholder="Enter your name"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:ring-4 focus:ring-green-100">

                        </div>

                        {{-- Gender --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ភេទ (Gender)
                            </label>

                            <select name="gender"
                                class="w-full rounded-xl border text-xs md:text-sm border-slate-300 px-4 py-3">

                                <option value="">Select</option>

                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                    ស្រី​/​Female
                                </option>

                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                    ប្រុស/Male
                                </option>

                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>
                                    ផ្សេងៗ/Other
                                </option>

                                <option value="Prefer not to say"
                                    {{ old('gender') == 'Prefer not to say' ? 'selected' : '' }}>
                                    សុំមិនបញ្ចេញអត្តសញ្ញាណភេទ/Prefer not to say
                                </option>

                            </select>

                        </div>

                        {{-- Age Group --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ក្រុមអាយុ (Age Group)
                            </label>

                            <select name="age_group"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                                <option value="">Select</option>

                                <option value="<15" {{ old('age_group') == '<15' ? 'selected' : '' }}>
                                    > 15
                                </option>

                                <option value="15-30" {{ old('age_group') == '15-30' ? 'selected' : '' }}>
                                    15 - 30
                                </option>

                                <option value="31-60" {{ old('age_group') == '31-60' ? 'selected' : '' }}>
                                    31 - 60
                                </option>

                                <option value=">60" {{ old('age_group') == '>60' ? 'selected' : '' }}>
                                    > 60
                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ជាស្ត្រីងាយរងគ្រោះ (Vulnerable Woman)
                            </label>

                            <select name="vulnerable_women"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                                <option value="No" {{ old('vulnerable_women', 'No') == 'No' ? 'selected' : '' }}>
                                    No
                                </option>

                                <option value="Yes" {{ old('vulnerable_women') == 'Yes' ? 'selected' : '' }}>
                                    Yes
                                </option>

                            </select>

                        </div>

                        {{-- Indigenous --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ជនជាតិដើមភាគតិច (Indigenous People)
                            </label>

                            <select name="indigenous"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                                <option value="No" {{ old('indigenous', 'No') == 'No' ? 'selected' : '' }}>
                                    No
                                </option>

                                <option value="Yes" {{ old('indigenous') == 'Yes' ? 'selected' : '' }}>
                                    Yes
                                </option>

                            </select>

                        </div>

                        {{-- Poor Status --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ស្ថានភាពគ្រួសារក្រីក្រ (IDPoor Status)
                            </label>

                            <select name="poor_status"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                                <option value="">Select</option>

                                <option value="ID Poor 1" {{ old('poor_status') == 'ID Poor 1' ? 'selected' : '' }}>
                                    ប័ណ្ណក្រីក្រ កម្រិត ១ (ID Poor 1)
                                </option>

                                <option value="ID Poor 2" {{ old('poor_status') == 'ID Poor 2' ? 'selected' : '' }}>
                                    ប័ណ្ណក្រីក្រ កម្រិត ២ (ID Poor 2)
                                </option>

                                <option value="Non Poor" {{ old('poor_status') == 'Non Poor' ? 'selected' : '' }}>
                                    មិនមែនគ្រួសារក្រីក្រ (Non Poor)
                                </option>

                            </select>

                        </div>

                        {{-- Disability --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ជនមានពិការភាព (Person with Disability)
                            </label>

                            <select name="disability"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                                <option value="No" {{ old('disability', 'No') == 'No' ? 'selected' : '' }}>
                                    No
                                </option>

                                <option value="Yes" {{ old('disability') == 'Yes' ? 'selected' : '' }}>
                                    Yes
                                </option>

                            </select>

                        </div>

                        {{-- Unique --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ចូលរួមលើកទី១ (Unique count)
                            </label>

                            <select name="unique_count"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                                <option value="No" {{ old('unique_count', 'No') == 'No' ? 'selected' : '' }}>
                                    No
                                </option>

                                <option value="Yes" {{ old('unique_count') == 'Yes' ? 'selected' : '' }}>
                                    Yes
                                </option>

                            </select>

                        </div>

                        {{--  Remark --}}
                        <div class="md:col-span-2">

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                តម្រូវការបន្ថែម (Remark)
                            </label>

                            <textarea name="remark" rows="4" placeholder="Enter remark"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3
                                focus:border-green-500 focus:ring-4 focus:ring-green-100">{{ old('remark') }}</textarea>

                        </div>

                        {{-- =========================
                            Contact Information
                        ========================== --}}

                        <div class="md:col-span-2 mt-4">
                            <h3 class="mb-2 text-sm md:text-lg font-bold text-green-700">
                                ព័ត៌មានទំនាក់ទំនង (Contact Information)
                            </h3>
                            <hr>
                        </div>

                        {{-- Institution --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                ស្ថាប័ន/អង្គភាព (Institution/Organization)
                            </label>

                            <input type="text" name="institution" value="{{ old('institution') }}"
                                placeholder="Enter"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                        </div>

                        <div>
                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                បណ្តាញ (Network)
                            </label>

                            <select name="network"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3
                                    focus:border-green-500 focus:ring-4 focus:ring-green-100">

                                <option value="">Select Network</option>

                                <option value="RCC" {{ old('network') == 'RCC' ? 'selected' : '' }}>
                                    RCC
                                </option>

                                <option value="BWG" {{ old('network') == 'BWG' ? 'selected' : '' }}>
                                    BWG
                                </option>

                                <option value="NECCAW" {{ old('network') == 'NECCAW' ? 'selected' : '' }}>
                                    NECCAW
                                </option>

                                <option value="GGESI" {{ old('network') == 'GGESI' ? 'selected' : '' }}>
                                    GGESI
                                </option>

                                <option value="NRLG" {{ old('network') == 'NRLG' ? 'selected' : '' }}>
                                    NRLG
                                </option>

                                <option value="None" {{ old('network') == 'None' ? 'selected' : '' }}>
                                    None
                                </option>

                            </select>
                        </div>

                        {{-- Position --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                មុខតំណែង (Position)
                            </label>

                            <input type="text" name="position" value="{{ old('position') }}" placeholder="Enter"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                        </div>

                        {{-- Phone --}}
                        <div>

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                លេខទូរស័ព្ទ (Phone Number)
                            </label>

                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                        </div>

                        {{-- Email --}}
                        <div class="col-span-2">

                            <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                អ៊ីមែល (Email)
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter"
                                class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3">

                        </div>

                        {{-- =========================
                            Residence Information
                        ========================== --}}

                        <div class="md:col-span-2 mt-4">
                            <h3 class="mb-2 text-sm md:text-lg font-bold text-green-700">
                                ព័ត៌មានអំពីទីលំនៅ (Residence Information)
                            </h3>
                            <hr>
                        </div>

                        <div class="md:col-span-2">

                            <label class="mb-3 block text-xs md:text-sm font-semibold text-slate-700">
                                ប្រភេទទីលំនៅ (Residence Type) <span class="text-red-500">*</span>
                            </label>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                                {{-- Phnom Penh --}}
                                <label
                                    class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-300 bg-white px-5 py-4 transition hover:border-green-500 hover:bg-green-50">

                                    <input type="radio" name="residence_type" value="Phnom Penh"
                                        class="h-5 w-5 accent-green-600"
                                        {{ old('residence_type') == 'Phnom Penh' ? 'checked' : '' }}>

                                    <div>
                                        <p class="font-semibold text-slate-800 text-xs md:text-sm">
                                            ភ្នំពេញ(Phnom Penh)
                                        </p>
                                    </div>

                                </label>

                                {{-- Community --}}
                                <label
                                    class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-300 bg-white px-5 py-4 transition hover:border-green-500 hover:bg-green-50">

                                    <input type="radio" name="residence_type" value="Community"
                                        class="h-5 w-5 accent-green-600"
                                        {{ old('residence_type') == 'Community' ? 'checked' : '' }}>

                                    <div>
                                        <p class="font-semibold text-slate-800 text-xs md:text-sm">
                                            ខេត្ត(Various provinces)
                                        </p>
                                    </div>

                                </label>

                            </div>

                        </div>

                        {{-- Address --}}
                        <div id="address_fields"
                            class="{{ old('residence_type') == 'Community' ? '' : 'hidden' }} md:col-span-2">

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                                {{-- Village --}}
                                <div>

                                    <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                        ភូមិ (Village)
                                    </label>

                                    <input id="village" type="text" name="village" placeholder="Enter"
                                        value="{{ old('village') }}"
                                        class="w-full rounded-xl border text-xs md:text-sm border-slate-300 px-4 py-3">

                                </div>

                                {{-- Commune --}}
                                <div>

                                    <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                        ឃុំ/សង្កាត់ (Commune/Sangkat)
                                    </label>

                                    <input id="commune" type="text" name="commune" placeholder="Enter"
                                        value="{{ old('commune') }}"
                                        class="w-full rounded-xl border text-xs md:text-sm border-slate-300 px-4 py-3">

                                </div>

                                {{-- District --}}
                                <div>

                                    <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                        ស្រុក/ខណ្ឌ (District/Khan)
                                    </label>

                                    <input id="district" type="text" name="district" placeholder="Enter"
                                        value="{{ old('district') }}"
                                        class="w-full rounded-xl border text-xs md:text-sm border-slate-300 px-4 py-3">

                                </div>

                                {{-- Province --}}
                                <div id="org_location_field">

                                    <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                        ខេត្ត (Province)
                                    </label>

                                    <input id="province" type="text" name="province" placeholder="Enter"
                                        value="{{ old('province') }}"
                                        class="w-full rounded-xl border text-xs md:text-sm border-slate-300 px-4 py-3">

                                </div>


                                {{-- DSA --}}
                                <div class="col-span-2">
                                    <label class="mb-2 block text-xs md:text-sm font-semibold text-slate-700">
                                        DSA (Daily Subsistence Allowance)
                                    </label>

                                    <select id="dsa" name="dsa"
                                        class="w-full text-xs md:text-sm rounded-xl border border-slate-300 px-4 py-3
                                            focus:border-green-500 focus:ring-4 focus:ring-green-100">

                                        <option value="Not need"
                                            {{ old('dsa', 'Not need') == 'Not need' ? 'selected' : '' }}>
                                            Not need
                                        </option>

                                        <option value="Need" {{ old('dsa') == 'Need' ? 'selected' : '' }}>
                                            Need
                                        </option>

                                    </select>
                                </div>

                            </div>

                        </div>


                        {{-- Submit --}}
                        <div class="md:col-span-2 mt-6 text-center">

                            <button type="submit"
                                class="rounded-2xl bg-gradient-to-r from-green-600 to-emerald-600 px-10 py-3 text-base md:text-lg font-semibold text-white transition hover:from-green-700 hover:to-emerald-700">

                                ចុះឈ្មោះ (Register)

                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const radios = document.querySelectorAll('input[name="residence_type"]');

            const addressFields = document.getElementById('address_fields');

            const village = document.getElementById('village');
            const commune = document.getElementById('commune');
            const district = document.getElementById('district');
            const province = document.getElementById('province');

            const dsa = document.getElementById('dsa');

            function updateResidence() {

                const selected = document.querySelector(
                    'input[name="residence_type"]:checked'
                )?.value;

                if (selected === 'Phnom Penh') {

                    addressFields.classList.add('hidden');

                    village.required = false;
                    commune.required = false;
                    district.required = false;
                    province.required = false;

                    village.value = '';
                    commune.value = '';
                    district.value = '';

                    province.value = 'Phnom Penh';


                    // Automatically set DSA = Not need
                    dsa.value = 'Not need';

                    return;
                }


                if (selected === 'Community') {

                    addressFields.classList.remove('hidden');

                    village.required = true;
                    commune.required = true;
                    district.required = true;
                    province.required = true;

                    if (province.value === 'Phnom Penh') {
                        province.value = '';
                    }

                } else {

                    addressFields.classList.add('hidden');

                    village.required = false;
                    commune.required = false;
                    district.required = false;
                    province.required = false;

                    village.value = '';
                    commune.value = '';
                    district.value = '';
                    province.value = 'Phnom Penh';

                }

            }

            radios.forEach(function(radio) {
                radio.addEventListener('change', updateResidence);
            });

            updateResidence();

        });
    </script>

</body>

</html>
