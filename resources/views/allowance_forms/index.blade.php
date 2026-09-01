@extends('layout.app')

@section('content')
    <div class="min-h-screen">
        <div class="max-w-full mx-auto">

            {{-- ================= HEADER ================= --}}
            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-green-800 via-green-700 to-green-600 shadow-xl mb-4">

                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
                </div>

                <div class="relative px-8 py-8">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">

                        <div>

                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-white/20 px-4 py-1 text-sm font-medium text-white backdrop-blur">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2V7m3 10v-4m3 6H6a2 2 0 01-2-2V7a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2z" />

                                </svg>

                                Finance Management
                            </div>

                            <h1 class="mt-4 text-4xl font-black tracking-tight text-white">

                                Allowance For Participants

                            </h1>

                            <p class="mt-3 text-emerald-100 max-w-3xl">

                                Manage all allowance forms, participant payments,
                                approvals, and financial records from one place.

                            </p>

                        </div>

                        <div class="mt-8 lg:mt-0 flex flex-wrap gap-6">

                            <a href="{{ route('allowance-forms.template.pdf') }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2
                                    bg-red-600 hover:bg-red-700
                                    text-white rounded-lg font-medium">
                                PDF Template
                            </a>

                            <a href="{{ route('allowance-forms.create') }}"
                                class="inline-flex items-center gap-2 rounded-2xl bg-white px-6 py-3 font-bold text-emerald-700 shadow-lg hover:scale-105 transition duration-300">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />

                                </svg>

                                New Allowance

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            {{-- ================= SUMMARY ================= --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-4">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="text-sm text-slate-500 font-medium">

                        Total Forms

                    </div>

                    <div class="mt-3 text-4xl font-black text-slate-900">

                        {{ $allowances->total() }}

                    </div>

                </div>

                <div class="bg-white rounded-2xl border border-emerald-200 shadow-sm p-6">

                    <div class="text-sm text-slate-500 font-medium">

                        Current Page

                    </div>

                    <div class="mt-3 text-4xl font-black text-emerald-600">

                        {{ $allowances->count() }}

                    </div>

                </div>

                <div class="bg-white rounded-2xl border border-blue-200 shadow-sm p-6">

                    <div class="text-sm text-slate-500 font-medium">

                        Participants

                    </div>

                    <div class="mt-3 text-4xl font-black text-blue-600">

                        {{ $allowances->sum(fn($a) => $a->participants->count()) }}

                    </div>

                </div>

                <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-6">

                    <div class="text-sm text-slate-500 font-medium">

                        Total Amount

                    </div>

                    <div class="mt-3 text-3xl font-black text-amber-600">

                        ${{ number_format($allowances->sum(fn($a) => $a->participants->sum('total')), 2) }}

                    </div>

                </div>

            </div>

            {{-- ================= SUCCESS ================= --}}

            @if (session('success'))
                <div
                    class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-6 py-4 flex items-center gap-3 shadow-sm">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                    </svg>

                    <div>

                        <h4 class="font-bold text-emerald-700">

                            Success

                        </h4>

                        <p class="text-sm text-emerald-600">

                            {{ session('success') }}

                        </p>

                    </div>

                </div>
            @endif

            {{-- ================= FILTER ================= --}}

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 mb-4">

                <div class="p-6">

                    <form action="{{ route('allowance-forms.index') }}" method="GET">

                        <div class="grid grid-cols-1 md:grid-cols-7 gap-5">

                            <div class="md:col-span-6">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">

                                    Search

                                </label>

                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search allowance number, activity, venue..."
                                    class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">

                            </div>

                            <div class="flex items-end gap-3">

                                <button type="submit"
                                    class="rounded-xl bg-emerald-600 py-3 px-6 font-semibold text-white hover:bg-emerald-700 transition">

                                    Search

                                </button>

                                <a href="{{ route('allowance-forms.index') }}"
                                    class="rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 hover:bg-slate-100">

                                    Reset

                                </a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-green-600 border-b border-slate-200">

                            <tr class="text-xs uppercase tracking-wider text-white">

                                <th class="px-6 py-4 text-center w-12">
                                    #
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Allowance
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Activity
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Date
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Venue
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Participants
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Total
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($allowances as $allowance)
                                <tr class="hover:bg-emerald-50/40 transition duration-200">

                                    {{-- Number --}}
                                    <td class="px-6 py-2 text-center font-semibold text-slate-500">

                                        {{ $loop->iteration + ($allowances->firstItem() - 1) }}

                                    </td>

                                    {{-- Allowance --}}
                                    <td class="px-6 py-2">

                                        <div>

                                            <div class="font-bold text-slate-900">

                                                {{ $allowance->allowance_no }}

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Activity --}}
                                    <td class="px-6 py-2 w-[450px]">

                                        <div class="font-semibold text-slate-800">

                                            {{ $allowance->activity }}

                                        </div>

                                    </td>

                                    {{-- Date --}}
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-700">
                                            {{ \Carbon\Carbon::parse($allowance->activity_date)->format('d M Y') }}
                                        </div>
                                    </td>

                                    {{-- Venue --}}
                                    <td class="px-6 py-2">

                                        <div class="text-sm text-slate-600">

                                            {{ $allowance->venue ?? '-' }}

                                        </div>

                                    </td>

                                    {{-- Participants --}}
                                    <td class="px-6 py-2 text-center">

                                        <span
                                            class="inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-700 font-bold px-3 py-1">

                                            {{ $allowance->participants->count() }}

                                        </span>

                                    </td>

                                    {{-- Total --}}
                                    <td class="px-6 py-2 text-right">

                                        <div class="font-bold text-lg text-emerald-700">

                                            ${{ number_format($allowance->participants->sum('total'), 2) }}

                                        </div>

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-2 text-center">
                                        <div class="relative inline-block text-left">
                                            <!-- Menu Button -->
                                            <button type="button" onclick="toggleMenu(this)"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg hover:bg-slate-100 transition">
                                                <i class="fas fa-ellipsis-v leading-none"></i>
                                            </button>

                                            <!-- Dropdown -->
                                            <div
                                                class="hidden absolute -right-2 z-50 -mt-3 w-12 rounded-xl border border-slate-200 bg-white shadow-lg">

                                                <a href="{{ route('allowance-forms.show', $allowance) }}"
                                                    class="flex items-center gap-3 px-4 py-2 text-sm text-blue-700 hover:bg-blue-50">

                                                    <!-- Eye -->
                                                    <i class="fas fa-eye w-5 text-blue-600"></i>

                                                </a>

                                                <a href="{{ route('allowance-forms.Print', $allowance->id) }}"
                                                    target="_blank"
                                                    class="flex items-center gap-3 px-4 py-2 text-sm text-purple-600 hover:bg-purple-50">
                                                    <i class="fas fa-print w-5"></i>
                                                </a>

                                                <a href="{{ route('allowance-forms.PDF', $allowance->id) }}"
                                                    target="_blank"
                                                    class="inline-flex items-center px-4 py-2 text-red-600 hover:bg-red-50">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>

                                                <a href="{{ route('allowance-forms.edit', $allowance) }}"
                                                    class="flex items-center gap-3 px-4 py-2 text-sm text-green-600 hover:bg-green-50">

                                                    <i class="fas fa-pen w-5 text-green-600"></i>

                                                </a>

                                                <form action="{{ route('allowance-forms.destroy', $allowance) }}"
                                                    method="POST" class="delete-form">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="flex w-full items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">

                                                        <i class="fas fa-trash w-5"></i>

                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="px-6 py-20 text-center">

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center mb-6">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                                </svg>

                                            </div>

                                            <h3 class="text-xl font-bold text-slate-800">

                                                No Allowance Records

                                            </h3>

                                            <p class="mt-2 text-slate-500 max-w-md">

                                                There are currently no allowance forms matching your search criteria.
                                                Create a new allowance form to get started.

                                            </p>

                                            <a href="{{ route('allowance-forms.create') }}"
                                                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-white font-semibold shadow hover:bg-emerald-700 transition">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4" />

                                                </svg>

                                                Create Allowance

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Footer --}}
                <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div class="text-sm text-slate-500">

                            Showing

                            <span class="font-semibold text-slate-700">

                                {{ $allowances->firstItem() ?? 0 }}

                            </span>

                            -

                            <span class="font-semibold text-slate-700">

                                {{ $allowances->lastItem() ?? 0 }}

                            </span>

                            of

                            <span class="font-semibold text-slate-700">

                                {{ $allowances->total() }}

                            </span>

                            records

                        </div>

                        @if ($allowances->hasPages())
                            <div>

                                {{ $allowances->withQueryString()->links() }}

                            </div>
                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>

    <script>
        function toggleMenu(button) {
            // Close all other menus
            document.querySelectorAll('.dropdown-open').forEach(menu => {
                if (menu !== button.nextElementSibling) {
                    menu.classList.add('hidden');
                    menu.classList.remove('dropdown-open');
                }
            });

            const menu = button.nextElementSibling;
            menu.classList.toggle('hidden');
            menu.classList.toggle('dropdown-open');
        }

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('.dropdown-open').forEach(menu => {
                    menu.classList.add('hidden');
                    menu.classList.remove('dropdown-open');
                });
            }
        });

        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".delete-form").forEach(form => {

                form.addEventListener("submit", function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete Allowance?',
                        text: "This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: '<i class="fas fa-trash"></i> Yes, Delete',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        focusCancel: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });

            });

        });
    </script>
@endsection
