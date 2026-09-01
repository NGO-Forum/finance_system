@extends('layout.app')

@section('content')

    <div class="max-w-full mx-auto">

        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div class="mb-5">

            <div
                class="relative overflow-hidden
               bg-white
               border border-gray-200
               rounded-2xl
               shadow-sm">

                {{-- Green Accent --}}
                <div
                    class="absolute left-0 top-0 bottom-0 w-1
                   bg-gradient-to-b from-green-500 to-emerald-700">
                </div>


                <div
                    class="flex flex-col
                   sm:flex-row
                   sm:items-center
                   sm:justify-between
                   gap-5
                   px-6 py-5 pl-7">


                    {{-- ================================================= --}}
                    {{-- Title Section --}}
                    {{-- ================================================= --}}

                    <div class="flex items-center gap-4">

                        {{-- Document Icon --}}
                        <div
                            class="flex-shrink-0
                           w-12 h-12
                           flex items-center justify-center
                           rounded-xl
                           bg-gradient-to-br
                           from-green-50 to-emerald-100
                           text-green-700
                           border border-green-100">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                            </svg>

                        </div>


                        {{-- Title Content --}}
                        <div>

                            {{-- Title + Form Code --}}
                            <div class="flex flex-wrap items-center gap-2.5">

                                <h1
                                    class="text-xl sm:text-3xl
                                   font-bold
                                   tracking-tight
                                   text-green-700">

                                    Create Purchase Order

                                </h1>


                                <span
                                    class="inline-flex items-center
                                   px-2.5 py-1
                                   rounded-lg
                                   bg-green-50
                                   border border-green-200
                                   text-green-700
                                   text-xs
                                   font-bold
                                   tracking-wide">

                                    FM02-11

                                </span>

                            </div>


                            {{-- Description --}}
                            <p class="text-sm text-gray-500 mt-1">

                                Create a new Purchase Order

                            </p>


                            {{-- Breadcrumb-style Information --}}
                            <div
                                class="flex items-center gap-2
                               mt-2.5
                               text-xs text-gray-400">

                                <span class="text-green-600 font-medium">
                                    Finance Management
                                </span>

                                <span>
                                    /
                                </span>

                                <span>
                                    Purchase Order
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- Back Button --}}
                    {{-- ================================================= --}}

                    <a href="{{ route('purchase-orders.index') }}"
                        class="group
                       inline-flex items-center
                       justify-center
                       gap-2
                       w-full sm:w-auto
                       px-4 py-2.5
                       rounded-xl
                       border border-gray-200
                       bg-green-600
                       hover:bg-green-700
                       hover:border-gray-300
                       text-white
                       text-sm
                       font-semibold
                       shadow-sm
                       hover:shadow
                       transition-all
                       duration-200
                       focus:outline-none
                       focus:ring-2
                       focus:ring-green-500
                       focus:ring-offset-2">


                        {{-- Back Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4
                           transition-transform
                           duration-200
                           group-hover:-translate-x-1"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                        </svg>


                        <span>
                            Back
                        </span>

                    </a>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- ERRORS --}}
        {{-- ========================================================= --}}

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg
                    bg-red-50 border border-red-200">

                <h3 class="font-bold text-red-700 mb-2">
                    Please correct the following:
                </h3>

                <ul class="list-disc list-inside
                       text-sm text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>
        @endif



        <form action="{{ route('purchase-orders.store') }}" method="POST" id="purchaseOrderForm">

            @csrf

            {{-- ===================================================== --}}
            {{-- PO INFORMATION --}}
            {{-- ===================================================== --}}

            <div class="bg-white rounded-xl border
                    border-gray-200 shadow-sm mb-5">

                <div class="px-6 py-4
                        bg-green-600 rounded-t-xl border-b border-green-200">

                    <h2 class="font-bold text-white">
                        Purchase Order Information
                    </h2>

                    <p class="text-xs text-gray-200 mt-1">
                        Purchase Order Form — FM02-11
                    </p>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-4 gap-5">


                        {{-- PO No --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                PO No.
                                <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="po_no" value="{{ old('po_no', $poNo) }}" required
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        {{-- PO Date --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Date
                                <span class="text-red-500">*</span>
                            </label>

                            <input type="date" name="po_date" value="{{ old('po_date', now()->format('Y-m-d')) }}"
                                required
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        {{-- PR No --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                PR No.
                            </label>

                            <input type="text" name="pr_no" value="{{ old('pr_no') }}" placeholder="PR-2025-001"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        {{-- Status --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Status
                            </label>

                            <select name="status"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                                @foreach (['Draft', 'Pending'] as $status)
                                    <option value="{{ $status }}" @selected(old('status', 'Draft') === $status)>
                                        {{ $status }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ===================================================== --}}
            {{-- SUPPLIER + DELIVERY --}}
            {{-- ===================================================== --}}

            <div class="grid grid-cols-1 lg:grid-cols-2
                    gap-5 mb-5">


                {{-- SUPPLIER --}}
                <div class="bg-white rounded-xl border
                        border-gray-200 shadow-sm">

                    <div
                        class="px-6 py-4
                            bg-green-600
                            border-b rounded-t-xl border-green-200">

                        <h2 class="font-bold text-white">
                            Supplier Information
                        </h2>

                    </div>


                    <div class="p-6 space-y-5">


                        {{-- Supplier Name --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">

                                Supplier Name

                                <span class="text-red-500">*</span>

                            </label>

                            <input type="text" name="supplier_name" value="{{ old('supplier_name') }}" required
                                placeholder="Supplier name"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        {{-- Address --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Address
                            </label>

                            <textarea name="supplier_address" rows="3" placeholder="Supplier address"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">{{ old('supplier_address') }}</textarea>

                        </div>


                        {{-- Phone --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Telephone
                            </label>

                            <input type="text" name="supplier_phone" value="{{ old('supplier_phone') }}"
                                placeholder="Telephone"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>

                    </div>

                </div>



                {{-- DELIVERY --}}
                <div class="bg-white rounded-xl border
                        border-gray-200 shadow-sm">

                    <div
                        class="px-6 py-4
                            bg-green-600
                            border-b rounded-t-xl border-green-200">

                        <h2 class="font-bold text-white">
                            Delivered To Address
                        </h2>

                    </div>


                    <div class="p-6 space-y-5">


                        {{-- Address --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Delivered To
                            </label>

                            <textarea name="delivery_address" rows="3"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">{{ old('delivery_address', 'The NGO Forum on Cambodia') }}</textarea>

                        </div>


                        {{-- Delivery Date --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Delivery Date
                            </label>

                            <input type="date" name="delivery_date" value="{{ old('delivery_date') }}"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        {{-- Term --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Term of Delivery
                            </label>

                            <input type="text" name="term_of_delivery" value="{{ old('term_of_delivery') }}"
                                placeholder="Service supplier's quotation"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- PAYMENT --}}
            {{-- ===================================================== --}}

            <div class="bg-white rounded-xl border
                    border-gray-200 shadow-sm mb-5">

                <div
                    class="px-6 py-4
                        bg-green-600
                        border-b rounded-t-xl border-green-200">

                    <h2 class="font-bold text-white">
                        Payment Information
                    </h2>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1
                            md:grid-cols-4 gap-5">


                        {{-- Term --}}
                        <div class="col-span-2">

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Term of Payment
                            </label>

                            <input type="text" name="term_of_payment" value="{{ old('term_of_payment') }}"
                                placeholder="After the event"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        {{-- Mode --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Mode of Payment
                            </label>

                            <select name="mode_of_payment"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                                <option value="">
                                    Select
                                </option>

                                <option value="Cash" @selected(old('mode_of_payment') === 'Cash')>
                                    Cash
                                </option>

                                <option value="Cheque" @selected(old('mode_of_payment') === 'Cheque')>
                                    Cheque
                                </option>

                                <option value="Bank Transfer" @selected(old('mode_of_payment') === 'Bank Transfer')>
                                    Bank Transfer
                                </option>

                            </select>

                        </div>


                        {{-- Currency --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold text-gray-700 mb-1">
                                Currency
                            </label>

                            <select name="currency"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                                <option value="USD" @selected(old('currency', 'USD') === 'USD')>
                                    USD
                                </option>

                                <option value="KHR" @selected(old('currency') === 'KHR')>
                                    KHR
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- ITEMS --}}
            {{-- ===================================================== --}}

            <div class="bg-white rounded-xl border
                    border-gray-200 shadow-sm mb-5">

                <div
                    class="px-6 py-4
                        bg-green-600
                        border-b rounded-t-xl border-green-200
                        flex flex-col md:flex-row
                        md:items-center
                        md:justify-between gap-3">

                    <div>

                        <h2 class="font-bold text-white">
                            Purchase Order Items
                        </h2>

                        <p class="text-xs text-gray-200">
                            Add goods or services to this purchase order.
                        </p>

                    </div>


                    <button type="button" id="addItem"
                        class="px-4 py-2
                           bg-white
                           hover:bg-gray-50
                           text-green-600
                           rounded-lg
                           font-semibold">
                        + Add Item
                    </button>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-[1200px] w-full
                           border-collapse">

                        <thead class="bg-green-100">

                            <tr>

                                <th
                                    class="border px-3 py-3
                                       text-sm font-bold
                                       w-12">
                                    #
                                </th>

                                <th
                                    class="border px-3 py-3
                                       text-sm font-bold
                                       text-left
                                       min-w-[350px]">
                                    Description
                                </th>

                                <th
                                    class="border px-3 py-3
                                       text-sm font-bold
                                       w-40">
                                    Required Date
                                </th>

                                <th
                                    class="border px-3 py-3
                                       text-sm font-bold
                                       w-24">
                                    Unit
                                </th>

                                <th
                                    class="border px-3 py-3
                                       text-sm font-bold
                                       w-28">
                                    Quantity
                                </th>

                                <th
                                    class="border px-3 py-3
                                       text-sm font-bold
                                       w-36">
                                    Unit Price
                                </th>

                                <th
                                    class="border px-3 py-3
                                       text-sm font-bold
                                       w-36">
                                    Total
                                </th>

                                <th
                                    class="border px-3 py-3
                                       text-sm font-bold
                                       w-24">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody id="itemsBody">

                            <tr>

                                {{-- Number --}}
                                <td
                                    class="border px-3 py-3
                                       text-center item-number">
                                    1
                                </td>


                                {{-- Description --}}
                                <td class="border px-3 py-3">

                                    <textarea name="items[0][description]" rows="1" required placeholder="Description"
                                        class="w-full rounded-md
                                           border-gray-300
                                           focus:border-green-500
                                           focus:ring-green-500">{{ old('items.0.description') }}</textarea>

                                </td>


                                {{-- Required Date --}}
                                <td class="border px-3 py-3">

                                    <input type="date" name="items[0][required_date]"
                                        value="{{ old('items.0.required_date') }}"
                                        class="w-full rounded-md
                                           border-gray-300
                                           focus:border-green-500
                                           focus:ring-green-500">

                                </td>


                                {{-- Unit --}}
                                <td class="border px-3 py-3">

                                    <input type="text" name="items[0][unit]" value="{{ old('items.0.unit', 'pcs') }}"
                                        class="w-full rounded-md
                                           border-gray-300
                                           focus:border-green-500
                                           focus:ring-green-500">

                                </td>


                                {{-- Quantity --}}
                                <td class="border px-3 py-3">

                                    <input type="number" name="items[0][quantity]"
                                        value="{{ old('items.0.quantity', 1) }}" min="0" step="0.01" required
                                        class="quantity w-full rounded-md
                                           border-gray-300
                                           focus:border-green-500
                                           focus:ring-green-500">

                                </td>


                                {{-- Unit Price --}}
                                <td class="border px-3 py-3">

                                    <input type="number" name="items[0][unit_price]"
                                        value="{{ old('items.0.unit_price', 0) }}" min="0" step="0.01"
                                        required
                                        class="unit-price w-full rounded-md
                                           border-gray-300
                                           focus:border-green-500
                                           focus:ring-green-500">

                                </td>


                                {{-- Total --}}
                                <td class="border px-3 py-3">

                                    <input type="text"
                                        class="item-total w-full
                                           rounded-md
                                           border-gray-300
                                           bg-green-50
                                           focus:border-green-500
                                           focus:ring-green-500"
                                        value="0.00" readonly>

                                </td>


                                {{-- Remove --}}
                                <td class="border px-3 py-3
                                       text-center">

                                    <button type="button"
                                        class="remove-item
                                            inline-flex items-center justify-center
                                            w-9 h-9
                                            rounded-lg
                                            bg-red-50
                                            text-red-600
                                            hover:bg-red-100
                                            hover:text-red-700
                                            transition"
                                        title="Remove Item">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />

                                        </svg>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- NOTES + TOTAL --}}
            {{-- ===================================================== --}}

            <div class="grid grid-cols-1
                    lg:grid-cols-2
                    gap-5 mb-5">


                {{-- Notes --}}
                <div
                    class="bg-white rounded-xl
                        border border-gray-200
                        shadow-sm">

                    <div
                        class="px-6 py-4
                            bg-green-600
                            border-b rounded-t-xl border-green-200">

                        <h2 class="font-bold text-white">
                            Note
                        </h2>

                    </div>


                    <div class="p-6">

                        <textarea name="notes" rows="11" placeholder="Additional notes..."
                            class="w-full rounded-lg
                               border-gray-300
                               focus:border-green-500
                               focus:ring-green-500">{{ old('notes') }}</textarea>


                        <div
                            class="mt-4
                                text-sm
                                text-gray-600 leading-6">

                            <p>
                                1. Please notify us immediately if you are
                                unable to deliver as specified.
                            </p>

                            <p>
                                2. Check will be used to settle this order
                                if the settled amount is equal to or greater
                                than USD150.
                            </p>

                            <p>
                                3. Please send all correspondence to the
                                address above.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Total --}}
                <div class="bg-white rounded-xl
                        border border-gray-200
                        shadow-sm">

                    <div
                        class="px-6 py-4
                            bg-green-600
                            border-b rounded-t-xl
                            border-green-200">

                        <h2 class="font-bold text-white">
                            Order Summary
                        </h2>

                    </div>


                    <div class="p-6 space-y-5">


                        {{-- ========================================================= --}}
                        {{-- SUB TOTAL --}}
                        {{-- ========================================================= --}}

                        <div class="flex justify-between items-center">

                            <span class="font-semibold text-gray-600">
                                Sub Total
                            </span>

                            <span class="font-bold">

                                <span class="currency-symbol">
                                    $
                                </span>

                                <span id="subtotal">
                                    0.00
                                </span>

                            </span>

                        </div>


                        <div class="flex justify-between items-center">

                            <label for="service_charge" class="font-semibold text-gray-600">

                                Service Charge

                            </label>

                            <div class="flex items-center gap-2">

                                <input type="number" id="service_charge" name="service_charge"
                                    value="{{ old('service_charge') }}" min="0" step="0.01" placeholder="0"
                                    class="w-24 rounded-md py-2
                                        border-gray-300
                                        text-right
                                        focus:border-green-500
                                        focus:ring-green-500">

                                <span class="font-semibold text-gray-600">
                                    %
                                </span>

                            </div>

                        </div>


                        {{-- ========================================================= --}}
                        {{-- OTHER TAX CHARGE % --}}
                        {{-- ========================================================= --}}

                        <div class="flex justify-between items-center">

                            <label for="other_tax_charge" class="font-semibold text-gray-600">

                                Other Tax Charge

                            </label>

                            <div class="flex items-center gap-2">

                                <input type="number" id="other_tax_charge" name="other_tax_charge"
                                    value="{{ old('other_tax_charge') }}" min="0" step="0.01" placeholder="0"
                                    class="w-24 rounded-md py-2
                                            border-gray-300
                                            text-right
                                            focus:border-green-500
                                            focus:ring-green-500">

                                <span class="font-semibold text-gray-600">
                                    %
                                </span>

                            </div>

                        </div>


                        {{-- ========================================================= --}}
                        {{-- VAT --}}
                        {{-- ========================================================= --}}

                        <div>

                            <div
                                class="flex
                                    justify-between
                                    items-center">

                                <label for="tax_percent" class="font-semibold text-gray-600">

                                    Tax (VAT or Withholding)

                                </label>


                                <div
                                    class="flex
                                        items-center
                                        gap-2">

                                    <input type="number" id="tax_percent" name="tax_percent"
                                        value="{{ old('tax_percent') }}" min="0" step="0.01" placeholder="0"
                                        class="w-24 py-2
                                            rounded-md
                                            border-gray-300
                                            text-right
                                            focus:border-green-500
                                            focus:ring-green-500">

                                    <span class="font-semibold text-gray-600">
                                        %
                                    </span>

                                </div>

                            </div>


                            {{-- VAT Amount --}}

                            <div
                                class="flex
                                    justify-between
                                    mt-3
                                    text-sm">

                                <span class="text-gray-500">
                                    VAT Amount
                                </span>

                                <span>

                                    <span class="currency-symbol">
                                        $
                                    </span>

                                    <span id="taxAmount">
                                        0.00
                                    </span>

                                </span>

                            </div>

                        </div>


                        {{-- ========================================================= --}}
                        {{-- OTHER CHARGES --}}
                        {{-- ========================================================= --}}

                        <div class="flex justify-between items-center">

                            <label for="other_charges" class="font-semibold text-gray-600">

                                Other Charges

                            </label>

                            <input type="number" id="other_charges" name="other_charges"
                                value="{{ old('other_charges') }}" min="0" step="0.01" placeholder="0.00"
                                class="w-28 rounded-md py-2
                                    border-gray-300
                                    text-right
                                    focus:border-green-500
                                    focus:ring-green-500">

                        </div>


                        {{-- ========================================================= --}}
                        {{-- GRAND TOTAL --}}
                        {{-- ========================================================= --}}

                        <div
                            class="border-t
                                border-gray-200
                                pt-5">

                            <div
                                class="flex
                                    justify-between
                                    items-center">

                                <span
                                    class="text-lg
                                        font-bold
                                        text-gray-800">

                                    Total

                                </span>


                                <span
                                    class="text-2xl
                                        font-bold
                                        text-green-700">

                                    <span class="currency-symbol">
                                        $
                                    </span>

                                    <span id="grandTotal">
                                        0.00
                                    </span>

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ===================================================== --}}
            {{-- ORDERED / APPROVED --}}
            {{-- ===================================================== --}}

            <div class="bg-white rounded-xl
                    border border-gray-200
                    shadow-sm mb-5">

                <div
                    class="px-6 py-4
                        bg-green-600
                        border-b rounded-t-xl border-green-200">

                    <h2 class="font-bold text-white">
                        Ordered By / Approved By
                    </h2>

                </div>


                <div class="p-6">

                    <div
                        class="grid grid-cols-1
                            md:grid-cols-4
                            gap-5">


                        {{-- Ordered --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold
                                      text-gray-700 mb-1">
                                Ordered By
                            </label>

                            <input type="text" name="ordered_by" value="{{ old('ordered_by') }}"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        <div>

                            <label
                                class="block text-sm
                                      font-semibold
                                      text-gray-700 mb-1">
                                Ordered Date
                            </label>

                            <input type="date" name="ordered_date" value="{{ old('ordered_date') }}"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        {{-- Approved --}}
                        <div>

                            <label
                                class="block text-sm
                                      font-semibold
                                      text-gray-700 mb-1">
                                Approved By
                            </label>

                            <input type="text" name="approved_by" value="{{ old('approved_by') }}"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        <div>

                            <label
                                class="block text-sm
                                      font-semibold
                                      text-gray-700 mb-1">
                                Approved Date
                            </label>

                            <input type="date" name="approved_date" value="{{ old('approved_date') }}"
                                class="w-full rounded-lg
                                   border-gray-300
                                   focus:border-green-500
                                   focus:ring-green-500">

                        </div>

                    </div>

                </div>

            </div>



            {{-- ===================================================== --}}
            {{-- ACTION BUTTONS --}}
            {{-- ===================================================== --}}

            <div class="mt-5">

                <div
                    class="flex flex-col-reverse
                        sm:flex-row
                        sm:items-center
                        sm:justify-end
                        gap-3">


                    {{-- Cancel --}}
                    <a href="{{ route('purchase-orders.index') }}"
                        class="group
                            inline-flex items-center
                            justify-center
                            gap-2
                            px-5 py-2.5
                            rounded-xl
                            border border-gray-300
                            bg-white
                            text-gray-700
                            text-sm
                            font-semibold
                            hover:bg-gray-50
                            hover:border-gray-400
                            transition-all duration-200
                            focus:outline-none
                            focus:ring-2
                            focus:ring-gray-300
                            focus:ring-offset-2">

                        {{-- Back Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4
                       transition-transform
                       duration-200
                       group-hover:-translate-x-1"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                        </svg>

                        <span>
                            Cancel
                        </span>

                    </a>


                    {{-- Save Purchase Order --}}
                    <button type="submit"
                        class="group
                            inline-flex items-center
                            justify-center
                            gap-2
                            px-6 py-2.5
                            rounded-xl
                            bg-green-600
                            hover:bg-green-700
                            active:bg-green-800
                            text-white
                            text-sm
                            font-semibold
                            shadow-sm
                            hover:shadow-md
                            transition-all duration-200
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            focus:ring-offset-2">

                        {{-- Save Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4
                       transition-transform
                       duration-200
                       group-hover:scale-110"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 4h11l3 3v13H5V4z
                                                   M8 4v5h8V4
                                                   M8 20v-6h8v6" />

                        </svg>

                        <span>
                            Save
                        </span>

                    </button>

                </div>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let itemIndex = 1;

            const itemsBody =
                document.getElementById('itemsBody');

            const addItemButton =
                document.getElementById('addItem');


            /*
            |--------------------------------------------------------------------------
            | Summary Inputs
            |--------------------------------------------------------------------------
            */

            const serviceChargeInput =
                document.getElementById('service_charge');

            const otherTaxChargeInput =
                document.getElementById('other_tax_charge');

            const taxInput =
                document.getElementById('tax_percent');

            const otherChargesInput =
                document.getElementById('other_charges');


            /*
            |--------------------------------------------------------------------------
            | Add Item
            |--------------------------------------------------------------------------
            */

            addItemButton.addEventListener('click', function() {

                const row =
                    document.createElement('tr');


                row.innerHTML = `

            <td class="border px-3 py-3 text-center item-number">
                ${itemIndex + 1}
            </td>


            <td class="border px-3 py-3">

                <textarea
                    name="items[${itemIndex}][description]"
                    rows="1"
                    required
                    placeholder="Description"
                    class="w-full rounded-md
                           border-gray-300
                           focus:border-green-500
                           focus:ring-green-500"
                ></textarea>

            </td>


            <td class="border px-3 py-3">

                <input
                    type="date"
                    name="items[${itemIndex}][required_date]"
                    class="w-full rounded-md
                           border-gray-300
                           focus:border-green-500
                           focus:ring-green-500"
                >

            </td>


            <td class="border px-3 py-3">

                <input
                    type="text"
                    name="items[${itemIndex}][unit]"
                    placeholder="pcs"
                    class="w-full rounded-md
                           border-gray-300
                           focus:border-green-500
                           focus:ring-green-500"
                >

            </td>


            <td class="border px-3 py-3">

                <input
                    type="number"
                    name="items[${itemIndex}][quantity]"
                    min="0"
                    step="0.01"
                    required
                    placeholder="0"
                    class="quantity w-full rounded-md
                           border-gray-300
                           focus:border-green-500
                           focus:ring-green-500"
                >

            </td>


            <td class="border px-3 py-3">

                <input
                    type="number"
                    name="items[${itemIndex}][unit_price]"
                    min="0"
                    step="0.01"
                    required
                    placeholder="0.00"
                    class="unit-price w-full rounded-md
                           border-gray-300
                           focus:border-green-500
                           focus:ring-green-500"
                >

            </td>


            <td class="border px-3 py-3">

                <input
                    type="text"
                    value="0.00"
                    readonly
                    class="item-total w-full rounded-md
                           border-gray-300
                           bg-green-50
                           focus:border-green-500
                           focus:ring-green-500"
                >

            </td>


            <td class="border px-3 py-3 text-center">

                <button
                    type="button"
                    class="remove-item
                           inline-flex items-center justify-center
                           w-9 h-9
                           rounded-lg
                           bg-red-50
                           text-red-600
                           hover:bg-red-100
                           hover:text-red-700
                           transition"
                    title="Remove Item"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </td>

        `;


                itemsBody.appendChild(row);

                itemIndex++;

                updateNumbers();

                calculateTotals();

            });


            /*
            |--------------------------------------------------------------------------
            | Remove Item
            |--------------------------------------------------------------------------
            */

            itemsBody.addEventListener('click', function(event) {

                const removeButton =
                    event.target.closest('.remove-item');


                if (!removeButton) {
                    return;
                }


                const rows =
                    itemsBody.querySelectorAll('tr');


                if (rows.length <= 1) {

                    alert(
                        'At least one item is required.'
                    );

                    return;
                }


                removeButton
                    .closest('tr')
                    .remove();


                updateNumbers();

                calculateTotals();

            });


            /*
            |--------------------------------------------------------------------------
            | Update Item Numbers
            |--------------------------------------------------------------------------
            */

            function updateNumbers() {

                itemsBody
                    .querySelectorAll('tr')
                    .forEach(function(row, index) {

                        const number =
                            row.querySelector(
                                '.item-number'
                            );


                        if (number) {

                            number.textContent =
                                index + 1;

                        }

                    });

            }


            /*
            |--------------------------------------------------------------------------
            | Calculate Totals
            |--------------------------------------------------------------------------
            */

            function calculateTotals() {

                let subtotal = 0;


                /*
                |--------------------------------------------------------------------------
                | Calculate Item Subtotal
                |--------------------------------------------------------------------------
                */

                itemsBody
                    .querySelectorAll('tr')
                    .forEach(function(row) {

                        const quantity =
                            parseFloat(
                                row.querySelector(
                                    '.quantity'
                                )?.value
                            ) || 0;


                        const unitPrice =
                            parseFloat(
                                row.querySelector(
                                    '.unit-price'
                                )?.value
                            ) || 0;


                        const total =
                            quantity * unitPrice;


                        const totalInput =
                            row.querySelector(
                                '.item-total'
                            );


                        if (totalInput) {

                            totalInput.value =
                                total.toFixed(2);

                        }


                        subtotal += total;

                    });


                /*
                |--------------------------------------------------------------------------
                | Service Charge %
                |--------------------------------------------------------------------------
                */

                const servicePercent =
                    parseFloat(
                        serviceChargeInput?.value
                    ) || 0;


                /*
                |--------------------------------------------------------------------------
                | Other Tax Charge %
                |--------------------------------------------------------------------------
                */

                const otherTaxPercent =
                    parseFloat(
                        otherTaxChargeInput?.value
                    ) || 0;


                /*
                |--------------------------------------------------------------------------
                | VAT %
                |--------------------------------------------------------------------------
                */

                const taxPercent =
                    parseFloat(
                        taxInput?.value
                    ) || 0;


                /*
                |--------------------------------------------------------------------------
                | Other Charges - Fixed Amount
                |--------------------------------------------------------------------------
                */

                const otherCharges =
                    parseFloat(
                        otherChargesInput?.value
                    ) || 0;


                /*
                |--------------------------------------------------------------------------
                | Calculate Service Charge Amount
                |--------------------------------------------------------------------------
                */

                const serviceAmount =
                    subtotal *
                    servicePercent /
                    100;


                /*
                |--------------------------------------------------------------------------
                | Calculate Other Tax Charge Amount
                |--------------------------------------------------------------------------
                */

                const otherTaxAmount =
                    subtotal *
                    otherTaxPercent /
                    100;


                /*
                |--------------------------------------------------------------------------
                | Calculate VAT Amount
                |--------------------------------------------------------------------------
                */

                const taxAmount =
                    subtotal *
                    taxPercent /
                    100;


                /*
                |--------------------------------------------------------------------------
                | Calculate Grand Total
                |--------------------------------------------------------------------------
                */

                const grandTotal =
                    subtotal +
                    serviceAmount +
                    otherTaxAmount +
                    taxAmount +
                    otherCharges;


                /*
                |--------------------------------------------------------------------------
                | Display Sub Total
                |--------------------------------------------------------------------------
                */

                const subtotalElement =
                    document.getElementById(
                        'subtotal'
                    );


                if (subtotalElement) {

                    subtotalElement.textContent =
                        subtotal.toFixed(2);

                }


                /*
                |--------------------------------------------------------------------------
                | Display Service Charge Amount
                |--------------------------------------------------------------------------
                */

                const serviceAmountElement =
                    document.getElementById(
                        'serviceChargeAmount'
                    );


                if (serviceAmountElement) {

                    serviceAmountElement.textContent =
                        serviceAmount.toFixed(2);

                }


                /*
                |--------------------------------------------------------------------------
                | Display Other Tax Charge Amount
                |--------------------------------------------------------------------------
                */

                const otherTaxAmountElement =
                    document.getElementById(
                        'otherTaxChargeAmount'
                    );


                if (otherTaxAmountElement) {

                    otherTaxAmountElement.textContent =
                        otherTaxAmount.toFixed(2);

                }


                /*
                |--------------------------------------------------------------------------
                | Display VAT Amount
                |--------------------------------------------------------------------------
                */

                const taxAmountElement =
                    document.getElementById(
                        'taxAmount'
                    );


                if (taxAmountElement) {

                    taxAmountElement.textContent =
                        taxAmount.toFixed(2);

                }


                /*
                |--------------------------------------------------------------------------
                | Display Grand Total
                |--------------------------------------------------------------------------
                */

                const grandTotalElement =
                    document.getElementById(
                        'grandTotal'
                    );


                if (grandTotalElement) {

                    grandTotalElement.textContent =
                        grandTotal.toFixed(2);

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Input Events
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'input',
                function(event) {

                    if (

                        event.target.classList.contains(
                            'quantity'
                        )

                        ||

                        event.target.classList.contains(
                            'unit-price'
                        )

                        ||

                        event.target.id ===
                        'service_charge'

                        ||

                        event.target.id ===
                        'other_tax_charge'

                        ||

                        event.target.id ===
                        'tax_percent'

                        ||

                        event.target.id ===
                        'other_charges'

                    ) {

                        calculateTotals();

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Initial Calculation
            |--------------------------------------------------------------------------
            */

            calculateTotals();

        });
    </script>

@endsection
