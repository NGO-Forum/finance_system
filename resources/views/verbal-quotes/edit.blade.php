@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Page Header --}}
        <div class="mb-4 rounded-3xl bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 shadow-2xl overflow-hidden">

            <div class="px-8 py-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                {{-- Left --}}
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

                            Create Verbal Quote

                            <span class="text-green-100">

                                (FM02-09)

                            </span>

                        </h1>

                        <p class="mt-2 text-green-100 text-base">

                            Create a new verbal quotation by entering supplier details,
                            quotation items, and pricing information.

                        </p>

                    </div>

                </div>

                {{-- Right --}}
                <div class="flex gap-3">

                    <a href="{{ route('verbal-quotes.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-green-700 font-semibold shadow hover:bg-green-50 transition-all duration-300">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                        </svg>

                        Back to List

                    </a>

                </div>

            </div>

        </div>

        <form action="{{ route('verbal-quotes.update', $verbalQuote) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-4">

                {{-- Section Header --}}
                <div class="flex items-center justify-between mb-4">

                    <div class="flex items-center gap-4">

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

                            <p class="text-sm text-gray-500 mt-1">

                                Enter the basic information for the verbal quotation.

                            </p>

                        </div>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                    {{-- Quote Number --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Quote Number

                        </label>

                        <input type="text" value="{{ $verbalQuote->quote_no }}"
                            class="w-full rounded-xl border-gray-300 bg-gray-100" readonly>

                    </div>

                    {{-- Quote Date --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Quote Date <span class="text-red-500">*</span>

                        </label>

                        <input type="date" name="quote_date"
                            value="{{ old('quote_date', optional($verbalQuote->quote_date)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        @error('quote_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Requested By --}}
                    <div class="relative">

                        <label class="block mb-2 font-semibold text-gray-700">
                            Requested By <span class="text-red-500">*</span>
                        </label>

                        {{-- Hidden User ID --}}
                        <input type="hidden" name="requested_by" id="requested_by_id"
                            value="{{ old('requested_by', $verbalQuote->requested_by) }}">

                        {{-- User Name --}}
                        <input type="text" id="requested_by_name" autocomplete="off"
                            value="{{ old('requested_by_name', optional($verbalQuote->requester)->name) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        <div id="userList"
                            class="hidden absolute z-50 w-full mt-1 bg-white border rounded-xl shadow-lg max-h-60 overflow-y-auto">

                            @foreach ($users as $user)
                                <div class="user-item px-4 py-2 cursor-pointer hover:bg-green-100"
                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}">

                                    {{ $user->name }}

                                </div>
                            @endforeach

                        </div>

                        @error('requested_by')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Supplier --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Supplier Name <span class="text-red-500">*</span>

                        </label>

                        <input type="text" name="supplier_name"
                            value="{{ old('supplier_name', $verbalQuote->supplier_name) }}" placeholder="Enter name"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        @error('supplier_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Contact --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Contact Information

                        </label>

                        <input type="text" name="contact_information"
                            value="{{ old('contact_information', $verbalQuote->contact_information) }}"
                            placeholder="Enter contact"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                    </div>

                    {{-- Validity Date --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Validity Date

                        </label>

                        <input type="date" name="validity_date"
                            value="{{ old('validity_date', optional($verbalQuote->validity_date)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                    </div>

                    {{-- Contact Date --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Contact Date

                        </label>

                        <input type="date" name="contact_date"
                            value="{{ old('contact_date', optional($verbalQuote->contact_date)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                    </div>

                    {{-- Contact Time --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Contact Time

                        </label>

                        <input type="time" name="contact_time"
                            value="{{ old('contact_time', \Carbon\Carbon::parse($verbalQuote->contact_time)->format('H:i')) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                    </div>

                    {{-- Prepared by --}}
                    <div class="relative">

                        <label class="block mb-2 font-semibold text-gray-700">

                            Prepared By

                        </label>

                        <input type="hidden" name="prepared_by" id="prepared_by_id"
                            value="{{ old('prepared_by', $verbalQuote->prepared_by) }}">

                        <input type="text" id="prepared_by_name" autocomplete="off"
                            value="{{ old('prepared_by_name', optional($verbalQuote->preparer)->name) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                        <div id="preparedUserList"
                            class="hidden absolute z-50 w-full mt-1 bg-white border rounded-xl shadow-lg max-h-60 overflow-y-auto">

                            @foreach ($users as $user)
                                <div class="prepared-user-item px-4 py-2 cursor-pointer hover:bg-green-100"
                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}">

                                    {{ $user->name }}

                                </div>
                            @endforeach

                        </div>

                    </div>

                    {{-- Prepared Date --}}
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">

                            Prepared Date

                        </label>

                        <input type="date" name="prepared_date"
                            value="{{ old('prepared_date', optional($verbalQuote->prepared_date)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                    </div>

                </div>

            </div>

            {{-- Quotation Items --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-5">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">

                    {{-- Left --}}
                    <div class="flex items-center gap-4">

                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 shadow-lg flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-gray-800">

                                Quotation Items

                            </h2>

                            <p class="text-sm text-gray-500 mt-1">

                                Add products or services for this verbal quotation.

                            </p>

                        </div>

                    </div>

                    {{-- Right --}}
                    <button type="button" id="addRow"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        Add New Item

                    </button>

                </div>

                <div class="overflow-x-auto rounded-lg">

                    <table class="min-w-full border border-gray-200">

                        <thead class="bg-green-600 text-white">

                            <tr>

                                <th class="border px-3 py-3 w-10">
                                    #
                                </th>

                                <th class="border px-3 py-3 w-40">
                                    Budget Line
                                </th>

                                <th class="border px-3 py-3">
                                    Description
                                </th>

                                <th class="border px-3 py-3 w-28">
                                    Qty
                                </th>

                                <th class="border px-3 py-3 w-40">
                                    Unit Price
                                </th>

                                <th class="border px-3 py-3 w-40">
                                    Extended Price
                                </th>

                                <th class="border px-3 py-3 w-20">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody id="itemTable">

                            @forelse($verbalQuote->items as $index => $item)
                                <tr>

                                    <td class="border text-center row-number">

                                        {{ $index + 1 }}

                                    </td>

                                    <td class="border px-3 py-2">

                                        <input type="text" name="budget_line[]"
                                            value="{{ old("budget_line.$index", $item->budget_line) }}"
                                            class="w-full rounded-lg border-gray-300">

                                    </td>

                                    <td class="border px-3 py-2">

                                        <textarea name="description[]" rows="1" required class="w-full rounded-lg mt-2 border-gray-300">{{ old("description.$index", $item->description) }}</textarea>

                                    </td>

                                    <td class="border px-3 py-2">

                                        <input type="number" step="0.01" name="qty[]"
                                            value="{{ old("qty.$index", $item->qty) }}"
                                            class="qty w-full rounded-lg border-gray-300">

                                    </td>

                                    <td class="border px-3 py-2">

                                        <input type="number" step="0.01" name="unit_price[]"
                                            value="{{ old("unit_price.$index", $item->unit_price) }}"
                                            class="unit-price w-full rounded-lg border-gray-300">

                                    </td>

                                    <td class="border px-3 py-2">

                                        <input type="number" step="0.01" readonly name="extended_price[]"
                                            value="{{ old("extended_price.$index", $item->extended_price) }}"
                                            class="extended-price w-full rounded-lg bg-gray-100 border-gray-300">

                                    </td>

                                    <td class="border text-center">

                                        <button type="button"
                                            class="remove-row bg-red-500 px-3 py-2 rounded-lg text-white hover:bg-red-600">

                                            ✕
                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td class="border text-center row-number">1</td>

                                    <td class="border px-3 py-2">
                                        <input type="text" name="budget_line[]"
                                            class="w-full rounded-lg border-gray-300">
                                    </td>

                                    <td class="border px-3 py-2">
                                        <textarea name="description[]" rows="1" class="w-full rounded-lg mt-2 border-gray-300"></textarea>
                                    </td>

                                    <td class="border px-3 py-2">
                                        <input type="number" step="0.01" value="1" name="qty[]"
                                            class="qty w-full rounded-lg border-gray-300">
                                    </td>

                                    <td class="border px-3 py-2">
                                        <input type="number" step="0.01" value="0" name="unit_price[]"
                                            class="unit-price w-full rounded-lg border-gray-300">
                                    </td>

                                    <td class="border px-3 py-2">
                                        <input type="number" step="0.01" value="0" readonly
                                            name="extended_price[]"
                                            class="extended-price w-full rounded-lg bg-gray-100 border-gray-300">
                                    </td>

                                    <td class="border text-center">
                                        <button type="button"
                                            class="remove-row bg-red-500 px-3 py-2 rounded-lg text-white hover:bg-red-600">
                                            ✕
                                        </button>
                                    </td>

                                </tr>
                            @endforelse


                        </tbody>

                        <tfoot class="bg-gray-50">

                            <tr>

                                <td colspan="5" class="text-right font-bold px-4 py-3">

                                    Grand Total

                                </td>

                                <td colspan="2" class="px-4 py-3">

                                    <input type="text" id="grandTotal" value="0.00" readonly
                                        class="w-full bg-green-100 font-bold text-right text-lg text-green-700 rounded-lg border-gray-300">

                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

            {{-- Additional Specifications --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mt-4">

                {{-- Section Header --}}
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

                        <p class="text-sm text-gray-500 mt-1">

                            Enter any additional requirements, terms, or remarks related to this quotation.

                        </p>

                    </div>

                </div>

                {{-- Textarea --}}
                <div>

                    <label class="block mb-2 font-semibold text-gray-700">

                        Specifications / Remarks

                    </label>

                    <textarea name="additional_specifications" rows="4" placeholder="Enter your specification"
                        class="w-full rounded-2xl border border-gray-300 px-4 py-4 text-gray-700 placeholder-gray-400 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 resize-none transition">{{ trim(old('additional_specifications', $verbalQuote->additional_specifications)) }}</textarea>

                </div>

            </div>

            {{-- Action Buttons --}}
            <div class="bg-white rounded-2xl p-5 mt-4">

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">

                    {{-- Left Information --}}
                    <div class="text-sm text-red-500">

                        <span class="font-semibold text-gray-700">
                            Note:
                        </span>

                        Please review all changes before updating this verbal quotation.

                    </div>

                    {{-- Right Buttons --}}
                    <div class="flex items-center gap-3">

                        {{-- Cancel --}}
                        <a href="{{ route('verbal-quotes.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold shadow-sm hover:bg-gray-100 hover:shadow transition-all duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />

                            </svg>

                            Cancel

                        </a>

                        {{-- Update --}}
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586" />

                            </svg>

                            Update Verbal Quote

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            initAutocomplete(
                'requested_by_name',
                'requested_by_id',
                'userList',
                '.user-item'
            );

            initAutocomplete(
                'prepared_by_name',
                'prepared_by_id',
                'preparedUserList',
                '.prepared-user-item'
            );

        });

        function initAutocomplete(inputId, hiddenId, listId, itemSelector) {
            const input = document.getElementById(inputId);
            const hidden = document.getElementById(hiddenId);
            const list = document.getElementById(listId);
            const items = list.querySelectorAll(itemSelector);

            input.addEventListener('keyup', function() {

                const value = this.value.toLowerCase();

                hidden.value = "";

                let found = false;

                items.forEach(item => {

                    if (item.dataset.name.toLowerCase().includes(value)) {
                        item.style.display = "block";
                        found = true;
                    } else {
                        item.style.display = "none";
                    }

                });

                if (value !== "" && found) {
                    list.classList.remove("hidden");
                } else {
                    list.classList.add("hidden");
                }

            });

            items.forEach(item => {

                item.addEventListener('click', function() {

                    input.value = this.dataset.name;

                    hidden.value = this.dataset.id;

                    list.classList.add("hidden");

                });

            });

            document.addEventListener('click', function(e) {

                if (!list.contains(e.target) && e.target !== input) {

                    list.classList.add("hidden");

                }

            });

        }

        document.addEventListener('DOMContentLoaded', function() {

            const table = document.getElementById('itemTable');
            const addRow = document.getElementById('addRow');
            const grandTotal = document.getElementById('grandTotal');

            // ==========================
            // Update Row Number
            // ==========================
            function updateRowNumber() {
                table.querySelectorAll('tr').forEach((row, index) => {
                    row.querySelector('.row-number').textContent = index + 1;
                });
            }

            // ==========================
            // Calculate Total
            // ==========================
            function calculateGrandTotal() {

                let total = 0;

                table.querySelectorAll('tr').forEach(row => {

                    const qtyInput = row.querySelector('.qty');
                    const unitPriceInput = row.querySelector('.unit-price');
                    const extendedPriceInput = row.querySelector('.extended-price');

                    if (!qtyInput || !unitPriceInput || !extendedPriceInput) return;

                    const qty = parseFloat(qtyInput.value) || 0;
                    const unitPrice = parseFloat(unitPriceInput.value) || 0;

                    const amount = qty * unitPrice;

                    extendedPriceInput.value = amount.toFixed(2);

                    total += amount;

                });

                grandTotal.value = total.toFixed(2);

            }

            // ==========================
            // Add New Row
            // ==========================
            addRow.addEventListener('click', function() {

                const firstRow = table.querySelector('tr');

                const newRow = firstRow.cloneNode(true);

                // Clear values
                newRow.querySelector('input[name="budget_line[]"]').value = '';
                newRow.querySelector('textarea[name="description[]"]').value = '';

                newRow.querySelector('.qty').value = 1;
                newRow.querySelector('.unit-price').value = 0;
                newRow.querySelector('.extended-price').value = '0.00';

                table.appendChild(newRow);

                updateRowNumber();

                calculateGrandTotal();

            });

            // ==========================
            // Remove Row
            // ==========================
            table.addEventListener('click', function(e) {

                const btn = e.target.closest('.remove-row');

                if (!btn) return;

                if (table.querySelectorAll('tr').length === 1) {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Cannot Remove',
                        text: 'At least one quotation item is required.'
                    });

                    return;
                }

                btn.closest('tr').remove();

                updateRowNumber();

                calculateGrandTotal();

            });

            // ==========================
            // Auto Calculate
            // ==========================
            table.addEventListener('input', function(e) {

                if (
                    e.target.classList.contains('qty') ||
                    e.target.classList.contains('unit-price')
                ) {
                    calculateGrandTotal();
                }

            });

            // ==========================
            // Initial Load
            // ==========================
            updateRowNumber();

            calculateGrandTotal();

        });
    </script>
@endsection
