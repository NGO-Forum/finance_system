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

        <form action="{{ route('quotation-analyses.store') }}" method="POST">

            @csrf

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

                        <input type="text" name="item_name" value="{{ old('item_name') }}"
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

                        <input type="text" value="{{ $qaNo }}" readonly
                            class="w-full rounded-xl bg-gray-100 border-gray-300 font-semibold">

                    </div>

                    {{-- Date --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Date

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="date" name="qa_date" value="{{ old('qa_date', now()->format('Y-m-d')) }}"
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

                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1"
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
                        class="w-full rounded-2xl border-gray-300 focus:ring-green-500 focus:border-green-500 resize-none">{{ old('purpose') }}</textarea>

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

                            <tr class="supplier-row">

                                <td class="border px-3 py-3 text-center supplier-no">

                                    1

                                </td>

                                <td class="border p-2 w-[350px]">

                                    <input type="text" name="supplier_name[]"
                                        class="supplier-name w-full rounded-xl border-gray-300" placeholder="Supplier Name">

                                </td>

                                <td class="border p-2 w-[650px]">

                                    <input type="text" name="contact_person[]" class="w-full rounded-xl border-gray-300"
                                        placeholder="Enter contact person....">

                                </td>

                                <td class="border p-2">

                                    <input type="text" name="phone[]" class="w-full rounded-xl border-gray-300"
                                        placeholder="(+855) XXX XXX XXXX">

                                </td>

                                <td class="border text-center">

                                    <button type="button"
                                        class="removeSupplier w-10 h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </td>

                            </tr>

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

                        </label>

                        <input id="recommended_supplier" type="text" readonly
                            class="w-full rounded-xl bg-green-50 border-green-300 text-green-700 font-bold">

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
                        placeholder="Explain why this supplier is recommended...">{{ old('decision_explanation') }}</textarea>

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

                            <tr class="committee-row">

                                <td class="border text-center committee-no">

                                    1

                                </td>

                                <td class="border p-2 relative">

                                    <input type="hidden" name="committee_user[]" class="committee-user-id">

                                    <input type="text" class="committee-user-name w-full rounded-xl border-gray-300"
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
                                        class="removeCommittee w-10 h-10 rounded-lg bg-red-500 text-white">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </td>

                            </tr>

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
        const criteria = @json($criteria);

        const supplierTable = document.querySelector('#supplierTable tbody');

        /*=====================================================
            =            SUPPLIER SECTION
            =====================================================*/

        document.getElementById('addSupplier').addEventListener('click', function() {

            let row = supplierTable.rows[0].cloneNode(true);

            row.querySelectorAll('input').forEach(input => {

                input.value = '';

            });

            supplierTable.appendChild(row);

            updateSupplierNumber();

            buildEvaluationTable();

        });

        supplierTable.addEventListener('click', function(e) {

            if (e.target.closest('.removeSupplier')) {

                if (supplierTable.rows.length > 1) {

                    e.target.closest('tr').remove();

                    updateSupplierNumber();

                    buildEvaluationTable();

                }

            }

        });

        function updateSupplierNumber() {

            supplierTable.querySelectorAll('tr').forEach((row, index) => {

                row.querySelector('.supplier-no').innerText = index + 1;

            });

        }

        /*=====================================================
        =            BUILD EVALUATION TABLE
        =====================================================*/

        function buildEvaluationTable() {

            const table = document.getElementById('evaluationTable');

            const thead = table.querySelector('thead');

            const tbody = table.querySelector('tbody');

            const tfoot = table.querySelector('tfoot');

            const suppliers = document.querySelectorAll('.supplier-row');

            /*=========================
            Header
            =========================*/

            let header = `
                <tr class="bg-green-600 text-white">

                    <th rowspan="2"
                        class="border px-4 py-3">

                        Criteria

                    </th>
                `;

            suppliers.forEach((row, index) => {

                let supplierName = row.querySelector('.supplier-name').value;

                if (supplierName === '') {

                    supplierName = 'Supplier ' + (index + 1);

                }

                header += `
                    <th colspan="2"
                        class="border px-4 py-3 text-center">

                        ${supplierName}

                    </th>
                    `;

            });

            header += '</tr>';

            header += `<tr class="bg-green-600 text-white">`;

            suppliers.forEach(() => {

                header += `

                    <th class="border px-3 py-2">

                        Description

                    </th>

                    <th class="border px-3 py-2 w-24">

                        Score

                    </th>

                    `;

            });

            header += '</tr>';

            thead.innerHTML = header;

            /*=========================
            Body
            =========================*/

            let body = '';

            criteria.forEach(function(criterion) {

                body += `
                    <tr>

                        <td class="border px-4 py-3 font-semibold bg-gray-50">

                            ${criterion.name}

                        </td>
                    `;

                suppliers.forEach(function(row, index) {

                    body += `

                        <td class="border p-2">

                            <textarea

                                rows="1"

                                name="description[${index}][${criterion.id}]"

                                class="w-full rounded-lg border-gray-300 mt-1 resize-none"></textarea>

                        </td>

                        <td class="border p-2">

                            <select

                                class="score w-full rounded-lg border-gray-300"

                                name="score[${index}][${criterion.id}]">

                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>

                            </select>

                        </td>

                        `;

                });

                body += `</tr>`;

            });

            tbody.innerHTML = body;

            /*=========================
            Footer
            =========================*/

            let footer = `
                <tr class="bg-green-50 font-bold">

                    <td class="border px-4 py-3 text-right">

                        Total Score

                    </td>
                `;

            suppliers.forEach((row, index) => {

                footer += `

                    <td class="border"></td>

                    <td class="border text-center">

                        <span
                            id="total${index}"
                            class="text-lg font-bold text-green-700">

                            0

                        </span>

                    </td>

                    `;

            });

            footer += '</tr>';

            tfoot.innerHTML = footer;

            attachScoreEvents();

        }

        /*=====================================================
        =            SCORE EVENTS
        =====================================================*/

        function attachScoreEvents() {

            document.querySelectorAll('.score').forEach(function(select) {

                select.addEventListener('change', calculateTotals);

            });

            calculateTotals();

        }

        /*=====================================================
        =            TOTAL SCORE
        =====================================================*/

        function calculateTotals() {

            let highestScore = -1;

            let bestSupplier = '';

            document.querySelectorAll('.supplier-row').forEach(function(row, index) {

                let total = 0;

                document.querySelectorAll(`select[name^="score[${index}]"]`)
                    .forEach(function(select) {

                        total += parseInt(select.value) || 0;

                    });

                const totalCell = document.getElementById('total' + index);

                if (totalCell) {

                    totalCell.innerText = total;

                }

                const supplier = row.querySelector('.supplier-name').value;

                if (total > highestScore) {

                    highestScore = total;

                    bestSupplier = supplier;

                }

            });

            if (document.getElementById('highest_score')) {

                document.getElementById('highest_score').value = highestScore;

            }

            if (document.getElementById('recommended_supplier')) {

                document.getElementById('recommended_supplier').value = bestSupplier;

            }

        }

        /*=====================================================
        =            UPDATE SUPPLIER NAME
        =====================================================*/

        document.addEventListener('input', function(e) {

            if (e.target.classList.contains('supplier-name')) {

                buildEvaluationTable();

            }

        });

        /*=====================================================
        =            COMMITTEE
        =====================================================*/

        const committeeBody = document.querySelector('#committeeTable tbody');

        // Add Committee Row
        document.getElementById('addCommittee').addEventListener('click', function() {

            let row = committeeBody.rows[0].cloneNode(true);

            // Clear inputs
            row.querySelectorAll('input').forEach(input => {
                input.value = '';
            });

            // Hide autocomplete list
            row.querySelector('.committee-user-list').classList.add('hidden');

            committeeBody.appendChild(row);

            updateCommitteeNo();

        });

        // Remove Committee Row
        committeeBody.addEventListener('click', function(e) {

            if (e.target.closest('.removeCommittee')) {

                if (committeeBody.rows.length > 1) {

                    e.target.closest('tr').remove();

                    updateCommitteeNo();

                }

            }

        });

        // Update Row Number
        function updateCommitteeNo() {

            committeeBody.querySelectorAll('.committee-row').forEach((row, index) => {

                row.querySelector('.committee-no').innerText = index + 1;

            });

        }

        /*=====================================================
        =            COMMITTEE AUTOCOMPLETE
        =====================================================*/

        // Filter while typing
        document.addEventListener('input', function(e) {

            if (!e.target.classList.contains('committee-user-name')) return;

            const input = e.target;
            const keyword = input.value.trim().toLowerCase();

            const td = input.closest('td');
            const list = td.querySelector('.committee-user-list');
            const items = list.querySelectorAll('.committee-user-item');

            if (keyword === '') {

                list.classList.add('hidden');
                return;

            }

            let found = false;

            items.forEach(item => {

                if (item.dataset.name.toLowerCase().includes(keyword)) {

                    item.style.display = '';

                    found = true;

                } else {

                    item.style.display = 'none';

                }

            });

            list.classList.toggle('hidden', !found);

        });

        // Select User
        document.addEventListener('click', function(e) {

            if (e.target.classList.contains('committee-user-item')) {

                const item = e.target;

                const td = item.closest('td');

                td.querySelector('.committee-user-name').value = item.dataset.name;

                td.querySelector('.committee-user-id').value = item.dataset.id;

                td.querySelector('.committee-user-list').classList.add('hidden');

                return;

            }

            // Hide all lists when clicking outside
            if (!e.target.closest('.committee-user-name') &&
                !e.target.closest('.committee-user-list')) {

                document.querySelectorAll('.committee-user-list').forEach(list => {

                    list.classList.add('hidden');

                });

            }

        });

        /*=====================================================
        =            INITIAL LOAD
        =====================================================*/

        window.onload = function() {

            buildEvaluationTable();

        };
    </script>
@endsection
