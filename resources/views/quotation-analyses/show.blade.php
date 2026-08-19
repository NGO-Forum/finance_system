@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        <!-- Header -->
        <div class="mb-5 rounded-3xl bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 shadow-xl">

            <div class="flex justify-between items-center px-8 py-7">

                <div class="flex items-center gap-5">

                    <div class="w-20 h-20 rounded-3xl bg-white/20 flex items-center justify-center">
                        <i class="fas fa-file-signature text-4xl text-white"></i>
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold text-white">
                            Quotation Analysis Details
                        </h1>

                        <p class="text-green-100">
                            View quotation analysis information.
                        </p>
                    </div>

                </div>

                <div class="flex gap-3">

                    {{-- Edit --}}
                    <a href="{{ route('quotation-analyses.edit', $quotationAnalysis) }}"
                        class="inline-flex items-center gap-2 px-7 py-3 rounded-2xl bg-yellow-500 hover:bg-yellow-600 text-white font-semibold shadow-md transition">

                        <i class="fas fa-edit"></i>

                        Edit

                    </a>

                    {{-- PDF --}}
                    <a href="{{ route('quotation-analyses.pdf', $quotationAnalysis) }}" target="_blank"
                        class="inline-flex items-center gap-2 px-7 py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow-md transition">

                        <i class="fas fa-file-pdf"></i>

                        PDF

                    </a>


                    <a href="{{ route('quotation-analyses.index') }}"
                        class="px-6 py-3 rounded-xl bg-white text-green-700 font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </a>


                </div>

            </div>

        </div>

        {{-- ========================= --}}
        {{-- General Information --}}
        {{-- ========================= --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mb-5">

            {{-- Header --}}
            <div class="flex items-center gap-4 mb-8">

                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg">
                    <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        General Information
                    </h2>

                    <p class="text-gray-500">
                        View quotation analysis information.
                    </p>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-5">

                {{-- Item --}}
                <div class="lg:col-span-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-600">
                        Item / Service
                    </label>

                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 font-semibold">
                        {{ $quotationAnalysis->item_name }}
                    </div>
                </div>

                {{-- QA Number --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-600">
                        QA Number
                    </label>

                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                        {{ $quotationAnalysis->qa_no }}
                    </div>
                </div>

                {{-- Date --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-600">
                        Date
                    </label>

                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                        {{ optional($quotationAnalysis->qa_date)->format('d M Y') }}
                    </div>
                </div>

                {{-- Quantity --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-600">
                        Quantity
                    </label>

                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                        {{ $quotationAnalysis->quantity }}
                    </div>
                </div>

                {{-- Prepared By --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-600">
                        Prepared By
                    </label>

                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                        {{ $quotationAnalysis->creator?->name ?? '-' }}
                    </div>
                </div>

                {{-- Department --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-600">
                        Department
                    </label>

                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                        {{ $quotationAnalysis->creator?->department?->name ?? '-' }}
                    </div>
                </div>

                {{-- Created At --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-600">
                        Created At
                    </label>

                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                        {{ $quotationAnalysis->created_at->format('d M Y h:i A') }}
                    </div>
                </div>

            </div>

            {{-- Procurement Purpose --}}
            <div class="mt-6">

                <label class="block mb-2 text-sm font-semibold text-gray-600">
                    Procurement Purpose
                </label>

                <div class="rounded-2xl border border-gray-200 bg-gray-50 px-5 py-3 min-h-[120px] leading-7">
                    {{ $quotationAnalysis->decision_explanation ?: '-' }}
                </div>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- Supplier Information --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mb-5">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">

                <div class="flex items-center gap-4">

                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center shadow-lg">

                        <i class="fas fa-building text-white text-2xl"></i>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800">
                            Supplier Information
                        </h2>

                        <p class="text-gray-500">
                            Supplier information submitted for this quotation analysis.
                        </p>

                    </div>

                </div>

                <span class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-50 text-blue-700 font-semibold">
                    <i class="fas fa-users mr-2"></i>
                    {{ $quotationAnalysis->suppliers->count() }} Suppliers
                </span>

            </div>

            <div class="overflow-x-auto rounded-2xl border border-gray-200">

                <table class="min-w-full">

                    <thead class="bg-gradient-to-r from-green-600 to-emerald-600 text-white">

                        <tr>

                            <th class="px-4 py-3 text-center w-16">
                                #
                            </th>

                            <th class="px-4 py-3 text-left">
                                Supplier Name
                            </th>

                            <th class="px-4 py-3 text-left">
                                Contact Person
                            </th>

                            <th class="px-4 py-3 text-left">
                                Phone Number
                            </th>

                            <th class="px-4 py-3 text-right">
                                Total Score
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse($quotationAnalysis->suppliers as $supplier)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-4 py-4 text-center font-semibold text-gray-700">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-4">

                                    <div class="font-semibold text-gray-900">
                                        {{ $supplier->supplier_name }}
                                    </div>

                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $supplier->contact_person ?: '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $supplier->phone ?: '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 text-right">
                                    {{ $supplier->total_score ?: '-' }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="py-10 text-center text-gray-500">

                                    <i class="fas fa-building text-4xl mb-3 text-gray-300"></i>

                                    <p>No supplier information available.</p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- Evaluation Matrix --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mb-5">

            {{-- Header --}}
            <div class="flex items-center gap-4 mb-6">

                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center shadow-lg">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        Supplier Evaluation Matrix
                    </h2>

                    <p class="text-gray-500">
                        Supplier evaluation results.
                    </p>

                </div>

            </div>

            <div class="overflow-x-auto rounded-2xl border border-gray-200">

                <table class="min-w-full border-collapse">

                    <thead>

                        <tr class="bg-green-600 text-white">

                            <th rowspan="2" class="border px-4 py-3">
                                Criteria
                            </th>

                            @foreach ($quotationAnalysis->suppliers as $supplier)
                                <th colspan="2" class="border px-4 py-3 text-center">
                                    {{ $supplier->supplier_name }}
                                </th>
                            @endforeach

                        </tr>

                        <tr class="bg-green-600 text-white">

                            @foreach ($quotationAnalysis->suppliers as $supplier)
                                <th class="border px-4 py-3 w-[300px]">
                                    Description
                                </th>

                                <th class="border px-4 py-3 w-24">
                                    Score
                                </th>
                            @endforeach

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($criteria as $criterion)
                            <tr>

                                <td class="border px-4 py-3 font-semibold bg-gray-50">
                                    {{ $criterion->name }}
                                </td>

                                @foreach ($quotationAnalysis->suppliers as $supplier)
                                    @php
                                        $score = $supplier->scores->firstWhere(
                                            'quotation_analysis_criterion_id',
                                            $criterion->id,
                                        );
                                    @endphp

                                    <td class="border px-3 py-3">
                                        {{ $score->description ?? '-' }}
                                    </td>

                                    <td class="border px-3 py-3 text-center font-semibold">
                                        {{ $score->score ?? 0 }}
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach

                    </tbody>

                    <tfoot>

                        <tr class="bg-green-50 font-bold">

                            <td class="border px-4 py-3 text-right">
                                Total Score
                            </td>

                            @foreach ($quotationAnalysis->suppliers as $supplier)
                                <td class="border"></td>

                                <td class="border text-center text-lg text-green-700">
                                    {{ $supplier->scores->sum('score') }}
                                </td>
                            @endforeach

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- Recommendation --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mb-5">

            {{-- Header --}}
            <div class="flex items-center gap-4 mb-6">

                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center shadow-lg">
                    <i class="fas fa-award text-white text-2xl"></i>
                </div>

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        Recommendation
                    </h2>

                    <p class="text-gray-500">
                        Recommended supplier based on the evaluation results.
                    </p>

                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Recommended Supplier --}}
                <div>

                    <label class="block mb-2 font-semibold text-gray-700">
                        Recommended Supplier
                    </label>

                    <div class="flex items-center gap-3 rounded-2xl border border-green-300 bg-green-50 px-5 py-4">

                        <div class="w-12 h-12 rounded-xl bg-green-600 text-white flex items-center justify-center">
                            <i class="fas fa-building"></i>
                        </div>

                        <div>
                            <p class="text-xs text-green-600 uppercase font-semibold">
                                Supplier
                            </p>

                            <p class="text-lg font-bold text-green-700">
                                {{ $quotationAnalysis->recommendedSupplier?->supplier_name ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Highest Score --}}
                <div>

                    <label class="block mb-2 font-semibold text-gray-700">
                        Highest Score
                    </label>

                    <div class="flex items-center gap-3 rounded-2xl border border-blue-300 bg-blue-50 px-5 py-4">

                        <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                            <i class="fas fa-star"></i>
                        </div>

                        <div>
                            <p class="text-xs text-blue-600 uppercase font-semibold">
                                Total Score
                            </p>

                            <p class="text-2xl font-bold text-blue-700">
                                {{ $quotationAnalysis->recommendedSupplier?->total_score ?? 0 }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Decision Explanation --}}
            <div class="mt-8">

                <label class="block mb-2 font-semibold text-gray-700">
                    Decision Explanation
                </label>

                <div class="rounded-2xl border border-gray-200 bg-gray-50 px-5 py-3 h-[140px] leading-7 text-gray-700">

                    {{ $quotationAnalysis->decision_explanation ?: 'No decision explanation available.' }}

                </div>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- Evaluation Committee --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mt-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">

                <div class="flex items-center gap-4">

                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">

                        <i class="fas fa-users text-white text-2xl"></i>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800">
                            Evaluation Committee
                        </h2>

                        <p class="text-gray-500">
                            Committee members participating in the quotation evaluation.
                        </p>

                    </div>

                </div>

                <div class="px-5 py-3 rounded-2xl bg-indigo-50 border border-indigo-200 text-indigo-700 font-bold">

                    {{ $quotationAnalysis->committees->count() }} Members

                </div>

            </div>

            @if ($quotationAnalysis->committees->count())
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                    @foreach ($quotationAnalysis->committees as $committee)
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                            {{-- Body --}}
                            <div class="p-6">

                                <div class="flex justify-center mb-6">

                                    <div
                                        class="w-24 h-24 rounded-full bg-gray-100 border-4 border-indigo-100 flex items-center justify-center">

                                        <i class="fas fa-user text-4xl text-indigo-500"></i>

                                    </div>

                                </div>

                                <table class="w-full text-sm">

                                    <tr class="border-b">
                                        <td class="py-3 font-semibold text-gray-500">
                                            Name
                                        </td>

                                        <td class="py-3 text-right font-semibold">
                                            {{ $committee->user?->name }}
                                        </td>
                                    </tr>

                                    <tr class="border-b">
                                        <td class="py-3 font-semibold text-gray-500">
                                            Position
                                        </td>

                                        <td class="py-3 text-right">
                                            {{ $committee->position }}
                                        </td>
                                    </tr>

                                    <tr class="border-b">
                                        <td class="py-3 font-semibold text-gray-500">
                                            Date
                                        </td>

                                        <td class="py-3 text-right">

                                            {{ optional($committee->signed_date)->format('d M Y') ?? '-' }}

                                        </td>
                                    </tr>

                                </table>

                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border-2 border-dashed border-gray-300 py-12 text-center">

                    <i class="fas fa-users text-5xl text-gray-300 mb-4"></i>

                    <h3 class="text-xl font-semibold text-gray-600">
                        No Committee Members
                    </h3>

                    <p class="text-gray-500 mt-2">
                        No committee members have been assigned.
                    </p>

                </div>
            @endif

        </div>

        {{-- ========================================================= --}}
        {{-- Action Buttons --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mt-6">

            <div class="flex flex-col lg:flex-row justify-between items-center gap-5">

                <div>

                    <h3 class="font-semibold text-gray-800">
                        Quotation Analysis
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Review the information or edit this quotation analysis if changes are required.
                    </p>

                </div>

                <div class="flex flex-wrap gap-3">

                    {{-- Edit --}}
                    <a href="{{ route('quotation-analyses.edit', $quotationAnalysis) }}"
                        class="inline-flex items-center gap-2 px-7 py-3 rounded-2xl bg-yellow-500 hover:bg-yellow-600 text-white font-semibold shadow-md transition">

                        <i class="fas fa-edit"></i>

                        Edit

                    </a>

                    {{-- PDF --}}
                    <a href="{{ route('quotation-analyses.pdf', $quotationAnalysis) }}" target="_blank"
                        class="inline-flex items-center gap-2 px-7 py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow-md transition">

                        <i class="fas fa-file-pdf"></i>

                        PDF

                    </a>


                    {{-- Back --}}
                    <a href="{{ route('quotation-analyses.index') }}"
                        class="inline-flex items-center gap-2 px-7 py-3 rounded-2xl bg-green-600 hover:bg-green-700 text-white font-semibold shadow-md transition">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>

    </div>
@endsection
