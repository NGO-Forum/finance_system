@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div class="mb-5 rounded-3xl bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 shadow-2xl overflow-hidden">

            <div class="px-8 py-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shadow-lg">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />

                        </svg>

                    </div>

                    <div>

                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full bg-white/20 text-white text-xs font-semibold uppercase tracking-wider">

                            Finance Management

                        </span>

                        <h1 class="mt-3 text-3xl lg:text-4xl font-bold text-white">

                            View Verbal Quote

                            <span class="text-green-100">

                                (FM02-09)

                            </span>

                        </h1>

                        <p class="mt-2 text-green-100">

                            View complete verbal quotation information.

                        </p>

                    </div>

                </div>

                <div class="flex gap-3">

                    <a href="{{ route('verbal-quotes.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-green-700 font-semibold shadow hover:bg-green-50 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                        </svg>

                        Back

                    </a>


                    <!-- Export PDF -->
                    <a href="{{ route('verbal-quotes.pdf', $verbalQuote) }}" target="_blank"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-white bg-red-500 hover:bg-red-600">

                        <i class="fas fa-file-pdf"></i>

                        PDF

                    </a>

                </div>

            </div>

        </div>

        {{-- General Information --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">

            <div class="flex items-center gap-4 mb-6">

                <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />

                    </svg>

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-green-600">

                        General Information

                    </h2>

                    <p class="text-gray-500">

                        Verbal quotation details.

                    </p>

                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">

                {{-- Quote Number --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Quote Number</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->quote_no }}
                    </div>
                </div>

                {{-- Quote Date --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Quote Date</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ \Carbon\Carbon::parse($verbalQuote->quote_date)->format('d M Y') }}
                    </div>
                </div>

                {{-- Requested By --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Requested By</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->requester?->name }}
                    </div>
                </div>

                {{-- Supplier --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Supplier Name</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->supplier_name }}
                    </div>
                </div>

                {{-- Contact --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Contact Information</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->contact_information ?: '-' }}
                    </div>
                </div>

                {{-- Validity --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Validity Date</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->validity_date ? \Carbon\Carbon::parse($verbalQuote->validity_date)->format('d M Y') : '-' }}
                    </div>
                </div>

                {{-- Contact Date --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Contact Date</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->contact_date ? \Carbon\Carbon::parse($verbalQuote->contact_date)->format('d M Y') : '-' }}
                    </div>
                </div>

                {{-- Contact Time --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Contact Time</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->contact_time ? \Carbon\Carbon::parse($verbalQuote->contact_time)->format('h:i A') : '-' }}
                    </div>
                </div>

                {{-- Prepared By --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Prepared By</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->preparer?->name ?? '-' }}
                    </div>
                </div>

                {{-- Prepared Date --}}
                <div>
                    <label class="text-sm font-semibold text-gray-600">Prepared Date</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $verbalQuote->prepared_date ? \Carbon\Carbon::parse($verbalQuote->prepared_date)->format('d M Y') : '-' }}
                    </div>
                </div>

            </div>

        </div>

        {{-- Quotation Items --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mt-5">

            {{-- Header --}}
            <div class="flex items-center gap-4 mb-6">

                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />

                    </svg>

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">

                        Quotation Items

                    </h2>

                    <p class="text-gray-500">

                        List of all quotation items.

                    </p>

                </div>

            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-200">

                <table class="min-w-full">

                    <thead class="bg-gradient-to-r from-green-600 to-emerald-600 text-white">

                        <tr>

                            <th class="px-4 py-3 text-center w-16">
                                #
                            </th>

                            <th class="px-4 py-3 text-left w-40">
                                Budget Line
                            </th>

                            <th class="px-4 py-3 text-left">
                                Description
                            </th>

                            <th class="px-4 py-3 text-center w-24">
                                Qty
                            </th>

                            <th class="px-4 py-3 text-right w-40">
                                Unit Price
                            </th>

                            <th class="px-4 py-3 text-right w-40">
                                Extended Price
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse($verbalQuote->items as $index => $item)
                            <tr class="hover:bg-green-50 transition align-top">

                                <td class="px-4 py-3 text-center font-semibold">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->budget_line ?: '-' }}
                                </td>

                                <td class="px-4 py-3 break-words">
                                    {{ $item->description }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ number_format($item->qty, 2) }}
                                </td>

                                <td class="px-4 py-3 text-right">
                                    $ {{ number_format($item->unit_price, 2) }}
                                </td>

                                <td class="px-4 py-3 text-right font-semibold text-green-700">
                                    $ {{ number_format($item->extended_price, 2) }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-10 text-center text-gray-400">

                                    No quotation items found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                    <tfoot class="bg-green-700 text-white">

                        <tr>

                            <td colspan="5" class="px-4 py-4 text-right font-bold text-lg">

                                Grand Total

                            </td>

                            <td class="px-4 py-4 text-right font-bold text-xl">

                                $ {{ number_format($verbalQuote->items->sum('extended_price'), 2) }}

                            </td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

        {{-- Additional Specifications --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mt-5">

            {{-- Header --}}
            <div class="flex items-center gap-4 mb-6">

                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.586 2.586a2 2 0 112.828 2.828L12 14.828l-4 1 1-4 9.586-9.242z" />

                    </svg>

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">

                        Additional Specifications

                    </h2>

                    <p class="text-gray-500">

                        Additional requirements, remarks and specifications.

                    </p>

                </div>

            </div>

            <div class="rounded-2xl border border-gray-200 bg-gray-50 px-5 py-3 min-h-[140px] leading-7 text-gray-700">

                {{ $verbalQuote->additional_specifications ?: 'No additional specifications.' }}

            </div>

        </div>

        {{-- Prepared Information --}}
        <div class="grid grid-cols-2 gap-5 mt-5">

            <div class="bg-white rounded-2xl shadow border p-6">

                <h3 class="text-lg font-bold text-green-700 mb-3">

                    Requested By

                </h3>

                <table class="w-full">

                    <tr>

                        <td class="py-2 font-semibold w-36">
                            Name
                        </td>

                        <td>
                            {{ $verbalQuote->requester?->name }}
                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 font-semibold">
                            Date
                        </td>

                        <td>
                            {{ $verbalQuote->quote_date ? \Carbon\Carbon::parse($verbalQuote->quote_date)->format('d M Y') : '-' }}
                        </td>

                    </tr>

                </table>

            </div>

            <div class="bg-white rounded-2xl shadow border p-6">

                <h3 class="text-lg font-bold text-green-700 mb-3">

                    Prepared By

                </h3>

                <table class="w-full">

                    <tr>

                        <td class="py-2 font-semibold w-36">
                            Name
                        </td>

                        <td>
                            {{ $verbalQuote->preparer?->name ?? '-' }}
                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 font-semibold">
                            Date
                        </td>

                        <td>
                            {{ $verbalQuote->prepared_date ? \Carbon\Carbon::parse($verbalQuote->prepared_date)->format('d M Y') : '-' }}
                        </td>

                    </tr>

                </table>

            </div>

        </div>

        {{-- Footer Buttons --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-5 mt-5 print:hidden">

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">

                <div class="text-sm text-gray-500">

                    Verbal Quote Number:

                    <span class="font-semibold text-green-700">

                        {{ $verbalQuote->quote_no }}

                    </span>

                </div>

                <div class="flex gap-3">

                    {{-- Back --}}
                    <a href="{{ route('verbal-quotes.index') }}"
                        class="px-6 py-3 rounded-xl border border-gray-300 text-white bg-green-600 hover:bg-green-700 font-semibold">

                        ← Back

                    </a>

                    {{-- Edit --}}
                    <a href="{{ route('verbal-quotes.edit', $verbalQuote) }}"
                        class="px-6 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-semibold shadow">

                        ✏ Edit

                    </a>

                    <!-- Export PDF -->
                    <a href="{{ route('verbal-quotes.pdf', $verbalQuote) }}" target="_blank"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-white bg-red-500 hover:bg-red-600">

                        <i class="fas fa-file-pdf"></i>

                        PDF

                    </a>

                </div>

            </div>

        </div>
    </div>
@endsection
