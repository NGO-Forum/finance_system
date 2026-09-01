@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div class="mb-6 rounded-3xl bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 shadow-xl overflow-hidden">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 px-8 py-7">

                <div class="flex items-center gap-5">

                    <div
                        class="w-20 h-20 rounded-3xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center">

                        <i class="fas fa-file-signature text-4xl text-white"></i>

                    </div>

                    <div>

                        <h1 class="text-3xl lg:text-4xl font-bold text-white">

                            Quotation Analysis Summary

                        </h1>

                        <p class="text-green-100 mt-2">

                            Compare supplier quotations and recommend the best supplier.

                        </p>

                    </div>

                </div>

                <a href="{{ route('quotation-analyses.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white text-green-700 font-semibold hover:bg-green-50 transition">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

        </div>

        <form action="{{ route('quotation-analyses.update', $quotationAnalysis) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ========================= --}}
            {{-- General Information --}}
            {{-- ========================= --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6">

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

                            Enter the quotation analysis information.

                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6">

                    {{-- Item --}}
                    <div class="lg:col-span-6">

                        <label class="block mb-2 font-semibold text-gray-700">

                            Item / Service

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" name="item_name" value="{{ old('item_name', $quotationAnalysis->item_name) }}"
                            placeholder="Example: Laptop, Printer, Office Chair..."
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        @error('item_name')
                            <p class="text-red-500 text-sm mt-1">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                    {{-- QA Number --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            QA Number

                        </label>

                        <input type="text" value="{{ $quotationAnalysis->qa_no }}" readonly
                            class="w-full rounded-xl bg-gray-100 border-gray-300 font-semibold">

                    </div>

                    {{-- Date --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Date

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="date" name="qa_date"
                            value="{{ old('qa_date', $quotationAnalysis->qa_date->format('Y-m-d')) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        @error('qa_date')
                            <p class="text-red-500 text-sm mt-1">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                    {{-- Quantity --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Quantity

                        </label>

                        <input type="number" name="quantity" value="{{ old('quantity', $quotationAnalysis->quantity) }}"
                            min="1"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                    </div>

                    {{-- Prepare By --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Prepared By

                        </label>

                        <input type="text" value="{{ auth()->user()->name }}" readonly
                            class="w-full rounded-xl bg-gray-100 border-gray-300">

                    </div>

                    {{-- Department --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Department

                        </label>

                        <input type="text" value="{{ auth()->user()->department->name ?? '-' }}" readonly
                            class="w-full rounded-xl bg-gray-100 border-gray-300">

                    </div>

                    {{-- Created Time --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Created At

                        </label>

                        <input type="text" value="{{ now()->format('d M Y') }}" readonly
                            class="w-full rounded-xl bg-gray-100 border-gray-300">

                    </div>

                </div>

                {{-- Purpose --}}
                <div class="mt-6">

                    <label class="block mb-2 font-semibold text-gray-700">

                        Procurement Purpose

                    </label>

                    <textarea rows="4" name="purpose" placeholder="Describe the purpose of this quotation analysis..."
                        class="w-full rounded-2xl border-gray-300 focus:ring-green-500 focus:border-green-500 resize-none">{{ old('decision_explanation', $quotationAnalysis->decision_explanation) }}</textarea>

                </div>

            </div>

            {{-- ========================================================= --}}
            {{-- Supplier Information --}}
            {{-- ========================================================= --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mt-6">

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

                                Add one or more suppliers for comparison.

                            </p>

                        </div>

                    </div>

                    <button type="button" id="addSupplier"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition">

                        <i class="fas fa-plus"></i>

                        Add Supplier

                    </button>

                </div>

                <div class="overflow-x-auto rounded-2xl border border-gray-200">

                    <table class="min-w-full" id="supplierTable">

                        <thead class="bg-green-600 text-white">

                            <tr>

                                <th class="px-4 py-3 w-16 text-center">
                                    #
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Supplier Name
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Contact Person
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Phone
                                </th>

                                <th class="px-4 py-3 w-24 text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($quotationAnalysis->suppliers as $supplier)
                                <tr class="supplier-row">

                                    <td class="border px-3 py-3 text-center supplier-no">

                                        {{ $loop->iteration }}

                                    </td>

                                    <td class="border p-2 w-[350px]">

                                        <input type="text" name="supplier_name[]"
                                            value="{{ old('supplier_name.' . $loop->index, $supplier->supplier_name) }}"
                                            class="supplier-name w-full rounded-xl border-gray-300"
                                            placeholder="Supplier Name">

                                    </td>

                                    <td class="border p-2 w-[650px]">

                                        <input type="text" name="contact_person[]"
                                            value="{{ old('contact_person.' . $loop->index, $supplier->contact_person) }}"
                                            class="w-full rounded-xl border-gray-300"
                                            placeholder="Enter contact person....">

                                    </td>

                                    <td class="border p-2">

                                        <input type="text" name="phone[]"
                                            value="{{ old('phone.' . $loop->index, $supplier->phone) }}"
                                            class="w-full rounded-xl border-gray-300" placeholder="(+855) XXX XXX XXXX">

                                    </td>

                                    <td class="border text-center">

                                        <button type="button"
                                            class="removeSupplier w-10 h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr class="supplier-row">

                                    <td class="border text-center supplier-no">1</td>

                                    <td class="border p-2">

                                        <input type="text" name="supplier_name[]"
                                            class="supplier-name w-full rounded-xl border-gray-300">

                                    </td>

                                    <td class="border p-2">

                                        <input type="text" name="contact_person[]"
                                            class="w-full rounded-xl border-gray-300">

                                    </td>

                                    <td class="border p-2">

                                        <input type="text" name="phone[]" class="w-full rounded-xl border-gray-300">

                                    </td>

                                    <td class="border text-center">

                                        <button type="button"
                                            class="removeSupplier w-10 h-10 rounded-lg bg-red-500 text-white">

                                            <i class="fas fa-trash"></i>

                                        </button>

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
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mt-6">

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

                            Evaluate every supplier using the procurement criteria.

                        </p>

                    </div>

                </div>

                <div class="overflow-x-auto rounded-2xl border border-gray-200">

                    <table class="min-w-full border-collapse" id="evaluationTable">

                        <thead>

                        </thead>

                        <tbody>

                        </tbody>

                        <tfoot>

                        </tfoot>

                    </table>

                </div>

            </div>

            {{-- ========================================================= --}}
            {{-- Recommendation --}}
            {{-- ========================================================= --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mt-6">

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

                            The supplier with the highest score will be recommended automatically.

                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- Recommended Supplier --}}
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            Recommended Supplier
                            <span class="text-red-500">*</span>
                        </label>

                        <select name="recommended_supplier_no" id="recommended_supplier" required
                            class="w-full rounded-xl
                                border-green-300
                                focus:border-green-500
                                focus:ring-green-500
                                font-bold">
                            <option value="">
                                Select Recommended Supplier
                            </option>
                        </select>

                        @error('recommended_supplier_no')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Highest Score --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Highest Score

                        </label>

                        <input id="highest_score" type="text" readonly
                            class="w-full rounded-xl bg-blue-50 border-blue-300 text-blue-700 font-bold">

                    </div>

                </div>

                <div class="mt-6">

                    <label class="block mb-2 font-semibold text-gray-700">

                        Decision Explanation

                    </label>

                    <textarea name="decision_explanation" rows="5" class="w-full rounded-2xl border-gray-300 resize-none"
                        placeholder="Explain why this supplier is recommended...">{{ old('decision_explanation', $quotationAnalysis->decision_explanation) }}</textarea>

                </div>

            </div>

            {{-- ========================================================= --}}
            {{-- Committee --}}
            {{-- ========================================================= --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mt-6">

                <div class="flex items-center justify-between mb-6">

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

                                Committee members participating in this evaluation.

                            </p>

                        </div>

                    </div>

                    <button type="button" id="addCommittee"
                        class="px-5 py-3 rounded-xl bg-green-600 text-white font-semibold">

                        <i class="fas fa-plus"></i>

                        Add Member

                    </button>

                </div>

                <div>

                    <table class="min-w-full border" id="committeeTable">

                        <thead class="bg-green-600 text-white">

                            <tr>

                                <th class="border px-4 py-3 w-16">#</th>

                                <th class="border px-4 py-3 text-left">Committee Member</th>

                                <th class="border px-4 py-3 text-left">Position</th>

                                <th class="border px-4 py-3 text-left">Signed Date</th>

                                <th class="border px-4 py-3 w-20">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($quotationAnalysis->committees as $committee)
                                <tr class="committee-row">

                                    <td class="border text-center committee-no">

                                        {{ $loop->iteration }}

                                    </td>

                                    <td class="border p-2 relative">

                                        <input type="hidden" name="committee_user[]" class="committee-user-id"
                                            value="{{ $committee->user_id }}">

                                        <input type="text"
                                            class="committee-user-name w-full rounded-xl border-gray-300"
                                            value="{{ $committee->user->name ?? '' }}"
                                            placeholder="Type committee member..." autocomplete="off">

                                        <div
                                            class="committee-user-list hidden absolute z-50 w-full mt-1 bg-white border rounded-xl shadow-lg max-h-60 overflow-y-auto">

                                            @foreach ($users as $user)
                                                <div class="committee-user-item px-4 py-2 cursor-pointer hover:bg-green-100"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                                    {{ $user->name }}
                                                </div>
                                            @endforeach

                                        </div>

                                    </td>

                                    <td class="border p-2">

                                        <input type="text" name="committee_position[]"
                                            class="w-full rounded-xl border-gray-300" value="{{ $committee->position }}">

                                    </td>

                                    <td class="border p-2">

                                        <input type="date" name="committee_date[]"
                                            class="w-full rounded-xl border-gray-300"
                                            value="{{ optional($committee->signed_date)->format('Y-m-d') }}">

                                    </td>

                                    <td class="border text-center">

                                        <button type="button"
                                            class="removeCommittee w-10 h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr class="committee-row">

                                    <td class="border text-center committee-no">

                                        1

                                    </td>

                                    <td class="border p-2 relative">

                                        <input type="hidden" name="committee_user[]" class="committee-user-id">

                                        <input type="text"
                                            class="committee-user-name w-full rounded-xl border-gray-300"
                                            placeholder="Type committee member..." autocomplete="off">

                                        <div
                                            class="committee-user-list hidden absolute z-50 w-full mt-1 bg-white border rounded-xl shadow-lg max-h-60 overflow-y-auto">

                                            @foreach ($users as $user)
                                                <div class="committee-user-item px-4 py-2 cursor-pointer hover:bg-green-100"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                                    {{ $user->name }}
                                                </div>
                                            @endforeach

                                        </div>

                                    </td>

                                    <td class="border p-2">

                                        <input type="text" name="committee_position[]"
                                            class="w-full rounded-xl border-gray-300">

                                    </td>

                                    <td class="border p-2">

                                        <input type="date" name="committee_date[]"
                                            class="w-full rounded-xl border-gray-300">

                                    </td>

                                    <td class="border text-center">

                                        <button type="button"
                                            class="removeCommittee w-10 h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- ========================================================= --}}
            {{-- Action Buttons --}}
            {{-- ========================================================= --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mt-6">

                <div class="flex flex-col lg:flex-row justify-between items-center gap-5">

                    <div>

                        <h3 class="font-semibold text-red-600">

                            Important

                        </h3>

                        <p class="text-gray-500">

                            Please verify all supplier information and committee members before saving.

                        </p>

                    </div>

                    <div class="flex gap-3">

                        <a href="{{ route('quotation-analyses.index') }}"
                            class="px-7 py-3 rounded-2xl border border-gray-300 bg-white hover:bg-gray-100 font-semibold">

                            <i class="fas fa-arrow-left mr-2"></i>

                            Cancel

                        </a>

                        <button type="submit"
                            class="px-8 py-3 rounded-2xl bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold shadow-lg hover:scale-105 transition">

                            <i class="fas fa-save mr-2"></i>

                            Save

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ============================================================
               DATA FROM LARAVEL
            ============================================================ */

            const criteria = @json($criteria);

            const suppliersData = @json($suppliersData);


            /* ============================================================
               ELEMENTS
            ============================================================ */

            const supplierTable =
                document.querySelector('#supplierTable tbody');

            const evaluationTable =
                document.getElementById('evaluationTable');

            const recommendedSupplier =
                document.getElementById('recommended_supplier');

            const highestScore =
                document.getElementById('highest_score');

            const committeeBody =
                document.querySelector('#committeeTable tbody');


            /* ============================================================
               SAFE HTML
            ============================================================ */

            function escapeHtml(value) {

                return String(value ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');

            }


            /* ============================================================
               SUPPLIERS
            ============================================================ */

            function getSuppliers() {

                if (!supplierTable) {
                    return [];
                }

                return Array.from(
                    supplierTable.querySelectorAll(
                        '.supplier-row'
                    )
                );

            }


            function updateSupplierNumber() {

                getSuppliers().forEach(
                    function(row, index) {

                        const number =
                            row.querySelector(
                                '.supplier-no'
                            );

                        if (number) {
                            number.textContent =
                                index + 1;
                        }

                    }
                );

            }


            /* ============================================================
               GET SUPPLIER SCORE
            ============================================================ */

            function getSupplierScore(index) {

                let total = 0;

                const scores =
                    document.querySelectorAll(
                        `select.score[data-supplier-index="${index}"]`
                    );

                scores.forEach(function(select) {

                    const value =
                        parseInt(
                            select.value,
                            10
                        );

                    if (!isNaN(value)) {
                        total += value;
                    }

                });

                return total;

            }


            /* ============================================================
               FIND SAVED RECOMMENDED SUPPLIER
            ============================================================ */

            function getSavedRecommendedNo() {

                const saved =
                    suppliersData.find(
                        function(supplier) {

                            return (
                                supplier.recommended === true ||
                                supplier.recommended === 1
                            );

                        }
                    );

                if (!saved) {
                    return '';
                }

                return String(
                    saved.supplier_no
                );

            }


            /* ============================================================
               RECOMMENDED SUPPLIER
            ============================================================ */

            function updateRecommendedSupplier(
                preserveValue = true
            ) {

                if (!recommendedSupplier) {
                    return;
                }


                const oldValue =
                    preserveValue ?
                    recommendedSupplier.value :
                    getSavedRecommendedNo();


                recommendedSupplier.innerHTML = `
            <option value="">
                Select Recommended Supplier
            </option>
        `;


                getSuppliers().forEach(
                    function(row, index) {

                        const input =
                            row.querySelector(
                                '.supplier-name'
                            );

                        const name =
                            input?.value.trim();


                        if (!name) {
                            return;
                        }


                        const option =
                            document.createElement(
                                'option'
                            );


                        option.value =
                            index + 1;


                        option.textContent =
                            `Supplier ${index + 1} - ${name}`;


                        recommendedSupplier.appendChild(
                            option
                        );

                    }
                );


                /*
                 * Restore selected supplier
                 */

                if (
                    oldValue &&
                    Array.from(
                        recommendedSupplier.options
                    ).some(
                        function(option) {

                            return (
                                option.value ===
                                String(oldValue)
                            );

                        }
                    )
                ) {

                    recommendedSupplier.value =
                        String(oldValue);

                }


                updateSelectedSupplierScore();

            }


            /* ============================================================
               SELECTED SUPPLIER SCORE
            ============================================================ */

            function updateSelectedSupplierScore() {

                if (!highestScore) {
                    return;
                }


                const selectedValue =
                    recommendedSupplier?.value;


                if (!selectedValue) {

                    highestScore.value = '';

                    return;

                }


                const selectedIndex =
                    parseInt(
                        selectedValue,
                        10
                    ) - 1;


                const suppliers =
                    getSuppliers();


                if (
                    selectedIndex < 0 ||
                    !suppliers[selectedIndex]
                ) {

                    highestScore.value = '';

                    return;

                }


                highestScore.value =
                    getSupplierScore(
                        selectedIndex
                    );

            }


            /* ============================================================
               BUILD EVALUATION TABLE
            ============================================================ */

            function buildEvaluationTable() {

                if (!evaluationTable) {
                    return;
                }


                const thead =
                    evaluationTable.querySelector(
                        'thead'
                    );

                const tbody =
                    evaluationTable.querySelector(
                        'tbody'
                    );

                const tfoot =
                    evaluationTable.querySelector(
                        'tfoot'
                    );


                if (
                    !thead ||
                    !tbody ||
                    !tfoot
                ) {
                    return;
                }


                const suppliers =
                    getSuppliers();


                /* ========================================================
                   HEADER
                ======================================================== */

                let header = `
            <tr class="bg-green-600 text-white">

                <th
                    rowspan="2"
                    class="border px-4 py-3 text-left"
                >
                    Criteria
                </th>
        `;


                suppliers.forEach(
                    function(row, index) {

                        const name =
                            row.querySelector(
                                '.supplier-name'
                            )?.value.trim() ||
                            `Supplier ${index + 1}`;


                        header += `
                    <th
                        colspan="2"
                        class="border px-4 py-3
                               text-center"
                    >
                        Supplier ${index + 1}
                        <br>

                        <span class="font-normal">
                            ${escapeHtml(name)}
                        </span>
                    </th>
                `;

                    }
                );


                header += `
            </tr>

            <tr class="bg-green-600 text-white">
        `;


                suppliers.forEach(function() {

                    header += `
                <th class="border px-3 py-2">
                    Description
                </th>

                <th class="border px-3 py-2 w-24">
                    Score
                </th>
            `;

                });


                header += `
            </tr>
        `;


                thead.innerHTML =
                    header;


                /* ========================================================
                   BODY
                ======================================================== */

                let body = '';


                criteria.forEach(
                    function(criterion) {

                        body += `
                    <tr>

                        <td
                            class="border px-4 py-3
                                   font-semibold
                                   bg-gray-50"
                        >
                            ${escapeHtml(
                                criterion.name
                            )}
                        </td>
                `;


                        suppliers.forEach(
                            function(row, supplierIndex) {

                                let description = '';

                                let score = 0;


                                /*
                                 * Find saved supplier data
                                 */

                                const supplierData =
                                    suppliersData[
                                        supplierIndex
                                    ];


                                if (
                                    supplierData &&
                                    supplierData.scores
                                ) {

                                    const saved =
                                        supplierData.scores.find(
                                            function(item) {

                                                return (
                                                    Number(
                                                        item.criterion_id
                                                    ) ===
                                                    Number(
                                                        criterion.id
                                                    )
                                                );

                                            }
                                        );


                                    if (saved) {

                                        description =
                                            saved.description ??
                                            '';

                                        score =
                                            Number(
                                                saved.score
                                            ) || 0;

                                    }

                                }


                                body += `
                            <td class="border p-2">

                                <textarea
                                    rows="2"
                                    name="description[${supplierIndex}][${criterion.id}]"
                                    class="w-full rounded-lg
                                           border-gray-300
                                           resize-none"
                                    placeholder="Enter description..."
                                >${escapeHtml(
                                    description
                                )}</textarea>

                            </td>

                            <td class="border p-2">

                                <select
                                    class="score w-full
                                           rounded-lg
                                           border-gray-300"
                                    data-supplier-index="${supplierIndex}"
                                    name="score[${supplierIndex}][${criterion.id}]"
                                >

                                    <option
                                        value="0"
                                        ${score === 0 ? 'selected' : ''}
                                    >
                                        0
                                    </option>

                                    <option
                                        value="1"
                                        ${score === 1 ? 'selected' : ''}
                                    >
                                        1
                                    </option>

                                    <option
                                        value="2"
                                        ${score === 2 ? 'selected' : ''}
                                    >
                                        2
                                    </option>

                                    <option
                                        value="3"
                                        ${score === 3 ? 'selected' : ''}
                                    >
                                        3
                                    </option>

                                </select>

                            </td>
                        `;

                            }
                        );


                        body += `
                    </tr>
                `;

                    }
                );


                tbody.innerHTML =
                    body;


                /* ========================================================
                   FOOTER / TOTAL SCORE
                ======================================================== */

                let footer = `
            <tr class="bg-green-100 font-bold">

                <td
                    class="border px-4 py-4
                           text-right text-gray-800"
                >
                    Total Score
                </td>
        `;


                suppliers.forEach(
                    function(row, index) {

                        footer += `
                    <td
                        class="border px-3 py-4
                               bg-green-50"
                    >
                    </td>

                    <td
                        class="border px-3 py-4
                               text-center
                               bg-green-100"
                    >

                        <span
                            id="total${index}"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   min-w-[60px]
                                   px-4 py-2
                                   rounded-xl
                                   bg-green-600
                                   text-white
                                   text-lg
                                   font-bold"
                        >
                            0
                        </span>

                    </td>
                `;

                    }
                );


                footer += `
            </tr>
        `;


                tfoot.innerHTML =
                    footer;


                attachScoreEvents();

                calculateTotals();

            }


            /* ============================================================
               CALCULATE ALL TOTALS
            ============================================================ */

            function calculateTotals() {

                getSuppliers().forEach(
                    function(row, index) {

                        const total =
                            getSupplierScore(
                                index
                            );


                        const totalCell =
                            document.getElementById(
                                `total${index}`
                            );


                        if (totalCell) {

                            totalCell.textContent =
                                total;

                        }

                    }
                );


                updateSelectedSupplierScore();

            }


            /* ============================================================
               SCORE EVENTS
            ============================================================ */

            function attachScoreEvents() {

                document
                    .querySelectorAll('.score')
                    .forEach(
                        function(select) {

                            select.addEventListener(
                                'change',
                                function() {

                                    calculateTotals();

                                }
                            );

                        }
                    );

            }


            /* ============================================================
               ADD SUPPLIER
            ============================================================ */

            document
                .getElementById('addSupplier')
                ?.addEventListener(
                    'click',
                    function() {

                        if (!supplierTable) {
                            return;
                        }


                        const firstRow =
                            supplierTable.querySelector(
                                '.supplier-row'
                            );


                        if (!firstRow) {
                            return;
                        }


                        const row =
                            firstRow.cloneNode(true);


                        /*
                         * Clear inputs
                         */

                        row.querySelectorAll('input')
                            .forEach(
                                function(input) {

                                    input.value = '';

                                }
                            );


                        /*
                         * Clear textarea
                         */

                        row.querySelectorAll('textarea')
                            .forEach(
                                function(textarea) {

                                    textarea.value = '';

                                }
                            );


                        supplierTable.appendChild(
                            row
                        );


                        /*
                         * Add empty data object
                         */

                        suppliersData.push({

                            id: null,

                            supplier_no: getSuppliers().length,

                            supplier_name: '',

                            contact_person: '',

                            phone: '',

                            total_score: 0,

                            recommended: false,

                            scores: []

                        });


                        updateSupplierNumber();

                        buildEvaluationTable();

                        updateRecommendedSupplier(
                            false
                        );

                    }
                );


            /* ============================================================
               REMOVE SUPPLIER
            ============================================================ */

            supplierTable?.addEventListener(
                'click',
                function(e) {

                    const button =
                        e.target.closest(
                            '.removeSupplier'
                        );


                    if (!button) {
                        return;
                    }


                    const rows =
                        getSuppliers();


                    if (rows.length <= 1) {

                        alert(
                            'At least one supplier is required.'
                        );

                        return;

                    }


                    const row =
                        button.closest(
                            '.supplier-row'
                        );


                    const index =
                        rows.indexOf(row);


                    if (
                        index !== -1 &&
                        suppliersData[index]
                    ) {

                        suppliersData.splice(
                            index,
                            1
                        );

                    }


                    row?.remove();


                    updateSupplierNumber();

                    buildEvaluationTable();

                    updateRecommendedSupplier(
                        false
                    );

                }
            );


            /* ============================================================
               SUPPLIER NAME CHANGED
            ============================================================ */

            document.addEventListener(
                'input',
                function(e) {

                    if (
                        !e.target.classList.contains(
                            'supplier-name'
                        )
                    ) {
                        return;
                    }


                    const currentValue =
                        recommendedSupplier?.value || '';


                    buildEvaluationTable();


                    updateRecommendedSupplier(
                        true
                    );


                    if (
                        currentValue &&
                        recommendedSupplier &&
                        Array.from(
                            recommendedSupplier.options
                        ).some(
                            function(option) {

                                return (
                                    option.value ===
                                    currentValue
                                );

                            }
                        )
                    ) {

                        recommendedSupplier.value =
                            currentValue;

                        updateSelectedSupplierScore();

                    }

                }
            );


            /* ============================================================
               RECOMMENDED SUPPLIER CHANGED
            ============================================================ */

            recommendedSupplier?.addEventListener(
                'change',
                function() {

                    updateSelectedSupplierScore();

                }
            );


            /* ============================================================
               COMMITTEE
            ============================================================ */

            document
                .getElementById('addCommittee')
                ?.addEventListener(
                    'click',
                    function() {

                        if (!committeeBody) {
                            return;
                        }


                        const firstRow =
                            committeeBody.querySelector(
                                '.committee-row'
                            );


                        if (!firstRow) {
                            return;
                        }


                        const row =
                            firstRow.cloneNode(true);


                        row.querySelectorAll('input')
                            .forEach(
                                function(input) {

                                    input.value = '';

                                }
                            );


                        const list =
                            row.querySelector(
                                '.committee-user-list'
                            );


                        if (list) {

                            list.classList.add(
                                'hidden'
                            );

                        }


                        committeeBody.appendChild(
                            row
                        );


                        updateCommitteeNo();

                    }
                );


            /* ============================================================
               REMOVE COMMITTEE
            ============================================================ */

            committeeBody?.addEventListener(
                'click',
                function(e) {

                    const button =
                        e.target.closest(
                            '.removeCommittee'
                        );


                    if (!button) {
                        return;
                    }


                    const rows =
                        committeeBody.querySelectorAll(
                            '.committee-row'
                        );


                    if (rows.length <= 1) {
                        return;
                    }


                    button
                        .closest(
                            '.committee-row'
                        )
                        ?.remove();


                    updateCommitteeNo();

                }
            );


            /* ============================================================
               COMMITTEE NUMBER
            ============================================================ */

            function updateCommitteeNo() {

                if (!committeeBody) {
                    return;
                }


                committeeBody
                    .querySelectorAll(
                        '.committee-row'
                    )
                    .forEach(
                        function(row, index) {

                            const number =
                                row.querySelector(
                                    '.committee-no'
                                );


                            if (number) {

                                number.textContent =
                                    index + 1;

                            }

                        }
                    );

            }


            /* ============================================================
               COMMITTEE AUTOCOMPLETE
            ============================================================ */

            document.addEventListener(
                'input',
                function(e) {

                    if (
                        !e.target.classList.contains(
                            'committee-user-name'
                        )
                    ) {
                        return;
                    }


                    const input =
                        e.target;


                    const keyword =
                        input.value
                        .trim()
                        .toLowerCase();


                    const td =
                        input.closest('td');


                    if (!td) {
                        return;
                    }


                    const list =
                        td.querySelector(
                            '.committee-user-list'
                        );


                    if (!list) {
                        return;
                    }


                    const items =
                        list.querySelectorAll(
                            '.committee-user-item'
                        );


                    if (keyword === '') {

                        list.classList.add(
                            'hidden'
                        );

                        return;

                    }


                    let found = false;


                    items.forEach(
                        function(item) {

                            const name =
                                (
                                    item.dataset.name ||
                                    ''
                                ).toLowerCase();


                            if (
                                name.includes(
                                    keyword
                                )
                            ) {

                                item.style.display =
                                    '';

                                found = true;

                            } else {

                                item.style.display =
                                    'none';

                            }

                        }
                    );


                    list.classList.toggle(
                        'hidden',
                        !found
                    );

                }
            );


            /* ============================================================
               SELECT COMMITTEE USER
            ============================================================ */

            document.addEventListener(
                'click',
                function(e) {

                    const item =
                        e.target.closest(
                            '.committee-user-item'
                        );


                    if (item) {

                        const td =
                            item.closest('td');


                        if (!td) {
                            return;
                        }


                        const nameInput =
                            td.querySelector(
                                '.committee-user-name'
                            );


                        const idInput =
                            td.querySelector(
                                '.committee-user-id'
                            );


                        const list =
                            td.querySelector(
                                '.committee-user-list'
                            );


                        if (nameInput) {

                            nameInput.value =
                                item.dataset.name;

                        }


                        if (idInput) {

                            idInput.value =
                                item.dataset.id;

                        }


                        if (list) {

                            list.classList.add(
                                'hidden'
                            );

                        }


                        return;

                    }


                    /*
                     * Close autocomplete
                     */

                    if (
                        !e.target.closest(
                            '.committee-user-name'
                        ) &&
                        !e.target.closest(
                            '.committee-user-list'
                        )
                    ) {

                        document
                            .querySelectorAll(
                                '.committee-user-list'
                            )
                            .forEach(
                                function(list) {

                                    list.classList.add(
                                        'hidden'
                                    );

                                }
                            );

                    }

                }
            );


            /* ============================================================
               INITIAL LOAD
            ============================================================ */

            updateSupplierNumber();

            buildEvaluationTable();

            updateRecommendedSupplier(
                false
            );

            updateCommitteeNo();

        });
    </script>

@endsection
