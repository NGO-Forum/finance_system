@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div class="mb-4 rounded-3xl bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 shadow-xl overflow-hidden">

            <div class="px-8 py-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                {{-- Title --}}
                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />

                        </svg>

                    </div>

                    <div>

                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white mb-2">

                            FINANCE MANAGEMENT

                        </span>

                        <h1 class="text-3xl font-bold text-white">

                            Verbal Quote Management

                        </h1>

                        <p class="mt-2 text-green-100">

                            Create, manage and export supplier verbal quotations.

                        </p>

                    </div>

                </div>

                {{-- Button --}}
                <div>

                    <a href="{{ route('verbal-quotes.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white text-green-700 font-semibold rounded-xl shadow-lg hover:bg-green-50 transition-all duration-300 hover:scale-105">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        Create Verbal Quote

                    </a>

                </div>

            </div>

        </div>

        {{-- Search Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 mb-4">

            <form method="GET">

                <div class="flex flex-col lg:flex-row gap-4">

                    {{-- Search Input --}}
                    <div class="relative flex-1">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />

                            </svg>

                        </span>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by Quote No or Supplier Name..."
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                    </div>

                    {{-- Search Button --}}
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold shadow-md hover:shadow-lg transition-all duration-300">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />

                        </svg>

                        Search

                    </button>

                    {{-- Reset --}}
                    @if (request()->filled('search'))
                        <a href="{{ route('verbal-quotes.index') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-gray-300 bg-white hover:bg-gray-100 text-gray-700 font-semibold transition">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />

                            </svg>

                            Clear

                        </a>
                    @endif

                </div>

            </form>

        </div>

        {{-- Success --}}
        @if (session('success'))
            <div class="mb-5 rounded-xl bg-green-100 border border-green-300 text-green-700 px-4 py-3">

                {{ session('success') }}

            </div>
        @endif

        {{-- Table Card --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

            {{-- Card Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b bg-gradient-to-r from-green-600 to-green-700">

                <div>

                    <h2 class="text-xl font-bold text-white">
                        Verbal Quote List
                    </h2>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    {{-- Table Header --}}
                    <thead class="bg-green-100">

                        <tr>

                            <th class="px-4 py-4 text-xs uppercase font-bold tracking-wider text-gray-600">
                                #
                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">
                                Quote No
                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">
                                Date
                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">
                                Supplier
                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">
                                Contact
                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">
                                Requested By
                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">
                                Prepared By
                            </th>

                            <th class="px-6 py-4 text-right text-xs uppercase font-bold tracking-wider text-gray-600">
                                Grand Total
                            </th>

                            <th class="px-6 py-4 text-center text-xs uppercase font-bold tracking-wider text-gray-600">
                                Action
                            </th>

                        </tr>

                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">

                        @forelse($verbalQuotes as $quote)
                            <tr class="hover:bg-green-50 even:bg-gray-50 transition duration-200 text-sm">

                                {{-- No --}}
                                <td class="px-6 py-2 text-gray-700">
                                    {{ $loop->iteration + $verbalQuotes->firstItem() - 1 }}
                                </td>

                                {{-- Quote No --}}
                                <td class="px-6 py-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm">
                                        {{ $quote->quote_no }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-2 text-gray-700">
                                    {{ $quote->quote_date->format('d M Y') }}
                                </td>

                                {{-- Supplier --}}
                                <td class="px-6 py-2">

                                    <div class="font-semibold text-gray-800">
                                        {{ $quote->supplier_name }}
                                    </div>
                                </td>

                                {{-- Contact --}}
                                <td class="px-6 py-2 text-gray-700">
                                    {{ $quote->contact_information ?? '-' }}
                                </td>

                                {{-- Requested By --}}
                                <td class="px-6 py-2 text-gray-700">

                                    {{-- If requested_by stores ID --}}
                                    {{ $quote->requester?->name }}

                                </td>

                                {{-- Prepared By --}}
                                <td class="px-6 py-2 text-gray-700">

                                    {{-- If prepared_by stores ID --}}
                                    {{ $quote->preparer?->name }}

                                </td>

                                {{-- Grand Total --}}
                                <td class="px-6 py-2 text-right">

                                    <span class="text-lg font-bold text-green-700">

                                        ${{ number_format($quote->grand_total, 2) }}

                                    </span>

                                </td>

                                {{-- Action --}}
                                <td class="px-6 py-2 text-center">
                                    <div class="relative inline-block" x-data="{ open: false }">

                                        <!-- 3 Dots Button -->
                                        <button @click="open = !open" @click.away="open = false"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600"
                                                fill="currentColor" viewBox="0 0 20 20">

                                                <path
                                                    d="M10 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />

                                            </svg>
                                        </button>

                                        <!-- Dropdown -->
                                        <div x-show="open" x-transition
                                            class="absolute -right-1 -mt-4 w-12 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden">

                                            <!-- View -->
                                            <a href="{{ route('verbal-quotes.show', $quote) }}"
                                                class="flex items-center gap-3 px-3 py-3 text-sm text-blue-700 hover:bg-blue-50 hover:text-blue-600">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0" />

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z" />

                                                </svg>


                                            </a>

                                            <!-- Export PDF -->
                                            <a href="{{ route('verbal-quotes.pdf', $quote) }}" target="_blank"
                                                class="flex items-center gap-3 px-4 py-3 text-sm text-red-700 hover:bg-red-50">

                                                <i class="fas fa-file-pdf"></i>

                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('verbal-quotes.edit', $quote) }}"
                                                class="edit-btn flex items-center gap-3 px-3 py-3 text-sm text-green-700 hover:bg-green-50 hover:text-green-600">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586" />

                                                </svg>


                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('verbal-quotes.destroy', $quote) }}" method="POST"
                                                class="delete-form">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="w-full flex items-center gap-3 px-3 py-3 text-sm text-red-600 hover:bg-red-50">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7H5m5 4v6m4-6v6M6 7l1-3h10l1 3m-1 0v12a2 2 0 01-2 2H9a2 2 0 01-2-2V7" />

                                                    </svg>

                                                </button>

                                            </form>

                                        </div>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-4xl">

                                            📄

                                        </div>

                                        <h3 class="mt-5 text-xl font-semibold text-gray-700">

                                            No Verbal Quotes Found

                                        </h3>

                                        <p class="mt-2 text-gray-500">

                                            Click <strong>Create Verbal Quote</strong> to add your first quotation.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Pagination --}}
        <div class="mt-6">

            {{ $verbalQuotes->links() }}

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.delete-form').forEach(form => {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete Verbal Quote?',
                        text: "This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, Delete',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {

                        if (result.isConfirmed) {
                            form.submit();
                        }

                    });

                });

            });

        });

        document.querySelectorAll('.edit-btn').forEach(button => {

            button.addEventListener('click', function(e) {

                e.preventDefault();

                const url = this.href;

                Swal.fire({
                    title: 'Edit Verbal Quote?',
                    text: 'You will be redirected to the edit page.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#16a34a',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, Edit',
                    cancelButtonText: 'Cancel'
                }).then((result) => {

                    if (result.isConfirmed) {
                        window.location.href = url;
                    }

                });

            });

        });
    </script>
@endsection
