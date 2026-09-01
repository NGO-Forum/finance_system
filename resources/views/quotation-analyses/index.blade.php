@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div class="mb-4 rounded-3xl bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 shadow-xl overflow-hidden">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 px-8 py-7">

                {{-- Left --}}
                <div class="flex items-center gap-5">

                    <div
                        class="w-20 h-20 rounded-3xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center shadow-lg">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />

                        </svg>

                    </div>

                    <div>

                        <h1 class="text-3xl lg:text-4xl font-bold text-white">

                            Quotation Analysis Summary

                        </h1>

                        <p class="text-green-100 mt-2 text-base">

                            Compare supplier quotations, evaluate scores, and select the recommended supplier.

                        </p>

                    </div>

                </div>

                {{-- Right --}}
                <div class="flex gap-6">

                    <a href="{{ route('quotation-analyses.template.pdf') }}" target="_blank"
                        class="inline-flex items-center gap-2
                            px-4 py-2
                            bg-red-600
                            hover:bg-red-700
                            text-white
                            rounded-lg
                            font-medium">
                        PDF Template
                    </a>

                    <a href="{{ route('quotation-analyses.create') }}"
                        class="inline-flex items-center gap-3 px-7 py-3 rounded-2xl bg-white text-green-700 font-semibold shadow-lg hover:bg-green-50 hover:scale-105 transition-all duration-300">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        Create New Analysis

                    </a>

                </div>

            </div>

        </div>

        {{-- Search & Filter --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 mb-4 overflow-hidden">

            {{-- Header --}}
            <div
                class="bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 px-6 py-4 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl bg-white/20 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-5.2-5.2M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-white">

                            Search Quotation Analysis

                        </h2>

                        <p class="text-green-100 text-sm">

                            Search by QA Number or Item Name

                        </p>

                    </div>

                </div>

                <div class="hidden lg:block text-white text-sm">

                    Total:
                    <span class="font-bold">

                        {{ $quotationAnalyses->total() }}

                    </span>

                    Records

                </div>

            </div>

            {{-- Body --}}
            <div class="p-6">

                <form method="GET">

                    <div class="flex flex-col lg:flex-row gap-4">

                        {{-- Search Box --}}
                        <div class="relative flex-1">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-5.2-5.2M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />

                            </svg>

                            <input type="text" name="search" value="{{ $search }}"
                                placeholder="Search QA Number, Item Name..."
                                class="w-full pl-12 pr-4 py-3 rounded-2xl border border-gray-300 focus:ring-4 focus:ring-green-100 focus:border-green-500 transition">

                        </div>

                        {{-- Search --}}
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-7 py-3 rounded-2xl bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold shadow hover:shadow-xl hover:scale-105 transition-all">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-5.2-5.2M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />

                            </svg>

                            Search

                        </button>

                        {{-- Reset --}}
                        <a href="{{ route('quotation-analyses.index') }}"
                            class="inline-flex items-center justify-center gap-2 px-7 py-3 rounded-2xl border border-gray-300 bg-white text-gray-700 font-semibold hover:bg-gray-50 hover:shadow transition">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h5M20 20v-5h-5M5.6 9A8 8 0 0119 7m-.6 8A8 8 0 015 17" />

                            </svg>

                            Reset

                        </a>

                    </div>

                </form>

            </div>

        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">

            {{-- Card Header --}}
            <div
                class="bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 px-6 py-5 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">

                        <i class="fas fa-table text-white text-xl"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-white">

                            Quotation Analysis List

                        </h2>

                        <p class="text-green-100 text-sm">

                            {{ $quotationAnalyses->total() }} Records Found

                        </p>

                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-green-50">

                        <tr>

                            <th class="px-6 py-4 text-xs uppercase font-bold tracking-wider text-gray-600 text-center">

                                #

                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">

                                QA Number

                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">

                                Date

                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">

                                Item / Service

                            </th>

                            <th class="px-6 py-4 text-xs uppercase font-bold tracking-wider text-gray-600 text-center">

                                Quantity

                            </th>

                            <th class="px-6 py-4 text-xs text-left uppercase font-bold tracking-wider text-gray-600">

                                Recommended Supplier

                            </th>

                            <th class="px-6 py-4 text-xs uppercase text-left font-bold tracking-wider text-gray-600">

                                Created By

                            </th>

                            <th class="px-6 py-4 text-xs uppercase font-bold tracking-wider text-gray-600 text-center">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse($quotationAnalyses as $quotation)
                            <tr class="hover:bg-green-50 transition text-sm">

                                <td class="px-6 py-2 text-center font-semibold">

                                    {{ $loop->iteration + ($quotationAnalyses->firstItem() - 1) }}

                                </td>

                                <td class="px-6 py-2">

                                    <span class="font-semibold text-green-700">

                                        {{ $quotation->qa_no }}

                                    </span>

                                </td>

                                <td class="px-6 py-2">

                                    {{ $quotation->qa_date->format('d M Y') }}

                                </td>

                                <td class="px-6 py-2 w-[400px]">

                                    <span class="text-gray-700 line-clamp-1">{{ $quotation->item_name }}</span>

                                </td>

                                <td class="px-6 py-2 text-center">

                                    {{ $quotation->quantity }}

                                </td>

                                <td class="px-6 py-2 w-[400px]">

                                    @if ($quotation->recommendedSupplier)
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold line-clamp-1">

                                            {{ $quotation->recommendedSupplier->supplier_name }}

                                        </span>
                                    @else
                                        <span class="text-gray-400">

                                            -

                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-2">

                                    {{ $quotation->creator?->name }}

                                </td>

                                {{-- Action --}}
                                <td class="px-6 py-2 text-center">

                                    <div class="relative inline-block" x-data="{ open: false }">

                                        {{-- 3 Dot --}}
                                        <button @click="open=!open" @click.away="open=false"
                                            class="w-10 h-10 rounded-lg hover:bg-gray-100 flex items-center justify-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600"
                                                fill="currentColor" viewBox="0 0 20 20">

                                                <path
                                                    d="M10 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3" />

                                            </svg>

                                        </button>

                                        {{-- Menu --}}
                                        <div x-show="open" x-transition
                                            class="absolute -right-1 -mt-4 w-12 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden">

                                            {{-- View --}}
                                            <a href="{{ route('quotation-analyses.show', $quotation) }}"
                                                class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 text-blue-700">

                                                <i class="fas fa-eye"></i>


                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('quotation-analyses.edit', $quotation) }}"
                                                class="flex items-center gap-3 px-4 py-3 hover:bg-green-50 text-green-700">

                                                <i class="fas fa-edit"></i>



                                            </a>

                                            {{-- PDF --}}
                                            <a href="{{ route('quotation-analyses.pdf', $quotation) }}" target="_blank"
                                                class="flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-red-700">

                                                <i class="fas fa-file-pdf"></i>



                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('quotation-analyses.destroy', $quotation) }}"
                                                method="POST" class="delete-form">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="w-full text-left flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-red-600">

                                                    <i class="fas fa-trash"></i>



                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <i class="fas fa-folder-open text-5xl text-gray-300 mb-4"></i>

                                        <h3 class="text-lg font-semibold text-gray-600">

                                            No quotation analysis found.

                                        </h3>

                                        <p class="text-gray-400 mt-1">

                                            Click "Create New" to add one.

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
        <div class="mt-4 rounded-b-2xl border-x border-b border-gray-100 px-6 py-4">

            {{ $quotationAnalyses->withQueryString()->links() }}

        </div>

    </div>

    {{-- SweetAlert Success --}}
    @if (session('success'))
        <script>
            Swal.fire({

                icon: 'success',

                title: 'Success',

                text: "{{ session('success') }}",

                timer: 2500,

                showConfirmButton: false

            });
        </script>
    @endif


    {{-- SweetAlert Delete --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.delete-form').forEach(form => {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({

                        title: 'Delete Record?',

                        text: "This action cannot be undone.",

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonColor: '#16a34a',

                        cancelButtonColor: '#dc2626',

                        confirmButtonText: 'Yes, Delete',

                        cancelButtonText: 'Cancel'

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
