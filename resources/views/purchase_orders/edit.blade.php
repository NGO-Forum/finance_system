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

                        {{-- Edit Icon --}}
                        <div
                            class="flex-shrink-0
                           w-16 h-16
                           flex items-center justify-center
                           rounded-xl
                           bg-gradient-to-br
                           from-green-50 to-emerald-100
                           text-green-700
                           border border-green-100">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                                               M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />

                            </svg>

                        </div>


                        {{-- Text --}}
                        <div class="min-w-0">

                            {{-- Title --}}
                            <div class="flex flex-wrap items-center gap-2.5">

                                <h1
                                    class="text-xl sm:text-2xl
                                   font-bold
                                   tracking-tight
                                   text-green-700">

                                    Edit Purchase Order

                                </h1>


                                {{-- Form Code --}}
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


                            {{-- PO Number --}}
                            <div class="flex flex-wrap items-center
                               gap-2 mt-1.5">

                                <span class="text-sm text-gray-500">
                                    Purchase Order:
                                </span>

                                <span
                                    class="inline-flex items-center
                                   px-2.5 py-1
                                   rounded-md
                                   bg-gray-100
                                   text-gray-700
                                   text-sm
                                   font-semibold">

                                    {{ $purchaseOrder->po_no }}

                                </span>

                            </div>


                            {{-- Description --}}
                            <p class="text-xs text-gray-400 mt-2">

                                Update the purchase order information and save your changes.

                            </p>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- Back Button --}}
                    {{-- ================================================= --}}

                    <a href="{{ route('purchase-orders.index', $purchaseOrder) }}"
                        class="group
                            inline-flex items-center
                            justify-center
                            gap-2
                            w-full sm:w-auto
                            px-4 py-2.5
                            rounded-xl
                            border border-gray-200
                            bg-white
                            hover:bg-gray-50
                            hover:border-gray-300
                            text-green-700
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


        @if ($errors->any())
            <div
                class="mb-6
                    p-4
                    rounded-lg
                    bg-red-50
                    border border-red-200">

                <ul
                    class="list-disc
                       list-inside
                       text-sm
                       text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif



        <form action="{{ route('purchase-orders.update', $purchaseOrder) }}" method="POST">

            @csrf

            @method('PUT')


            {{-- ===================================================== --}}
            {{-- BASIC INFORMATION --}}
            {{-- ===================================================== --}}

            <div
                class="bg-white
                    rounded-xl
                    border border-gray-200
                    shadow-sm
                    mb-6">

                <div
                    class="px-6 py-4
                        bg-green-600 rounded-t-lg
                        border-b border-green-200">

                    <h2 class="font-bold text-white">
                        Purchase Order Information
                    </h2>

                </div>


                <div class="p-6">

                    <div
                        class="grid grid-cols-1
                            md:grid-cols-2
                            lg:grid-cols-4
                            gap-5">


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                PO No.

                            </label>

                            <input type="text" name="po_no" value="{{ old('po_no', $purchaseOrder->po_no) }}" required
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                PO Date

                            </label>

                            <input type="date" name="po_date"
                                value="{{ old('po_date', $purchaseOrder->po_date?->format('Y-m-d')) }}" required
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                PR No.

                            </label>

                            <input type="text" name="pr_no" value="{{ old('pr_no', $purchaseOrder->pr_no) }}"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Status

                            </label>

                            <select name="status"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                                @foreach (['Draft', 'Pending', 'Approved', 'Rejected', 'Completed', 'Cancelled'] as $status)
                                    <option value="{{ $status }}" @selected(old('status', $purchaseOrder->status) === $status)>
                                        {{ $status }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- SUPPLIER / DELIVERY --}}
            {{-- ===================================================== --}}

            <div class="grid grid-cols-1
                    lg:grid-cols-2
                    gap-5 mb-5">


                <div
                    class="bg-white
                        rounded-xl
                        border border-gray-200
                        shadow-sm">

                    <div
                        class="px-6 py-4
                            bg-green-600 rounded-t-xl
                            border-b">

                        <h2 class="font-bold text-white">
                            Supplier Information
                        </h2>

                    </div>


                    <div class="p-6 space-y-5">


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Supplier Name

                            </label>

                            <input type="text" name="supplier_name"
                                value="{{ old('supplier_name', $purchaseOrder->supplier_name) }}" required
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Address

                            </label>

                            <textarea name="supplier_address" rows="3"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">{{ old('supplier_address', $purchaseOrder->supplier_address) }}</textarea>

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Telephone

                            </label>

                            <input type="text" name="supplier_phone"
                                value="{{ old('supplier_phone', $purchaseOrder->supplier_phone) }}"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                        </div>

                    </div>

                </div>



                <div
                    class="bg-white
                        rounded-xl
                        border border-gray-200
                        shadow-sm">

                    <div
                        class="px-6 py-4
                            bg-green-600 rounded-t-xl
                            border-b">

                        <h2 class="font-bold text-white">
                            Delivery Information
                        </h2>

                    </div>


                    <div class="p-6 space-y-5">


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Delivered To

                            </label>

                            <textarea name="delivery_address" rows="3"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">{{ old('delivery_address', $purchaseOrder->delivery_address) }}</textarea>

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Delivery Date

                            </label>

                            <input type="date" name="delivery_date"
                                value="{{ old('delivery_date', $purchaseOrder->delivery_date?->format('Y-m-d')) }}"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Term of Delivery

                            </label>

                            <input type="text" name="term_of_delivery"
                                value="{{ old('term_of_delivery', $purchaseOrder->term_of_delivery) }}"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- PAYMENT --}}
            {{-- ===================================================== --}}

            <div
                class="bg-white
                    rounded-xl
                    border border-gray-200
                    shadow-sm mb-6">

                <div class="px-6 py-4
                        bg-green-600 rounded-t-xl
                        border-b">

                    <h2 class="font-bold text-white">
                        Payment Information
                    </h2>

                </div>


                <div class="p-6">

                    <div
                        class="grid grid-cols-1
                            md:grid-cols-4
                            gap-5">


                        <div class="col-span-2">

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Term of Payment

                            </label>

                            <input type="text" name="term_of_payment"
                                value="{{ old('term_of_payment', $purchaseOrder->term_of_payment) }}"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Mode of Payment

                            </label>

                            <select name="mode_of_payment"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                                <option value="">
                                    Select
                                </option>

                                @foreach (['Cash', 'Cheque', 'Bank Transfer'] as $mode)
                                    <option value="{{ $mode }}" @selected(old('mode_of_payment', $purchaseOrder->mode_of_payment) === $mode)>
                                        {{ $mode }}
                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">

                                Currency

                            </label>

                            <select name="currency"
                                class="w-full rounded-lg
                                   border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                                <option value="USD" @selected(old('currency', $purchaseOrder->currency) === 'USD')>
                                    USD
                                </option>

                                <option value="KHR" @selected(old('currency', $purchaseOrder->currency) === 'KHR')>
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

            <div
                class="bg-white
                    rounded-xl
                    border border-gray-200
                    shadow-sm mb-5">

                <div
                    class="px-6 py-4
                        bg-green-600
                        border-b rounded-t-xl
                        flex justify-between
                        items-center">

                    <h2 class="font-bold text-white">
                        Purchase Order Items
                    </h2>


                    <button type="button" id="addItem"
                        class="px-4 py-2
                           rounded-lg
                           bg-white
                           hover:bg-gray-200
                           text-green-600
                           font-semibold">
                        + Add Item
                    </button>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-[1100px] w-full">

                        <thead class="bg-green-100 text-sm">

                            <tr>

                                <th class="border px-3 py-3">
                                    #
                                </th>

                                <th class="border px-3 py-3 text-left">
                                    Description
                                </th>

                                <th class="border px-3 py-3">
                                    Required Date
                                </th>

                                <th class="border px-3 py-3">
                                    Unit
                                </th>

                                <th class="border px-3 py-3">
                                    Qty
                                </th>

                                <th class="border px-3 py-3">
                                    Unit Price
                                </th>

                                <th class="border px-3 py-3">
                                    Total
                                </th>

                                <th class="border px-3 py-3">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody id="itemsBody">

                            @foreach ($purchaseOrder->items as $index => $item)
                                <tr>

                                    <td
                                        class="border px-3 py-3
                                           text-center
                                           item-number">

                                        {{ $index + 1 }}

                                    </td>


                                    <td class="border px-3 py-3 w-[550px]">

                                        <textarea name="items[{{ $index }}][description]" rows="1" required
                                            class="w-full rounded-md mt-1
                                               border-gray-300 focus:border-green-500
                                   focus:ring-green-500">{{ old("items.$index.description", $item->description) }}</textarea>

                                    </td>


                                    <td class="border px-3 py-3">

                                        <input type="date" name="items[{{ $index }}][required_date]"
                                            value="{{ old("items.$index.required_date", $item->required_date?->format('Y-m-d')) }}"
                                            class="w-full rounded-md
                                               border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                                    </td>


                                    <td class="border px-3 py-3">

                                        <input type="text" name="items[{{ $index }}][unit]"
                                            value="{{ old("items.$index.unit", $item->unit) }}"
                                            class="w-full rounded-md
                                               border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                                    </td>


                                    <td class="border px-3 py-3">

                                        <input type="number" name="items[{{ $index }}][quantity]"
                                            value="{{ old("items.$index.quantity", $item->quantity) }}" min="0"
                                            step="0.01" required
                                            class="quantity w-full text-right
                                               rounded-md
                                               border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                                    </td>


                                    <td class="border px-3 py-3">

                                        <input type="number" name="items[{{ $index }}][unit_price]"
                                            value="{{ old("items.$index.unit_price", $item->unit_price) }}"
                                            min="0" step="0.01" required
                                            class="unit-price w-full text-right
                                               rounded-md
                                               border-gray-300 focus:border-green-500
                                   focus:ring-green-500">

                                    </td>


                                    <td class="border px-3 py-3">

                                        <input type="text" value="{{ number_format($item->total, 2) }}" readonly
                                            class="item-total w-full text-right
                                               rounded-md
                                               border-gray-300
                                               bg-green-100 focus:border-green-500
                                   focus:ring-green-500">

                                    </td>


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
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>



            {{-- ===================================================== --}}
            {{-- TOTALS --}}
            {{-- ===================================================== --}}

            <div class="grid grid-cols-1
                    lg:grid-cols-2
                    gap-5 mb-5">


                <div
                    class="bg-white
                        rounded-xl
                        border border-gray-200
                        shadow-sm">

                    <div
                        class="px-6 py-4
                            bg-green-600 rounded-t-xl
                            border-b">

                        <h2 class="font-bold text-white">
                            Notes
                        </h2>

                    </div>


                    <div class="p-6">

                        <textarea name="notes" rows="5"
                            class="w-full rounded-lg
                               border-gray-300 focus:border-green-500
                                   focus:ring-green-500">{{ old('notes', $purchaseOrder->notes) }}</textarea>

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


                <div
                    class="bg-white
                        rounded-xl
                        border border-gray-200
                        shadow-sm">

                    <div
                        class="px-6 py-4
                            bg-green-600 rounded-t-xl
                            border-b">

                        <h2 class="font-bold text-white">
                            Order Summary
                        </h2>

                    </div>


                    <div class="p-6 space-y-5">


                        <div class="flex justify-between">

                            <span>
                                Sub Total
                            </span>

                            <strong>
                                <span id="subtotal">
                                    0.00
                                </span>
                            </strong>

                        </div>


                        <div>

                            <div
                                class="flex
                                    justify-between
                                    items-center">

                                <span>
                                    VAT
                                </span>

                                <input type="number" id="tax_percent" name="tax_percent"
                                    value="{{ old('tax_percent', $purchaseOrder->tax_percent) }}" min="0"
                                    step="0.01"
                                    class="w-20 py-1
                                       rounded-md
                                       border-gray-300
                                       text-right focus:border-green-500
                                   focus:ring-green-500">

                            </div>


                            <div
                                class="flex
                                    justify-between
                                    mt-3
                                    text-sm">

                                <span>
                                    VAT Amount
                                </span>

                                <span id="taxAmount">
                                    0.00
                                </span>

                            </div>

                        </div>


                        <div class="flex justify-between">

                            <label
                                class="block
                                      font-semibold
                                      mb-2">

                                Other Charges

                            </label>

                            <input type="number" id="other_charges" name="other_charges"
                                value="{{ old('other_charges', $purchaseOrder->other_charges) }}" min="0"
                                step="0.01"
                                class="w-64 py-1 rounded-md text-right
                                   border-gray-300">

                        </div>


                        <div class="border-t
                                pt-5">

                            <div
                                class="flex
                                    justify-between
                                    text-xl
                                    font-bold">

                                <span>
                                    TOTAL
                                </span>

                                <span class="text-green-700">
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
            {{-- ORDER / APPROVAL / VENDOR --}}
            {{-- ===================================================== --}}

            <div
                class="bg-white
                    rounded-xl
                    border border-gray-200
                    shadow-sm mb-5">

                <div class="px-6 py-4
                        bg-green-600 rounded-t-xl
                        border-b">

                    <h2 class="font-bold text-white">
                        Order / Approval / Vendor
                    </h2>

                </div>


                <div class="p-6">

                    <div
                        class="grid grid-cols-1
                            md:grid-cols-2
                            gap-5">


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">
                                Ordered By
                            </label>

                            <input type="text" name="ordered_by"
                                value="{{ old('ordered_by', $purchaseOrder->ordered_by) }}"
                                class="w-full rounded-lg
                                   border-gray-300">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">
                                Ordered Date
                            </label>

                            <input type="date" name="ordered_date"
                                value="{{ old('ordered_date', $purchaseOrder->ordered_date?->format('Y-m-d')) }}"
                                class="w-full rounded-lg
                                   border-gray-300">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">
                                Approved By
                            </label>

                            <input type="text" name="approved_by"
                                value="{{ old('approved_by', $purchaseOrder->approved_by) }}"
                                class="w-full rounded-lg
                                   border-gray-300">

                        </div>


                        <div>

                            <label class="block text-sm
                                      font-semibold mb-1">
                                Approved Date
                            </label>

                            <input type="date" name="approved_date"
                                value="{{ old('approved_date', $purchaseOrder->approved_date?->format('Y-m-d')) }}"
                                class="w-full rounded-lg
                                   border-gray-300">

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


                    {{-- Cancel / Back --}}
                    <a href="{{ route('purchase-orders.index', $purchaseOrder) }}"
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
                            shadow-sm
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


                    {{-- Update Purchase Order --}}
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

                        {{-- Update Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4
                                transition-transform
                                duration-200
                                group-hover:rotate-[-8deg]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 11a8.1 8.1 0 01-8 8
                           8 8 0 117.2-11.5
                           M20 4v6h-6" />

                        </svg>

                        <span>
                            Update
                        </span>

                    </button>

                </div>

            </div>

        </form>

    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let itemIndex =
                {{ $purchaseOrder->items->count() }};


            const itemsBody =
                document.getElementById('itemsBody');


            const addItem =
                document.getElementById('addItem');


            const taxPercent =
                document.getElementById('tax_percent');


            const otherCharges =
                document.getElementById('other_charges');


            /*
            |--------------------------------------------------------------------------
            | Add
            |--------------------------------------------------------------------------
            */

            addItem.addEventListener('click', function() {

                const row =
                    document.createElement('tr');


                row.innerHTML = `

            <td class="border px-3 py-3
                       text-center item-number">
                ${itemIndex + 1}
            </td>

            <td class="border px-3 py-3">

                <textarea
                    name="items[${itemIndex}][description]"
                    rows="1"
                    required
                    class="w-full rounded-md mt-1
                           border-gray-300 focus:border-green-500
                                   focus:ring-green-500"
                ></textarea>

            </td>

            <td class="border px-3 py-3">

                <input
                    type="date"
                    name="items[${itemIndex}][required_date]"
                    class="w-full rounded-md
                           border-gray-300 focus:border-green-500
                                   focus:ring-green-500"
                >

            </td>

            <td class="border px-3 py-3">

                <input
                    type="text"
                    name="items[${itemIndex}][unit]"
                    value="pcs"
                    class="w-full rounded-md
                           border-gray-300 focus:border-green-500
                                   focus:ring-green-500"
                >

            </td>

            <td class="border px-3 py-3">

                <input
                    type="number"
                    name="items[${itemIndex}][quantity]"
                    value="1"
                    min="0"
                    step="0.01"
                    required
                    class="quantity w-full text-right
                           rounded-md
                           border-gray-300 focus:border-green-500
                                   focus:ring-green-500"
                >

            </td>

            <td class="border px-3 py-3">

                <input
                    type="number"
                    name="items[${itemIndex}][unit_price]"
                    value="0"
                    min="0"
                    step="0.01"
                    required
                    class="unit-price w-full text-right
                           rounded-md
                           border-gray-300 focus:border-green-500
                                   focus:ring-green-500"
                >

            </td>

            <td class="border px-3 py-3">

                <input
                    type="text"
                    value="0.00"
                    readonly
                    class="item-total w-full
                           rounded-md text-right
                           border-gray-300
                           bg-green-100 focus:border-green-500
                                   focus:ring-green-500"
                >

            </td>

            <td class="border px-3 py-3
                       text-center">

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
                    title="Remove Item">

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
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </td>
        `;


                itemsBody.appendChild(row);

                itemIndex++;

                calculate();

            });


            /*
            |--------------------------------------------------------------------------
            | Remove
            |--------------------------------------------------------------------------
            */

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

                    alert('At least one item is required.');

                    return;
                }


                removeButton
                    .closest('tr')
                    .remove();


                updateNumbers();

                calculate();

            });


            /*
            |--------------------------------------------------------------------------
            | Numbers
            |--------------------------------------------------------------------------
            */

            function updateNumbers() {
                itemsBody
                    .querySelectorAll('tr')
                    .forEach(
                        function(row, index) {

                            row.querySelector(
                                    '.item-number'
                                ).textContent =
                                index + 1;

                        }
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | Calculate
            |--------------------------------------------------------------------------
            */

            function calculate() {

                let subtotal = 0;


                itemsBody
                    .querySelectorAll('tr')
                    .forEach(function(row) {

                        const quantity =
                            parseFloat(
                                row.querySelector(
                                    '.quantity'
                                )?.value
                            ) || 0;


                        const price =
                            parseFloat(
                                row.querySelector(
                                    '.unit-price'
                                )?.value
                            ) || 0;


                        const total =
                            quantity * price;


                        const totalInput =
                            row.querySelector(
                                '.item-total'
                            );


                        totalInput.value =
                            total.toFixed(2);


                        subtotal += total;

                    });


                const tax =
                    subtotal *
                    (
                        parseFloat(
                            taxPercent.value
                        ) || 0
                    ) / 100;


                const other =
                    parseFloat(
                        otherCharges.value
                    ) || 0;


                const total =
                    subtotal +
                    tax +
                    other;


                document.getElementById(
                        'subtotal'
                    ).textContent =
                    subtotal.toFixed(2);


                document.getElementById(
                        'taxAmount'
                    ).textContent =
                    tax.toFixed(2);


                document.getElementById(
                        'grandTotal'
                    ).textContent =
                    total.toFixed(2);

            }


            /*
            |--------------------------------------------------------------------------
            | Inputs
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'input',
                function() {

                    calculate();

                }
            );


            calculate();

        });
    </script>

@endsection
