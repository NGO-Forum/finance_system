@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div
            class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 bg-gradient-to-r from-green-600 to-emerald-500 rounded-2xl shadow-lg p-6 text-white">

            {{-- Left --}}
            <div class="flex items-center gap-4">

                <div class="flex items-center justify-center w-16 h-16 bg-white/20 rounded-2xl backdrop-blur-sm">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-6h13M9 5h13M3 5h.01M3 11h.01M3 17h.01" />

                    </svg>

                </div>

                <div>

                    <h1 class="text-3xl font-bold tracking-wide">
                        DSA Claim
                    </h1>

                    <p class="mt-1 text-green-100 text-sm">
                        Daily Subsistence Allowance Claim Management System
                    </p>

                </div>

            </div>

            {{-- Right --}}
            <div class="flex flex-wrap gap-3">

                <a href="{{ route('dsa-claims.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-green-700 font-semibold shadow-md hover:bg-green-50 hover:shadow-lg transition duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                    </svg>

                    Create DSA Claim

                </a>

            </div>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mt-6 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">

                {{ session('success') }}

            </div>
        @endif

        {{-- Search Card --}}
        <div class="mt-4 bg-white rounded-2xl shadow-lg border border-gray-100">

            <div class="px-6 py-4 border-b bg-green-50 rounded-t-2xl">
                <h2 class="text-lg font-semibold text-gray-800">
                    Search DSA Claims
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Search by Claim Number, Requester, Budget Code, Donor, or Status.
                </p>
            </div>

            <form method="GET" action="{{ route('dsa-claims.index') }}" class="p-6">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

                    {{-- Search --}}
                    <div class="lg:col-span-10">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Search
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-5.2-5.2m2.2-5.3a7 7 0 11-14 0 7 7 0 0114 0z" />

                                </svg>

                            </div>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search Claim No, Requester, Budget Code, Donor..."
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">

                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="lg:col-span-2 flex items-end gap-3">

                        <button type="submit"
                            class="flex-1 inline-flex justify-center items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-3 rounded-xl shadow transition duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-5.2-5.2m2.2-5.3a7 7 0 11-14 0 7 7 0 0114 0z" />

                            </svg>

                            Search

                        </button>

                        <a href="{{ route('dsa-claims.index') }}"
                            class="inline-flex justify-center items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-3 rounded-xl shadow transition duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356-2A8.001 8.001 0 005.582 9M20 20v-5h-.581m0 0A8.003 8.003 0 014.582 15" />

                            </svg>

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

        {{-- Table Card --}}
        <div class="mt-4 bg-white rounded-xl shadow overflow-hidden">

            <div
                class="px-6 py-4 border-b bg-gradient-to-r from-green-600 to-emerald-500 text-white flex justify-between items-center">

                <div>

                    <h2 class="text-lg font-semibold">

                        DSA Claim List

                    </h2>

                    <p class="text-sm text-green-100">

                        Total Records : {{ $claims->total() }}

                    </p>

                </div>

                <span class="bg-white/20 px-4 py-2 rounded-xl font-semibold">

                    {{ $claims->count() }} Showing

                </span>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-green-100">

                        <tr>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                #
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                DSA Claim No
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                Request Date
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                Requester
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                Department
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                Budget Code
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                Donor
                            </th>

                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase">
                                Grand Total
                            </th>

                            <th class="px-4 py-3 text-center text-xs font-semibold uppercase">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($claims as $claim)
                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-2">
                                    {{ $loop->iteration + ($claims->firstItem() - 1) }}
                                </td>

                                <td class="px-4 py-2 font-semibold text-green-700">
                                    {{ $claim->claim_no }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $claim->date_requested->format('d-M-Y') }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $claim->user?->name }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $claim->department?->name }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $claim->budget_code }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $claim->donor }}
                                </td>

                                <td class="px-4 py-2 text-right font-semibold">
                                    ${{ number_format($claim->grand_total, 2) }}
                                </td>

                                <td class="px-4 py-2 text-center">

                                    <div class="relative inline-block text-left">

                                        <button type="button" onclick="toggleMenu({{ $claim->id }})"
                                            class="p-2 rounded-lg hover:bg-gray-100 transition">

                                            <i class="fas fa-ellipsis-v leading-none"></i>

                                        </button>

                                        <div id="menu-{{ $claim->id }}"
                                            class="hidden absolute -right-3 -mt-4 w-12 bg-white rounded-xl shadow-xl border border-gray-200 z-50">

                                            <a href="{{ route('dsa-claims.pdf', $claim) }}" target="_blank"
                                                class="flex items-center gap-3 px-4 py-3 text-sm text-red-600 rounded-lg hover:bg-red-50">

                                                <i class="fas fa-file-pdf mr-2"></i>

                                            </a>

                                            <a href="{{ route('dsa-claims.show', $claim) }}"
                                                class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-blue-50 hover:text-blue-600">

                                                <i class="fas fa-eye w-5 text-blue-600"></i>

                                            </a>

                                            <a href="{{ route('dsa-claims.edit', $claim) }}"
                                                class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-green-50 hover:text-green-600">

                                                <i class="fas fa-pen w-5 text-green-600"></i>

                                            </a>

                                            <form id="delete-form-{{ $claim->id }}"
                                                action="{{ route('dsa-claims.destroy', $claim) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button" onclick="deleteClaim({{ $claim->id }})"
                                                    class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50">

                                                    <i class="fas fa-trash w-5"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="10" class="text-center py-8 text-gray-500">

                                    No DSA Claims Found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="px-6 py-4 border-t">

                {{ $claims->withQueryString()->links() }}

            </div>

        </div>

    </div>

    <script>
        function toggleMenu(id) {
            document.querySelectorAll('[id^="menu-"]').forEach(menu => {

                if (menu.id !== 'menu-' + id) {
                    menu.classList.add('hidden');
                }

            });

            document.getElementById('menu-' + id).classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {

            if (!e.target.closest('.relative')) {

                document.querySelectorAll('[id^="menu-"]').forEach(menu => {

                    menu.classList.add('hidden');

                });

            }

        });

        function deleteClaim(id) {
            Swal.fire({

                title: 'Delete DSA Claim?',

                text: "You won't be able to recover it.",

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#d33',

                cancelButtonColor: '#6b7280',

                confirmButtonText: 'Yes, Delete',

                cancelButtonText: 'Cancel'

            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('delete-form-' + id).submit();

                }

            });
        }
    </script>
@endsection
