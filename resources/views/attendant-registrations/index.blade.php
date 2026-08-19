@extends('layout.app')

@section('content')
    <style>
        .vertical-header {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            white-space: nowrap;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 180px;
            font-size: 13px;
            line-height: 1.7;
            padding: 8px;
        }
    </style>

    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div
            class="mb-4 overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-700 via-green-600 to-emerald-500 shadow-xl">

            <div class="flex flex-col gap-6 p-8 lg:flex-row lg:items-center lg:justify-between">

                {{-- Left --}}
                <div class="flex items-start gap-5">

                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/20 backdrop-blur">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-8 0v2m8 0H9m4-10a4 4 0 11-8 0 4 4 0 018 0z" />

                        </svg>

                    </div>

                    <div>

                        <span
                            class="inline-flex rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white">

                            Attendance Registration

                        </span>

                        <h1 class="mt-3 text-3xl font-bold text-white">

                            {{ $attendantList->title }}

                        </h1>

                        <p class="mt-2 text-green-100">

                            Manage registered participants for this activity.

                        </p>

                        <div class="mt-5 flex flex-wrap gap-3">

                            <span class="rounded-full bg-white/20 px-4 py-1 text-sm font-medium text-white">

                                👥 Total:
                                {{ $registrations->total() }}

                            </span>

                            @if ($attendantList->activity_date)
                                <span class="rounded-full bg-white/20 px-4 py-1 text-sm font-medium text-white">

                                    📅
                                    {{ \Carbon\Carbon::parse($attendantList->activity_date)->format('d M Y') }}

                                </span>
                            @endif

                        </div>

                    </div>

                </div>

                {{-- Right --}}
                <div class="flex flex-wrap justify-end gap-3">

                    <a href="{{ route('attendant-lists.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/15 px-5 py-3 font-semibold text-white transition hover:bg-white/25">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                        </svg>

                        Back

                    </a>

                    <a href="{{ route('attendant-registrations.pdf', $attendantList) }}" target="_blank"
                        class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-5 py-3 text-white hover:bg-red-700">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
                        </svg>

                        PDF

                    </a>

                </div>

            </div>

        </div>

        {{-- Toolbar --}}
        <div class="mb-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                {{-- Left --}}
                <div>

                    <h2 class="text-2xl font-bold text-green-700">
                        Participant List
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Manage all registered participants for this activity.
                    </p>

                    <div class="mt-4 flex flex-wrap gap-3">

                        <span
                            class="inline-flex items-center rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">

                            👥 {{ $registrations->total() }} Participants

                        </span>

                        <span
                            class="inline-flex items-center rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold text-blue-700">

                            📋 Registration List

                        </span>

                    </div>

                </div>

                {{-- Right --}}
                <div class="flex flex-wrap items-center gap-3">

                    {{-- Search --}}
                    <form method="GET" class="relative">

                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-slate-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />

                        </svg>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search participant..."
                            class="w-80 rounded-xl border border-slate-300 py-3 pl-12 pr-4 shadow-sm transition focus:border-green-500 focus:ring-4 focus:ring-green-100">

                    </form>

                    {{-- Search Button --}}
                    <button type="submit" formmethod="GET"
                        class="rounded-xl bg-green-600 px-5 py-3 font-semibold text-white transition hover:bg-green-700">

                        Search

                    </button>

                    {{-- Refresh --}}
                    <a href="{{ route('attendant-registrations.index', $attendantList) }}"
                        class="rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 transition hover:bg-slate-100">

                        Refresh

                    </a>

                </div>

            </div>

        </div>

        {{-- Attendance Table --}}

        <div class="overflow-auto rounded-2xl border shadow">

            <table class="border-collapse">

                <thead class="sticky top-0 z-20 bg-green-700 text-white shadow-lg">

                    {{-- Main Header --}}
                    <tr class="text-center align-middle text-xs">

                        {{-- No --}}
                        <th rowspan="2" class="border border-emerald-500 px-2 py-3">
                            <div class="font-normal">ល.រ</div>
                            <div>No.</div>
                        </th>

                        {{-- Participant --}}
                        <th rowspan="2" class="border border-emerald-500 px-2 py-3">
                            <div class="font-normal">ឈ្មោះអ្នកចូលរួម</div>
                            <div>Participant's Name</div>
                        </th>

                        {{-- Gender --}}
                        <th rowspan="2" class="border border-emerald-500 px-3 py-3 text-left">
                            <div class="font-normal">ភេទ / យេនឌ័រ</div>
                            <div class="mb-1">
                                Sex / Gender
                            </div>

                            <div class="leading-6">
                                1 = Female<br>
                                2 = Male<br>
                                3 = Others<br>
                                4 = Prefer not to say
                            </div>
                        </th>

                        {{-- Age --}}
                        <th rowspan="2" class="border border-emerald-500 px-3 py-3 text-left">
                            <div>អាយុ</div>
                            <div class="mb-1">
                                Age
                            </div>

                            <div class="leading-4">
                                1 = &lt;15<br>
                                2 = 15–30<br>
                                3 = 31–60<br>
                                4 = &gt;60
                            </div>
                        </th>

                        {{-- Indigenous --}}
                        <th rowspan="2" class="border border-emerald-500">
                            <div class="vertical-header">
                                Indigenous
                                (1=Yes / 0=No)
                            </div>
                        </th>

                        {{-- Vulnerable --}}
                        <th rowspan="2" class="border border-emerald-500">
                            <div class="vertical-header">
                                Vulnerable
                                Woman
                                (1=Yes / 0=No)
                            </div>
                        </th>

                        {{-- Poor --}}
                        <th rowspan="2" class="border border-emerald-500">
                            <div class="vertical-header">
                                Poor
                                (1=Poor1
                                2=Poor2
                                0=No)
                            </div>
                        </th>

                        {{-- Disability --}}
                        <th rowspan="2" class="border border-emerald-500">
                            <div class="vertical-header">
                                Disability
                                (1=Yes / 0=No)
                            </div>
                        </th>

                        {{-- Address --}}
                        <th colspan="2" class="border border-emerald-500 px-3 py-3">
                            <div class="font-normal">អាសយដ្ឋាន</div>
                            <div>Address</div>
                        </th>

                        {{-- Institution --}}
                        <th rowspan="2" class="border border-emerald-500 px-3 py-3">
                            <div class="font-normal">ស្ថាប័ន</div>
                            <div>
                                Institution
                            </div>
                        </th>

                        {{-- Position --}}
                        <th rowspan="2" class="border border-emerald-500 px-3 py-3">
                            <div class="font-normal">តួនាទី</div>
                            <div>
                                Position
                            </div>
                        </th>

                        {{-- Contact --}}
                        <th rowspan="2" class="border border-emerald-500 px-3 py-3">
                            <div class="font-normal">
                                លេខទូរស័ព្ទ / អ៊ីមែល
                            </div>

                            <div>
                                Contact No. / Email
                            </div>
                        </th>

                        {{-- Unique Count --}}
                        <th rowspan="2" class="border border-emerald-500">
                            <div class="vertical-header">
                                Unique
                                Count
                                (1=Yes / 0=No)
                            </div>
                        </th>

                        {{-- Photo Consent --}}
                        <th rowspan="2" class="border border-emerald-500">
                            <div class="vertical-header font-normal">
                                អនុញ្ញាតឱ្យថត និងប្រើប្រាស់រូប /
                                <br>
                                Allow to take and use my photos
                            </div>
                        </th>

                        {{-- Signature --}}
                        <th rowspan="2" class="border border-emerald-500 px-3 py-3">
                            <div class="font-normal">ហត្ថលេខា</div>
                            <div>
                                Signature
                            </div>
                        </th>

                        {{-- Action --}}
                        <th rowspan="2" class="border border-emerald-500 px-3 py-3">
                            <div class="font-normal">
                                Action
                            </div>
                        </th>

                    </tr>

                    {{-- Address Row --}}
                    <tr class="text-center text-xs">

                        <th class="border border-emerald-500 px-2 py-2">
                            <div class="font-medium">
                                ភូមិ / ឃុំ-សង្កាត់
                            </div>

                            <div class="text-emerald-100">
                                Village / Commune
                            </div>
                        </th>

                        <th class="border border-emerald-500 px-2 py-2">
                            <div class="font-medium">
                                ស្រុក-ខណ្ឌ / ខេត្ត
                            </div>

                            <div class="text-emerald-100">
                                District / Province
                            </div>
                        </th>

                    </tr>

                </thead>

                <tbody class="bg-white text-xs text-gray-800">

                    @forelse($registrations as $index => $registration)
                        <tr class="h-16 align-middle hover:bg-gray-50">

                            {{-- No --}}
                            <td class="border border-black text-center">
                                {{ $registrations->firstItem() + $index }}
                            </td>

                            {{-- Participant Name --}}
                            <td class="border border-black px-2">
                                {{ $registration->full_name ?: '—' }}
                            </td>

                            {{-- Gender --}}
                            <td class="border border-black text-center">
                                @switch($registration->gender)
                                    @case('Female')
                                        1
                                    @break

                                    @case('Male')
                                        2
                                    @break

                                    @case('Other')
                                        3
                                    @break

                                    @case('Prefer not to say')
                                        4
                                    @break

                                    @default
                                        —
                                @endswitch
                            </td>

                            {{-- Age --}}
                            <td class="border border-black text-center">
                                @switch($registration->age_group)
                                    @case('<15')
                                        1
                                    @break

                                    @case('15-30')
                                        2
                                    @break

                                    @case('31-60')
                                        3
                                    @break

                                    @case('>60')
                                        4
                                    @break

                                    @default
                                        —
                                @endswitch
                            </td>

                            {{-- Indigenous --}}
                            <td class="border border-black text-center">
                                {{ $registration->indigenous == 'Yes' ? '1' : ($registration->indigenous == 'No' ? '0' : '—') }}
                            </td>

                            {{-- Vulnerable Women --}}
                            <td class="border border-black text-center">
                                {{ $registration->vulnerable_women == 'Yes' ? '1' : ($registration->vulnerable_women == 'No' ? '0' : '—') }}
                            </td>

                            {{-- Poor Status --}}
                            <td class="border border-black text-center">
                                @switch($registration->poor_status)
                                    @case('ID Poor 1')
                                        1
                                    @break

                                    @case('ID Poor 2')
                                        2
                                    @break

                                    @case('Non Poor')
                                        0
                                    @break

                                    @default
                                        —
                                @endswitch
                            </td>

                            {{-- Disability --}}
                            <td class="border border-black text-center">
                                {{ $registration->disability == 'Yes' ? '1' : ($registration->disability == 'No' ? '0' : '—') }}
                            </td>

                            {{-- Village / Commune --}}
                            <td class="border border-black px-2">
                                @if ($registration->village || $registration->commune)
                                    {{ $registration->village ?: '—' }}<br>
                                    {{ $registration->commune ?: '—' }}
                                @else
                                    <div class="text-center text-gray-400">—</div>
                                @endif
                            </td>

                            {{-- District / Province --}}
                            <td class="border border-black text-center px-2">
                                @if ($registration->district || $registration->province)
                                    {{ $registration->district }}<br>
                                    {{ $registration->province ?: '—' }}
                                @else
                                    <div class="text-center text-gray-400">—</div>
                                @endif
                            </td>

                            {{-- Institution --}}
                            <td class="border border-black px-2">
                                {{ $registration->institution ?: '—' }}
                            </td>

                            {{-- Position --}}
                            <td class="border border-black px-2">
                                {{ $registration->position ?: '—' }}
                            </td>

                            {{-- Contact --}}
                            <td class="border border-black px-2">
                                @if ($registration->phone || $registration->email)
                                    {{ $registration->phone ?: '—' }}

                                    @if ($registration->email)
                                        <br>{{ $registration->email }}
                                    @endif
                                @else
                                    <div class="text-center text-gray-400">—</div>
                                @endif
                            </td>

                            {{-- Unique Count --}}
                            <td class="border border-black text-center">
                                {{ $registration->unique_count ? '1' : '0' }}
                            </td>

                            {{-- Photo Consent --}}
                            <td class="border border-black text-center">
                                {{ $registration->allow_photos == 'Yes' ? '1' : ($registration->allow_photos == 'No' ? '0' : '—') }}
                            </td>

                            {{-- Signature --}}
                            <td class="border border-black h-16 text-center align-middle">
                                @if ($registration->signature)
                                    <img src="{{ asset('storage/' . $registration->signature) }}"
                                        class="mx-auto h-12 max-w-full object-contain" alt="Signature">
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>

                            {{-- Action --}}
                            <td class="border border-black text-center whitespace-nowrap">

                                <form id="delete-form-{{ $registration->id }}"
                                    action="{{ route('attendant-registrations.destroy', $registration) }}" method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="confirmDelete({{ $registration->id }})"
                                        class="inline-flex items-center gap-1 rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-red-700">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7L18.133 19.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />

                                        </svg>


                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                            <tr>
                                <td colspan="17" class="border border-black py-10 text-center text-gray-500">
                                    No registration data found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

            </div>

        </div>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Delete Registration?',
                    text: 'This record will be permanently deleted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: '<i class="fas fa-trash"></i> Delete',
                    cancelButtonColor: '#6b7280',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endsection
