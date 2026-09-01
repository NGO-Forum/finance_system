@extends('layout.app')

@section('content')

    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-700 via-green-600 to-emerald-500 shadow-xl mb-6">

            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-16 -right-16 w-72 h-72 bg-white rounded-full"></div>
                <div class="absolute bottom-0 left-0 w-52 h-52 bg-white rounded-full"></div>
            </div>

            <div class="relative px-8 py-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <div class="flex items-center gap-4">

                            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6M7 4h10l2 2v14H5V6l2-2z" />

                                </svg>

                            </div>

                            <div>

                                <h1 class="text-3xl font-bold text-white">

                                    Create Purchase Request

                                </h1>

                                <p class="text-green-100 mt-2">

                                    Complete the purchase request information before submitting for approval.

                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="mt-6 lg:mt-0">

                        <a href="{{ route('purchase-requests.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-green-700 font-semibold shadow hover:bg-green-50 transition">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                            </svg>

                            Back

                        </a>

                    </div>

                </div>

            </div>

        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-5">

                <h3 class="font-bold text-red-700 mb-3">

                    Please fix the following errors:

                </h3>

                <ul class="list-disc list-inside text-red-600 space-y-1">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <form method="POST" action="{{ route('purchase-requests.update', $purchaseRequest) }}"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- Purchase Information --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 mb-6">

                <div class="px-6 py-4 border-b bg-slate-50 rounded-t-2xl">

                    <h2 class="text-lg font-bold text-green-600">

                        Purchase Information

                    </h2>

                    <p class="text-sm text-slate-500 mt-1">

                        Basic information about this purchase request.

                    </p>

                </div>

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                        {{-- Purchase Number --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">

                                Purchase No

                            </label>

                            <input type="text" value="{{ $purchaseRequest->purchase_no }}" readonly
                                class="w-full rounded-xl border-slate-300 bg-slate-100">

                        </div>

                        {{-- Request Date --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">

                                Request Date
                                <span class="text-red-500">*</span>

                            </label>

                            <input type="date" name="request_date"
                                value="{{ old('request_date', $purchaseRequest->request_date) }}"
                                class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600"
                                required>

                        </div>

                        {{-- Donor --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Donor
                            </label>

                            <input type="text" name="donor" value="{{ old('donor', $purchaseRequest->donor) }}"
                                placeholder="Enter donor name"
                                class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600">

                        </div>

                        {{-- Donor Code --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Donor Code
                            </label>

                            <input type="text" name="donor_code"
                                value="{{ old('donor_code', $purchaseRequest->donor_code) }}" placeholder="Enter donor code"
                                class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600">

                        </div>

                        {{-- Budget Line --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Budget Line
                            </label>

                            <input type="text" name="budget_line"
                                value="{{ old('budget_line', $purchaseRequest->budget_line) }}"
                                placeholder="Enter budget line"
                                class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600">

                        </div>

                    </div>

                    {{-- Purpose --}}
                    <div class="mt-4">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Purpose
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea name="purpose" rows="5" placeholder="Describe the purpose of this purchase request..."
                            class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600" required>{{ old('purpose', $purchaseRequest->purpose) }}</textarea>

                    </div>

                </div>

            </div>

            {{-- Purchase Items --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 mb-6">

                <div class="flex items-center justify-between px-6 py-4 border-b bg-slate-50 rounded-t-2xl">

                    <div>

                        <h2 class="text-lg font-bold text-green-600">
                            Purchase Items
                        </h2>

                        <p class="text-sm text-slate-500">
                            Add the items to be purchased.
                        </p>

                    </div>

                </div>

                <div id="itemBody" class="p-6 space-y-5">

                    @foreach (old('items', $purchaseRequest->items) as $index => $item)
                        <div class="item-card border border-slate-200 rounded-2xl bg-slate-50 p-6">

                            <div class="flex items-center justify-between mb-6">

                                <h3 class="item-title text-lg font-bold text-green-700">

                                    Item #{{ $loop->iteration }}

                                </h3>

                                <button type="button" class="removeRow text-red-600 hover:text-red-700">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                            <div class="grid grid-cols-1 gap-5">

                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Item Name
                                    </label>

                                    <input type="text" name="items[{{ $index }}][item_name]"
                                        value="{{ old("items.$index.item_name", $item->item_name ?? '') }}"
                                        class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600"
                                        required>

                                </div>

                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Specification
                                    </label>

                                    <textarea rows="3" name="items[{{ $index }}][specification]"
                                        class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600">{{ old("items.$index.specification", $item->specification ?? '') }}</textarea>

                                </div>

                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-5">

                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Unit
                                    </label>

                                    <input type="text" name="items[{{ $index }}][unit]"
                                        value="{{ old("items.$index.unit", $item->unit ?? '') }}"
                                        class="w-full rounded-xl border-slate-300">

                                </div>

                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Unit Cost
                                    </label>

                                    <input type="number" step="0.01" name="items[{{ $index }}][unit_cost]"
                                        value="{{ old("items.$index.unit_cost", $item->unit_cost ?? 0) }}"
                                        class="unit-cost w-full rounded-xl border-slate-300 text-right">

                                </div>

                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Quantity
                                    </label>

                                    <input type="number" min="1" name="items[{{ $index }}][quantity]"
                                        value="{{ old("items.$index.quantity", $item->quantity ?? 1) }}"
                                        class="quantity w-full rounded-xl border-slate-300 text-right">

                                </div>

                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Total
                                    </label>

                                    <input type="text" readonly name="items[{{ $index }}][total]"
                                        value="{{ number_format(old("items.$index.total", $item->total ?? 0), 2) }}"
                                        class="line-total w-full rounded-xl bg-slate-100 border-slate-300 text-right font-bold">

                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="p-6 flex justify-end">
                    <button type="button" id="addRow"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white">

                        + Add Item

                    </button>
                </div>

                {{-- Purchase Summary --}}
                <div class="border-t border-slate-200 bg-gradient-to-r from-slate-50 to-green-50 px-6 py-6 rounded-b-2xl">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Total Items --}}
                        <div
                            class="bg-white rounded-2xl shadow-sm border border-green-100 p-5 flex items-center justify-between">

                            <div>

                                <p class="text-sm font-medium text-slate-500">
                                    Total Items
                                </p>

                                <h2 id="totalItems" class="mt-2 text-3xl font-bold text-green-700">
                                    1
                                </h2>

                            </div>

                            <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-700" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4" />

                                </svg>

                            </div>

                        </div>

                        {{-- Grand Total --}}
                        <div
                            class="md:col-span-2 bg-gradient-to-r from-green-600 to-emerald-500 rounded-2xl shadow-lg p-6 text-white">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-green-100 text-sm uppercase tracking-wide">

                                        Grand Total

                                    </p>

                                    <h1 class="mt-2 text-4xl font-extrabold">

                                        $

                                        <span id="grandTotalText">
                                            {{ number_format(old('grand_total', $purchaseRequest->grand_total), 2) }}
                                        </span>

                                    </h1>

                                    <p class="mt-2 text-green-100 text-sm">

                                        Total estimated purchase cost

                                    </p>

                                </div>

                                <div
                                    class="w-20 h-20 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center">

                                    <span class="text-5xl font-black text-white">
                                        $
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <input type="hidden" name="grand_total" id="grandTotal" value="0">

                </div>


                <div class="flex justify-end gap-3 px-6 py-5">

                    <a href="{{ route('purchase-requests.index') }}"
                        class="rounded-xl bg-gray-500 px-6 py-3 text-white hover:bg-gray-600">

                        Cancel

                    </a>

                    <button type="submit" class="rounded-xl bg-green-600 px-6 py-3 text-white hover:bg-green-700">

                        Update

                    </button>

                </div>

        </form>

        {{-- Item Template --}}
        <template id="itemTemplate">

            <div class="item-card border border-slate-200 rounded-2xl bg-slate-50 p-6">

                <div class="flex items-center justify-between mb-6">

                    <h3 class="item-title text-lg font-bold text-green-700">

                        Item #1

                    </h3>

                    <button type="button" class="removeRow text-red-600 hover:text-red-700 font-medium">

                         <i class="fas fa-trash"></i>

                    </button>

                </div>

                <div class="grid grid-cols-1 gap-5">

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Item Name

                        </label>

                        <input type="text" name="items[__INDEX__][item_name]"
                            class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600"
                            required>

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Specification

                        </label>

                        <textarea rows="3" name="items[__INDEX__][specification]"
                            class="w-full rounded-xl border-slate-300 focus:ring-green-600 focus:border-green-600"></textarea>

                    </div>

                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-5">

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Unit

                        </label>

                        <input type="text" name="items[__INDEX__][unit]" value="1" class="w-full rounded-xl border-slate-300 text-right">

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Unit Cost

                        </label>

                        <input type="number" step="0.01" min="0" value="0"
                            name="items[__INDEX__][unit_cost]"
                            class="unit-cost w-full rounded-xl border-slate-300 text-right">

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Quantity

                        </label>

                        <input type="number" min="1" value="1" name="items[__INDEX__][quantity]"
                            class="quantity w-full rounded-xl border-slate-300 text-right">

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Total

                        </label>

                        <input type="text" readonly value="0.00" name="items[__INDEX__][total]"
                            class="line-total w-full rounded-xl bg-slate-100 border-slate-300 text-right font-bold">

                    </div>

                </div>

            </div>

        </template>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const itemBody = document.getElementById('itemBody');
            const addRowBtn = document.getElementById('addRow');
            const template = document.getElementById('itemTemplate');

            let rowIndex = itemBody.querySelectorAll('.item-card').length;

            // ============================
            // Update Item Numbers
            // ============================
            function updateRowNumbers() {

                const cards = itemBody.querySelectorAll('.item-card');

                cards.forEach((card, index) => {

                    card.querySelector('.item-title').textContent = 'Item #' + (index + 1);

                });

                document.getElementById('totalItems').textContent = cards.length;
            }

            // ============================
            // Calculate One Item
            // ============================
            function calculateCard(card) {

                const unitCost =
                    parseFloat(card.querySelector('.unit-cost').value) || 0;

                const quantity =
                    parseFloat(card.querySelector('.quantity').value) || 0;

                const total = unitCost * quantity;

                card.querySelector('.line-total').value = total.toFixed(2);

                calculateGrandTotal();
            }

            // ============================
            // Grand Total
            // ============================
            function calculateGrandTotal() {

                let grandTotal = 0;

                document.querySelectorAll('.line-total').forEach(function(input) {

                    grandTotal += parseFloat(input.value) || 0;

                });

                document.getElementById('grandTotalText').textContent =
                    grandTotal.toFixed(2);

                document.getElementById('grandTotal').value =
                    grandTotal.toFixed(2);
            }

            // ============================
            // Attach Events
            // ============================
            function attachEvents(card) {

                const unitCost = card.querySelector('.unit-cost');
                const quantity = card.querySelector('.quantity');

                unitCost.addEventListener('input', function() {

                    calculateCard(card);

                });

                quantity.addEventListener('input', function() {

                    calculateCard(card);

                });

                const removeBtn = card.querySelector('.removeRow');

                removeBtn.addEventListener('click', function() {

                    const cards = itemBody.querySelectorAll('.item-card');

                    if (cards.length === 1) {

                        alert('At least one item is required.');

                        return;
                    }

                    card.remove();

                    updateRowNumbers();

                    calculateGrandTotal();

                });

            }

            // ============================
            // Existing Card
            // ============================
            itemBody.querySelectorAll('.item-card').forEach(function(card) {

                attachEvents(card);

                calculateCard(card);

            });

            // ============================
            // Add New Card
            // ============================
            addRowBtn.addEventListener('click', function() {

                const clone =
                    template.content.cloneNode(true);

                const card =
                    clone.querySelector('.item-card');

                card.innerHTML =
                    card.innerHTML.replace(/__INDEX__/g, rowIndex);

                itemBody.appendChild(card);

                const newCard =
                    itemBody.lastElementChild;

                attachEvents(newCard);

                updateRowNumbers();

                calculateCard(newCard);

                rowIndex++;

            });

            updateRowNumbers();

            calculateGrandTotal();

        });
    </script>

@endsection
