@extends('layout.app')

@section('content')
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

                {{-- =====================================================
                    LEFT
                ====================================================== --}}
                <div>

                    <h2 class="text-2xl font-bold text-green-700">
                        Participant List
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Manage all registered participants for this activity.
                    </p>

                    <div class="mt-4 flex flex-wrap gap-3">

                        <span
                            class="inline-flex items-center rounded-full bg-green-100
                           px-4 py-2 text-sm font-semibold text-green-700">

                            👥 {{ $registrations->total() }} Participants

                        </span>

                        <span
                            class="inline-flex items-center rounded-full bg-blue-100
                           px-4 py-2 text-sm font-semibold text-blue-700">

                            📋 Registration List

                        </span>

                    </div>

                </div>


                {{-- =====================================================
                    RIGHT - SEARCH / FILTER
                ====================================================== --}}
                <form method="GET" action="{{ route('attendant-registrations.index', $attendantList) }}"
                    class="flex w-full flex-col gap-3 sm:flex-row
                   sm:flex-wrap lg:w-auto lg:items-center">

                    {{-- Search --}}
                    <div class="relative">

                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-slate-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />

                        </svg>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search participant..."
                            class="w-full rounded-xl border border-slate-300
                           py-3 pl-12 pr-4 text-sm shadow-sm
                           transition
                           focus:border-green-500
                           focus:ring-4 focus:ring-green-100
                           sm:w-72">

                    </div>


                    {{-- =================================================
                        NETWORK
                    ================================================== --}}
                    <select name="network"
                        class="w-full rounded-xl border border-slate-300
                       bg-white px-4 py-3 text-sm shadow-sm
                       transition
                       focus:border-green-500
                       focus:ring-4 focus:ring-green-100
                       sm:w-48">

                        <option value="">
                            All Networks
                        </option>

                        <option value="RCC" {{ request('network') === 'RCC' ? 'selected' : '' }}>
                            RCC
                        </option>

                        <option value="BWG" {{ request('network') === 'BWG' ? 'selected' : '' }}>
                            BWG
                        </option>

                        <option value="NECCAW" {{ request('network') === 'NECCAW' ? 'selected' : '' }}>
                            NECCAW
                        </option>

                        <option value="GGESI" {{ request('network') === 'GGESI' ? 'selected' : '' }}>
                            GGESI
                        </option>

                        <option value="NRLG" {{ request('network') === 'NRLG' ? 'selected' : '' }}>
                            NRLG
                        </option>

                    </select>


                    {{-- =================================================
                        SEARCH BUTTON
                    ================================================== --}}
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-green-600 px-5 py-3
                       text-sm font-semibold text-white
                       shadow-sm transition
                       hover:bg-green-700
                       focus:outline-none
                       focus:ring-4 focus:ring-green-100">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />

                        </svg>

                        Search

                    </button>


                    {{-- =================================================
                        RESET
                    ================================================== --}}
                    <a href="{{ route('attendant-registrations.index', $attendantList) }}"
                        class="inline-flex items-center justify-center
                       rounded-xl border border-slate-300
                       bg-white px-5 py-3
                       text-sm font-semibold text-slate-700
                       shadow-sm transition
                       hover:bg-slate-100">

                        Refresh

                    </a>

                </form>

            </div>

        </div>


        {{-- Attendance Table --}}
        <div class="overflow-auto rounded-xl border shadow">

            <table class="border-collapse w-full">

                <thead class="sticky top-0 z-20">
                    <tr
                        class="bg-gradient-to-r from-green-700 via-green-600 to-emerald-600
                                text-center align-middle text-[11px] font-semibold uppercase tracking-wide text-white">

                        {{-- No --}}
                        <th class="whitespace-nowrap border border-green-500 px-3 py-3">
                            No.
                        </th>

                        {{-- Participant --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Participant's Name
                        </th>

                        {{-- Gender --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Sex / Gender
                        </th>

                        {{-- Age --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Age
                        </th>

                        {{-- Institution --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Institution
                        </th>

                        {{-- Position --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Position
                        </th>

                        {{-- Contact --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Contact No. / Email
                        </th>

                        {{-- Network --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Network
                        </th>

                        {{-- DSA --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            DSA
                        </th>

                        {{-- Remark --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Remark
                        </th>

                        {{-- Action --}}
                        <th class="whitespace-nowrap border border-green-500 px-4 py-3">
                            Action
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white text-[11px] text-slate-700">

                    @forelse ($registrations as $index => $registration)
                        <tr class="text-center transition hover:bg-green-50">

                            {{-- No --}}
                            <td class="whitespace-nowrap border border-slate-200 px-3 py-2 font-medium text-slate-500">
                                {{ $registrations->firstItem() + $index }}
                            </td>

                            {{-- Participant Name --}}
                            <td class="border border-slate-200 px-4 py-2 text-left font-semibold text-slate-800">
                                {{ $registration->full_name }}
                            </td>

                            {{-- Gender --}}
                            <td class="whitespace-nowrap border border-slate-200 px-3 py-2">
                                {{ $registration->gender ?? '-' }}
                            </td>

                            {{-- Age --}}
                            <td class="whitespace-nowrap border border-slate-200 px-3 py-2">
                                {{ $registration->age_group ?? '-' }}
                            </td>

                            {{-- Institution --}}
                            <td class="border border-slate-200 px-3 py-2 text-left">
                                {{ $registration->institution ?? '-' }}
                            </td>

                            {{-- Position --}}
                            <td class="border border-slate-200 px-3 py-2 text-left">
                                {{ $registration->position ?? '-' }}
                            </td>

                            {{-- Contact --}}
                            <td class="border border-slate-200 px-3 py-2 text-left">
                                <div class="font-medium">
                                    {{ $registration->phone ?? '-' }}
                                </div>

                                @if ($registration->email)
                                    <div class="mt-0.5 text-[10px] text-slate-500">
                                        {{ $registration->email }}
                                    </div>
                                @endif
                            </td>

                            {{-- Network --}}
                            <td class="whitespace-nowrap border border-slate-200 px-3 py-3">
                                @if ($registration->network === 'None')
                                    <span
                                        class="inline-flex rounded-full bg-red-100 px-2.5 py-1
                                            text-[10px] font-semibold text-red-700">
                                        None
                                    </span>
                                @elseif ($registration->network)
                                    <span
                                        class="inline-flex rounded-full bg-green-100 px-2.5 py-1
                                            text-[10px] font-semibold text-green-700">
                                        {{ $registration->network }}
                                    </span>
                                @else
                                    <span class="text-slate-400">
                                        None
                                    </span>
                                @endif
                            </td>

                            {{-- DSA --}}
                            <td class="whitespace-nowrap border border-slate-200 px-3 py-3">
                                @if ($registration->dsa === 'Need')
                                    <span
                                        class="inline-flex rounded-full bg-green-100 px-2.5 py-1
                                            text-[10px] font-semibold text-green-700">
                                        Need
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full bg-red-100 px-2.5 py-1
                                            text-[10px] font-semibold text-red-600">
                                        Not need
                                    </span>
                                @endif
                            </td>

                            {{-- Remark --}}
                            <td class="w-[350px] border border-slate-200 px-3 py-3 text-left">
                                {{ $registration->remark ?? '-' }}
                            </td>

                            {{-- Action --}}
                            <td class="whitespace-nowrap border border-slate-200 px-3 py-3">

                                <div class="flex items-center justify-center gap-2">


                                    {{-- ========================================================= --}}
                                    {{-- DSA APPROVE --}}
                                    {{-- ========================================================= --}}

                                    @if ($registration->dsa === 'Need' && $registration->dsa_status === 'Pending')
                                        <form action="{{ route('attendant-registrations.dsa.approve', $registration) }}"
                                            method="POST">

                                            @csrf

                                            <button type="submit"
                                                class="inline-flex h-8 w-8
                                                    items-center justify-center
                                                    rounded-lg
                                                    bg-green-50
                                                    text-green-600
                                                    transition
                                                    hover:bg-green-100
                                                    hover:text-green-700"
                                                title="Approve DSA">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />

                                                </svg>

                                            </button>

                                        </form>


                                        {{-- ===================================================== --}}
                                        {{-- DSA REJECT --}}
                                        {{-- ===================================================== --}}

                                        <button type="button" onclick="openDsaRejectModal({{ $registration->id }})"
                                            class="inline-flex h-8 w-8
                                                items-center justify-center
                                                rounded-lg
                                                bg-orange-50
                                                text-orange-600
                                                transition
                                                hover:bg-orange-100
                                                hover:text-orange-700"
                                            title="Reject DSA">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />

                                            </svg>

                                        </button>
                                    @endif


                                    {{-- ========================================================= --}}
                                    {{-- DELETE --}}
                                    {{-- ========================================================= --}}

                                    <form id="delete-form-{{ $registration->id }}"
                                        action="{{ route('attendant-registrations.destroy', $registration) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="confirmDelete({{ $registration->id }})"
                                            class="inline-flex h-8 w-8
                                                items-center justify-center
                                                rounded-lg
                                                bg-red-50
                                                text-red-600
                                                transition
                                                hover:bg-red-100
                                                hover:text-red-700"
                                            title="Delete">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                                            a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                                                            M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3
                                                            m-7 0h10" />

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="11" class="border border-slate-200 px-6 py-12 text-center">

                                <div class="flex flex-col items-center justify-center">

                                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />

                                        </svg>

                                    </div>

                                    <p class="font-semibold text-slate-600">
                                        No participants registered
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Registered participants will appear here.
                                    </p>

                                </div>

                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

            {{-- ================================================================ --}}
            {{-- DSA REJECT MODAL --}}
            {{-- ================================================================ --}}

            <div id="dsaRejectModal"
                class="fixed inset-0 z-50 hidden
                    items-center justify-center
                    bg-black/50 p-4">

                <div class="w-full max-w-md
                        rounded-xl
                        bg-white
                        shadow-2xl">

                    {{-- Header --}}
                    <div
                        class="flex items-center justify-between
                                border-b border-slate-200
                                px-6 py-4">

                        <h3 class="text-lg font-bold text-red-700">
                            Rejected DSA
                        </h3>

                        <button type="button" onclick="closeDsaRejectModal()"
                            class="text-red-600 r:text-slate-600 hover:bg-red-100 p-2 rounded-lg">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />

                            </svg>

                        </button>

                    </div>


                    {{-- Form --}}
                    <form id="dsaRejectForm" method="POST">

                        @csrf

                        <div class="p-6">

                            <label for="dsa_rejection_reason"
                                class="mb-2 block
                                    text-sm
                                    font-semibold
                                    text-slate-700">

                                Rejection Reason
                                <span class="text-red-500">*</span>

                            </label>

                            <textarea id="dsa_rejection_reason" name="dsa_rejection_reason" rows="4" required
                                class="w-full rounded-lg
                           border border-slate-300
                           px-3 py-2
                           text-sm
                           focus:border-red-500
                           focus:ring-red-500"
                                placeholder="Enter reason for rejecting DSA..."></textarea>

                        </div>


                        {{-- Footer --}}
                        <div
                            class="flex justify-end gap-3
                                    border-t border-slate-200
                                    px-6 py-4">

                            <button type="button" onclick="closeDsaRejectModal()"
                                class="rounded-lg
                                    bg-amber-100
                                    px-4 py-2
                                    text-sm
                                    font-semibold
                                    text-amber-700
                                    hover:bg-amber-200">

                                Cancel

                            </button>

                            <button type="submit"
                                class="rounded-lg
                           bg-red-600
                           px-4 py-2
                           text-sm
                           font-semibold
                           text-white
                           hover:bg-red-700">

                                Reject DSA

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        {{-- Pagination --}}
        @if ($registrations->hasPages())
            <div class="mt-3 rounded-2xl border border-slate-200 bg-white px-5 py-3 shadow-sm">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    {{-- Showing --}}
                    <div class="text-sm text-slate-500">

                        Showing
                        <span class="font-semibold text-slate-700">
                            {{ $registrations->firstItem() ?? 0 }}
                        </span>

                        to

                        <span class="font-semibold text-slate-700">
                            {{ $registrations->lastItem() ?? 0 }}
                        </span>

                        of

                        <span class="font-semibold text-slate-700">
                            {{ $registrations->total() }}
                        </span>

                        participants

                    </div>


                    {{-- Pagination --}}
                    <div class="flex items-center gap-3">

                        {{-- Previous --}}
                        @if ($registrations->onFirstPage())
                            <span
                                class="inline-flex items-center rounded-xl border border-slate-200
                                     bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-400">
                                « Previous
                            </span>
                        @else
                            <a href="{{ $registrations->previousPageUrl() }}"
                                class="inline-flex items-center rounded-xl border border-slate-300
                                    bg-white px-5 py-2 text-sm font-semibold text-slate-700
                                    transition hover:bg-green-600 hover:text-white">
                                « Previous
                            </a>
                        @endif


                        {{-- Next --}}
                        @if ($registrations->hasMorePages())
                            <a href="{{ $registrations->nextPageUrl() }}"
                                class="inline-flex items-center rounded-xl border border-slate-300
                                    bg-white px-5 py-2 text-sm font-semibold text-slate-700
                                    transition hover:bg-green-600 hover:text-white">
                                Next »
                            </a>
                        @else
                            <span
                                class="inline-flex items-center rounded-xl border border-slate-200
                                     bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-400">
                                Next »
                            </span>
                        @endif

                    </div>

                </div>

            </div>
        @endif

    </div>


    <script>
        function confirmDelete(id) {

            Swal.fire({
                title: 'Delete Registration?',
                text: 'This record will be permanently deleted.',
                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',

                confirmButtonText: '<i class="fas fa-trash"></i> Delete',
                cancelButtonText: 'Cancel',

                reverseButtons: true,
                focusCancel: true,

                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-lg px-5 py-2.5',
                    cancelButton: 'rounded-lg px-5 py-2.5'
                }

            }).then((result) => {

                if (result.isConfirmed) {

                    document
                        .getElementById('delete-form-' + id)
                        .submit();

                }

            });

        }


        function openDsaRejectModal(registrationId) {
            const modal =
                document.getElementById(
                    'dsaRejectModal'
                );

            const form =
                document.getElementById(
                    'dsaRejectForm'
                );

            const reason =
                document.getElementById(
                    'dsa_rejection_reason'
                );


            /*
            |--------------------------------------------------------------------------
            | Set Reject URL
            |--------------------------------------------------------------------------
            */

            form.action =
                `/attendant-registrations/${registrationId}/dsa/reject`;


            /*
            |--------------------------------------------------------------------------
            | Clear Previous Reason
            |--------------------------------------------------------------------------
            */

            reason.value = '';


            /*
            |--------------------------------------------------------------------------
            | Show Modal
            |--------------------------------------------------------------------------
            */

            modal.classList.remove('hidden');

            modal.classList.add('flex');
        }


        function closeDsaRejectModal() {
            const modal =
                document.getElementById(
                    'dsaRejectModal'
                );


            modal.classList.add('hidden');

            modal.classList.remove('flex');
        }


        document.addEventListener(
            'keydown',
            function(event) {

                if (event.key === 'Escape') {

                    closeDsaRejectModal();

                }

            }
        );
    </script>
@endsection
