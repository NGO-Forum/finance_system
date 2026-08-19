@extends('layout.app')

@section('content')

    <div class="max-w-full mx-auto">

        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div
            class="
            bg-white
            border
            border-gray-200
            rounded-2xl
            shadow-sm
            px-6
            py-5
            mb-5
        ">

            <div
                class="
                flex
                flex-col
                sm:flex-row
                sm:items-center
                sm:justify-between
                gap-4
            ">

                {{-- LEFT --}}
                <div class="flex items-center gap-4">

                    <div
                        class="
                        w-12
                        h-12
                        rounded-xl
                        bg-amber-100
                        text-amber-700
                        flex
                        items-center
                        justify-center
                        shrink-0
                    ">
                        <i class="fa-solid fa-file-pen text-xl"></i>
                    </div>

                    <div>

                        <div class="flex items-center gap-2 flex-wrap">

                            <h1
                                class="
                                text-2xl
                                font-bold
                                text-gray-800
                                tracking-tight
                            ">
                                Edit Invoice
                            </h1>

                            <span
                                class="
                                inline-flex
                                items-center
                                px-2.5
                                py-1
                                rounded-full
                                bg-amber-50
                                text-amber-700
                                border
                                border-amber-100
                                text-xs
                                font-bold
                            ">
                                FM02-14
                            </span>

                        </div>

                        <p class="text-sm text-gray-500 mt-1">

                            Update invoice

                            <span class="font-semibold text-gray-700">
                                {{ $invoice->invoice_no }}
                            </span>

                        </p>

                    </div>

                </div>


                {{-- VIEW --}}
                <a href="{{ route('invoices.show', $invoice) }}"
                    class="
                    inline-flex
                    items-center
                    justify-center
                    gap-2
                    px-4
                    py-2.5
                    bg-gray-100
                    hover:bg-gray-200
                    text-gray-700
                    rounded-lg
                    text-sm
                    font-semibold
                    transition
                ">
                    <i class="fa-solid fa-eye text-xs"></i>

                    View Invoice

                </a>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- VALIDATION ERRORS --}}
        {{-- ========================================================= --}}

        @if ($errors->any())

            <div
                class="
                mb-6
                p-4
                bg-red-50
                border
                border-red-200
                rounded-xl
                text-red-700
            ">

                <div class="flex items-start gap-3">

                    <i class="fa-solid fa-circle-exclamation mt-0.5"></i>

                    <div>

                        <p class="font-semibold mb-1">
                            Please correct the following errors:
                        </p>

                        <ul class="list-disc ml-5 text-sm space-y-1">

                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif



        {{-- ========================================================= --}}
        {{-- FORM --}}
        {{-- ========================================================= --}}

        <form method="POST" action="{{ route('invoices.update', $invoice) }}" id="invoiceForm">

            @csrf

            @method('PUT')


            {{-- ===================================================== --}}
            {{-- INVOICE INFORMATION --}}
            {{-- ===================================================== --}}

            <div
                class="
                bg-white
                border
                border-gray-200
                rounded-2xl
                shadow-sm
                overflow-hidden
                mb-5
            ">

                {{-- HEADER --}}

                <div
                    class="
                    flex
                    items-center
                    gap-3
                    px-6
                    py-4
                    bg-gray-50/70
                    border-b
                    border-gray-100
                ">

                    <div
                        class="
                        w-10
                        h-10
                        rounded-xl
                        bg-green-100
                        text-green-700
                        flex
                        items-center
                        justify-center
                        shrink-0
                    ">
                        <i class="fa-solid fa-file-invoice text-sm"></i>
                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-800">
                            Invoice Information
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Update the basic invoice and customer information.
                        </p>

                    </div>

                </div>


                {{-- BODY --}}

                <div class="p-6">

                    <div
                        class="
                        grid
                        grid-cols-1
                        md:grid-cols-5
                        gap-x-5
                        gap-y-5
                    ">

                        {{-- INVOICE NO --}}

                        <div>

                            <label for="invoice_no"
                                class="
                                flex
                                items-center
                                gap-1
                                text-xs
                                font-bold
                                uppercase
                                tracking-wide
                                text-gray-600
                                mb-1.5
                            ">
                                Invoice No.

                                <span class="text-red-500">*</span>

                            </label>

                            <div class="relative">

                                <div
                                    class="
                                    absolute
                                    inset-y-0
                                    left-0
                                    pl-3
                                    flex
                                    items-center
                                    pointer-events-none
                                    text-gray-400
                                ">
                                    <i class="fa-solid fa-hashtag text-xs"></i>
                                </div>

                                <input type="text" id="invoice_no" name="invoice_no"
                                    value="{{ old('invoice_no', $invoice->invoice_no) }}" placeholder="INV-0001"
                                    maxlength="100" required autocomplete="off"
                                    class="
                                    w-full
                                    h-11
                                    pl-9
                                    pr-3
                                    rounded-lg
                                    border
                                    border-gray-300
                                    bg-white
                                    text-sm
                                    text-gray-700
                                    outline-none
                                    transition
                                    hover:border-gray-400
                                    focus:border-green-500
                                    focus:ring-2
                                    focus:ring-green-100
                                ">

                            </div>

                            @error('invoice_no')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>



                        {{-- DATE --}}

                        <div>

                            <label for="invoice_date"
                                class="
                                flex
                                items-center
                                gap-1
                                text-xs
                                font-bold
                                uppercase
                                tracking-wide
                                text-gray-600
                                mb-1.5
                            ">

                                Invoice Date

                                <span class="text-red-500">*</span>

                            </label>

                            <div class="relative">

                                <div
                                    class="
                                    absolute
                                    inset-y-0
                                    left-0
                                    pl-3
                                    flex
                                    items-center
                                    pointer-events-none
                                    text-gray-400
                                    z-10
                                ">
                                    <i class="fa-regular fa-calendar-days text-xs"></i>
                                </div>

                                <input type="date" id="invoice_date" name="invoice_date"
                                    value="{{ old('invoice_date', $invoice->invoice_date?->format('Y-m-d')) }}" required
                                    class="
                                    w-full
                                    h-11
                                    pl-9
                                    pr-3
                                    rounded-lg
                                    border
                                    border-gray-300
                                    bg-white
                                    text-sm
                                    text-gray-700
                                    outline-none
                                    transition
                                    hover:border-gray-400
                                    focus:border-green-500
                                    focus:ring-2
                                    focus:ring-green-100
                                ">

                            </div>

                            @error('invoice_date')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>



                        {{-- CUSTOMER --}}

                        <div>

                            <label for="customer"
                                class="
                                block
                                text-xs
                                font-bold
                                uppercase
                                tracking-wide
                                text-gray-600
                                mb-1.5
                            ">
                                Customer
                            </label>

                            <div class="relative">

                                <div
                                    class="
                                    absolute
                                    inset-y-0
                                    left-0
                                    pl-3
                                    flex
                                    items-center
                                    pointer-events-none
                                    text-gray-400
                                ">
                                    <i class="fa-solid fa-user text-xs"></i>
                                </div>

                                <input type="text" id="customer" name="customer"
                                    value="{{ old('customer', $invoice->customer) }}" placeholder="Customer name"
                                    maxlength="255" autocomplete="off"
                                    class="
                                    w-full
                                    h-11
                                    pl-9
                                    pr-3
                                    rounded-lg
                                    border
                                    border-gray-300
                                    bg-white
                                    text-sm
                                    text-gray-700
                                    outline-none
                                    transition
                                    hover:border-gray-400
                                    focus:border-green-500
                                    focus:ring-2
                                    focus:ring-green-100
                                ">

                            </div>

                        </div>



                        {{-- COMPANY / ENTITY --}}

                        <div>

                            <label for="company"
                                class="
                                block
                                text-xs
                                font-bold
                                uppercase
                                tracking-wide
                                text-gray-600
                                mb-1.5
                            ">
                                Entity / Customer
                            </label>

                            <div class="relative">

                                <div
                                    class="
                                    absolute
                                    inset-y-0
                                    left-0
                                    pl-3
                                    flex
                                    items-center
                                    pointer-events-none
                                    text-gray-400
                                ">
                                    <i class="fa-solid fa-building text-xs"></i>
                                </div>

                                <input type="text" id="company" name="company"
                                    value="{{ old('company', $invoice->company) }}" placeholder="Entity name"
                                    maxlength="255" autocomplete="off"
                                    class="
                                    w-full
                                    h-11
                                    pl-9
                                    pr-3
                                    rounded-lg
                                    border
                                    border-gray-300
                                    bg-white
                                    text-sm
                                    text-gray-700
                                    outline-none
                                    transition
                                    hover:border-gray-400
                                    focus:border-green-500
                                    focus:ring-2
                                    focus:ring-green-100
                                ">

                            </div>

                        </div>



                        {{-- TELEPHONE --}}

                        <div>

                            <label for="telephone"
                                class="
                                block
                                text-xs
                                font-bold
                                uppercase
                                tracking-wide
                                text-gray-600
                                mb-1.5
                            ">
                                Telephone
                            </label>

                            <div class="relative">

                                <div
                                    class="
                                    absolute
                                    inset-y-0
                                    left-0
                                    pl-3
                                    flex
                                    items-center
                                    pointer-events-none
                                    text-gray-400
                                ">
                                    <i class="fa-solid fa-phone text-xs"></i>
                                </div>

                                <input type="text" id="telephone" name="telephone"
                                    value="{{ old('telephone', $invoice->telephone) }}" placeholder="+855 XX XXX XXX"
                                    maxlength="100" autocomplete="off"
                                    class="
                                    w-full
                                    h-11
                                    pl-9
                                    pr-3
                                    rounded-lg
                                    border
                                    border-gray-300
                                    bg-white
                                    text-sm
                                    text-gray-700
                                    outline-none
                                    transition
                                    hover:border-gray-400
                                    focus:border-green-500
                                    focus:ring-2
                                    focus:ring-green-100
                                ">

                            </div>

                        </div>



                        {{-- ADDRESS --}}

                        <div class="md:col-span-5">

                            <label for="address"
                                class="
                                block
                                text-xs
                                font-bold
                                uppercase
                                tracking-wide
                                text-gray-600
                                mb-1.5
                            ">
                                Address
                            </label>

                            <div class="relative">

                                <div
                                    class="
                                    absolute
                                    top-3
                                    left-0
                                    pl-3
                                    flex
                                    items-center
                                    pointer-events-none
                                    text-gray-400
                                ">
                                    <i class="fa-solid fa-location-dot text-xs"></i>
                                </div>

                                <textarea id="address" name="address" rows="2" maxlength="1000" placeholder="Customer address"
                                    class="
                                    w-full
                                    pl-9
                                    pr-3
                                    py-2.5
                                    rounded-lg
                                    border
                                    border-gray-300
                                    bg-white
                                    text-sm
                                    text-gray-700
                                    placeholder-gray-400
                                    outline-none
                                    resize-none
                                    transition
                                    hover:border-gray-400
                                    focus:border-green-500
                                    focus:ring-2
                                    focus:ring-green-100
                                ">{{ old('address', $invoice->address) }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ========================================================= --}}
            {{-- INVOICE ITEMS --}}
            {{-- ========================================================= --}}

            <div
                class="
                bg-white
                border
                border-gray-200
                rounded-2xl
                shadow-sm
                overflow-hidden
                mb-6
            ">

                {{-- HEADER --}}

                <div
                    class="
                    px-6
                    py-4
                    bg-gray-50/70
                    border-b
                    border-gray-100
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-4
                ">

                    <div class="flex items-center gap-3">

                        <div
                            class="
                            w-10
                            h-10
                            rounded-xl
                            bg-green-100
                            text-green-700
                            flex
                            items-center
                            justify-center
                            shrink-0
                        ">
                            <i class="fa-solid fa-cart-shopping text-sm"></i>
                        </div>

                        <div>

                            <div class="flex items-center gap-2">

                                <h2 class="text-base font-bold text-gray-800">
                                    Invoice Items
                                </h2>

                                <span id="itemCount"
                                    class="
                                    inline-flex
                                    items-center
                                    justify-center
                                    min-w-[24px]
                                    h-6
                                    px-2
                                    rounded-full
                                    bg-green-100
                                    text-green-700
                                    text-xs
                                    font-bold
                                ">
                                    {{ $invoice->items->count() }}
                                </span>

                            </div>

                            <p class="text-xs text-gray-500 mt-0.5">
                                Update goods or services included in this invoice.
                            </p>

                        </div>

                    </div>


                    {{-- ADD ITEM --}}

                    <button type="button" id="addItem"
                        class="
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        px-4
                        py-2.5
                        bg-green-700
                        hover:bg-green-800
                        active:bg-green-900
                        text-white
                        rounded-lg
                        text-sm
                        font-semibold
                        shadow-sm
                        transition
                    ">

                        <span
                            class="
                            w-5
                            h-5
                            rounded-md
                            bg-white/20
                            flex
                            items-center
                            justify-center
                        ">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                        </span>

                        Add Item

                    </button>

                </div>



                {{-- TABLE --}}

                <div class="p-6">

                    <div
                        class="
                        overflow-x-auto
                        rounded-xl
                        border
                        border-gray-200
                    ">

                        <table id="itemsTable" class="w-full border-collapse min-w-[850px]">

                            <thead>

                                <tr class="bg-green-50 border-b border-green-100">

                                    <th
                                        class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-gray-600 w-16">
                                        No.
                                    </th>

                                    <th
                                        class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-gray-600">
                                        Description
                                    </th>

                                    <th
                                        class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-gray-600 w-28">
                                        Quantity
                                    </th>

                                    <th
                                        class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-gray-600 w-36">
                                        Unit Price
                                    </th>

                                    <th
                                        class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-gray-600 w-32">
                                        Amount
                                    </th>

                                    <th
                                        class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-gray-600 w-20">
                                        Action
                                    </th>

                                </tr>

                            </thead>



                            <tbody id="itemsBody" class="divide-y divide-gray-100">

                                @foreach ($invoice->items as $index => $item)
                                    <tr
                                        class="
                                        item-row
                                        group
                                        bg-white
                                        hover:bg-green-50/30
                                        transition-colors
                                    ">

                                        {{-- NUMBER --}}

                                        <td class="px-4 py-3 text-center border-r border-gray-200">

                                            <span
                                                class="
                                                inline-flex
                                                items-center
                                                justify-center
                                                w-7
                                                h-7
                                                rounded-lg
                                                bg-gray-100
                                                text-gray-600
                                                text-xs
                                                font-bold
                                                item-number
                                            ">
                                                {{ $index + 1 }}
                                            </span>

                                        </td>



                                        {{-- DESCRIPTION --}}

                                        <td class="px-4 py-3 border-r border-gray-200">

                                            <div class="relative">

                                                <div
                                                    class="
                                                    absolute
                                                    inset-y-0
                                                    left-0
                                                    pl-3
                                                    flex
                                                    items-center
                                                    pointer-events-none
                                                    text-gray-400
                                                ">
                                                    <i class="fa-solid fa-align-left text-xs"></i>
                                                </div>

                                                <input type="text" name="items[{{ $index }}][description]"
                                                    value="{{ old("items.$index.description", $item->description) }}"
                                                    required maxlength="2000"
                                                    placeholder="Description of goods or service"
                                                    class="
                                                    w-full
                                                    h-10
                                                    pl-9
                                                    pr-3
                                                    rounded-lg
                                                    border
                                                    border-gray-300
                                                    bg-white
                                                    text-sm
                                                    text-gray-700
                                                    outline-none
                                                    transition
                                                    hover:border-gray-400
                                                    focus:border-green-500
                                                    focus:ring-2
                                                    focus:ring-green-100
                                                ">

                                            </div>

                                        </td>



                                        {{-- QUANTITY --}}

                                        <td class="px-4 py-3 border-r border-gray-200">

                                            <input type="number" name="items[{{ $index }}][quantity]"
                                                value="{{ old("items.$index.quantity", $item->quantity) }}"
                                                min="0" step="0.01" required
                                                class="
                                                quantity
                                                w-full
                                                h-10
                                                px-3
                                                rounded-lg
                                                border
                                                border-gray-300
                                                bg-white
                                                text-sm
                                                text-center
                                                outline-none
                                                transition
                                                focus:border-green-500
                                                focus:ring-2
                                                focus:ring-green-100
                                            ">

                                        </td>



                                        {{-- UNIT PRICE --}}

                                        <td class="px-4 py-3 border-r border-gray-200">

                                            <div class="relative">

                                                <span
                                                    class="
                                                    absolute
                                                    inset-y-0
                                                    left-0
                                                    pl-3
                                                    flex
                                                    items-center
                                                    text-gray-400
                                                    text-xs
                                                    pointer-events-none
                                                ">
                                                    $
                                                </span>

                                                <input type="number" name="items[{{ $index }}][unit_price]"
                                                    value="{{ old("items.$index.unit_price", $item->unit_price) }}"
                                                    min="0" step="0.01" required
                                                    class="
                                                    unit-price
                                                    w-full
                                                    h-10
                                                    pl-7
                                                    pr-3
                                                    rounded-lg
                                                    border
                                                    border-gray-300
                                                    bg-white
                                                    text-sm
                                                    text-right
                                                    outline-none
                                                    transition
                                                    focus:border-green-500
                                                    focus:ring-2
                                                    focus:ring-green-100
                                                ">

                                            </div>

                                        </td>



                                        {{-- AMOUNT --}}

                                        <td class="px-4 py-3 text-right border-r border-gray-200">

                                            <div
                                                class="
                                                inline-flex
                                                items-center
                                                justify-end
                                                gap-1
                                                min-w-[100px]
                                                px-3
                                                py-2
                                                rounded-lg
                                                bg-green-50
                                                text-gray-800
                                                font-bold
                                                text-sm
                                            ">

                                                <span class="text-gray-400 text-xs">
                                                    $
                                                </span>

                                                <span class="amount">
                                                    {{ number_format($item->quantity * $item->unit_price, 2) }}
                                                </span>

                                            </div>

                                        </td>



                                        {{-- DELETE --}}

                                        <td class="px-4 py-3 text-center">

                                            <button type="button"
                                                class="
                                                remove-item
                                                inline-flex
                                                items-center
                                                justify-center
                                                w-9
                                                h-9
                                                rounded-lg
                                                bg-red-50
                                                text-red-600
                                                hover:bg-red-100
                                                hover:text-red-700
                                                transition
                                            "
                                                title="Remove item">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>



                            {{-- TOTAL --}}

                            <tfoot>

                                <tr>

                                    <td colspan="4"
                                        class="
                                        px-4
                                        py-4
                                        text-right
                                        bg-gray-50
                                        border-t
                                        border-gray-200
                                        text-sm
                                        font-bold
                                        text-gray-700
                                    ">

                                        <div
                                            class="
                                            inline-flex
                                            items-center
                                            gap-2
                                        ">

                                            <i class="fa-solid fa-calculator text-green-600"></i>

                                            Grand Total

                                        </div>

                                    </td>


                                    <td colspan="2"
                                        class="
                                        px-4
                                        py-4
                                        text-right
                                        bg-green-600
                                        border-t
                                        border-green-100
                                    ">

                                        <div class="text-lg font-bold text-white">

                                            <span class="text-sm">
                                                $
                                            </span>

                                            <span id="grandTotal">
                                                0.00
                                            </span>

                                        </div>

                                    </td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>



                    {{-- AMOUNT IN WORDS --}}

                    <div class="mt-5">

                        <label for="amount_in_words"
                            class="
                            block
                            text-xs
                            font-bold
                            uppercase
                            tracking-wide
                            text-gray-600
                            mb-1.5
                        ">
                            Amount in Words
                        </label>

                        <div class="relative">

                            <div
                                class="
                                absolute
                                top-3
                                left-3
                                flex
                                items-center
                                pointer-events-none
                                text-green-600
                            ">
                                <i class="fa-solid fa-spell-check text-sm"></i>
                            </div>

                            <input type="text" id="amount_in_words" name="amount_in_words" readonly
                                value="{{ old('amount_in_words', $invoice->amount_in_words) }}"
                                class="
                                w-full
                                h-11
                                pl-10
                                pr-4
                                rounded-lg
                                border
                                border-gray-300
                                bg-gray-50
                                text-sm
                                font-medium
                                text-gray-700
                                outline-none
                            ">

                        </div>

                        <p class="mt-1.5 text-xs text-gray-400">
                            Automatically generated from the Grand Total.
                        </p>

                    </div>

                </div>

            </div>



            <div
                class="
                bg-white
                border
                border-gray-200
                rounded-2xl
                shadow-sm
                px-6
                py-4
                mb-6
            ">

                <div
                    class="
                    flex
                    flex-col-reverse
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-4
                ">

                    <div class="flex items-center gap-3">

                        <div
                            class="
                            w-9
                            h-9
                            rounded-lg
                            bg-amber-50
                            text-amber-600
                            flex
                            items-center
                            justify-center
                        ">
                            <i class="fa-solid fa-circle-info text-sm"></i>
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-gray-700">
                                Ready to update?
                            </p>

                            <p class="text-xs text-gray-400 mt-0.5">
                                Review the invoice before saving your changes.
                            </p>

                        </div>

                    </div>



                    <div class="flex items-center justify-end gap-2">

                        {{-- CANCEL --}}

                        <a href="{{ route('invoices.show', $invoice) }}"
                            class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            h-10
                            px-4
                            bg-white
                            hover:bg-gray-50
                            text-gray-600
                            hover:text-gray-800
                            border
                            border-gray-300
                            rounded-lg
                            text-sm
                            font-semibold
                            transition
                        ">

                            <i class="fa-solid fa-xmark text-xs"></i>

                            Cancel

                        </a>



                        {{-- UPDATE --}}

                        <button type="submit"
                            class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            h-10
                            px-5
                            bg-green-700
                            hover:bg-green-800
                            active:bg-green-900
                            text-white
                            rounded-lg
                            text-sm
                            font-semibold
                            shadow-sm
                            hover:shadow-md
                            transition
                        ">

                            <span
                                class="
                                w-5
                                h-5
                                rounded-md
                                bg-white/20
                                flex
                                items-center
                                justify-center
                            ">
                                <i class="fa-solid fa-check text-[10px]"></i>
                            </span>

                            Update

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const itemsBody = document.getElementById('itemsBody');
            const addItemButton = document.getElementById('addItem');
            const grandTotalElement = document.getElementById('grandTotal');
            const amountInWordsElement = document.getElementById('amount_in_words');
            const itemCountElement = document.getElementById('itemCount');

            let rowIndex = itemsBody.querySelectorAll('.item-row').length;


            function formatMoney(value) {

                return Number(value || 0).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

            }


            function numberToWords(number) {

                number = Number(number);

                if (!Number.isFinite(number)) {
                    return '';
                }

                if (number === 0) {
                    return 'Zero US Dollars Only';
                }

                const ones = [
                    '',
                    'One',
                    'Two',
                    'Three',
                    'Four',
                    'Five',
                    'Six',
                    'Seven',
                    'Eight',
                    'Nine',
                    'Ten',
                    'Eleven',
                    'Twelve',
                    'Thirteen',
                    'Fourteen',
                    'Fifteen',
                    'Sixteen',
                    'Seventeen',
                    'Eighteen',
                    'Nineteen'
                ];

                const tens = [
                    '',
                    '',
                    'Twenty',
                    'Thirty',
                    'Forty',
                    'Fifty',
                    'Sixty',
                    'Seventy',
                    'Eighty',
                    'Ninety'
                ];


                function lessThanThousand(num) {

                    let words = '';

                    if (num >= 100) {

                        words += ones[Math.floor(num / 100)] + ' Hundred';

                        num %= 100;

                        if (num > 0) {
                            words += ' ';
                        }

                    }

                    if (num >= 20) {

                        words += tens[Math.floor(num / 10)];

                        num %= 10;

                        if (num > 0) {
                            words += ' ' + ones[num];
                        }

                    } else if (num > 0) {

                        words += ones[num];

                    }

                    return words;
                }


                function convert(num) {

                    if (num === 0) {
                        return 'Zero';
                    }

                    let result = '';

                    const billion = Math.floor(num / 1000000000);

                    num %= 1000000000;

                    if (billion > 0) {

                        result += lessThanThousand(billion) + ' Billion';

                    }


                    const million = Math.floor(num / 1000000);

                    num %= 1000000;

                    if (million > 0) {

                        if (result) {
                            result += ' ';
                        }

                        result += lessThanThousand(million) + ' Million';

                    }


                    const thousand = Math.floor(num / 1000);

                    num %= 1000;

                    if (thousand > 0) {

                        if (result) {
                            result += ' ';
                        }

                        result += lessThanThousand(thousand) + ' Thousand';

                    }


                    if (num > 0) {

                        if (result) {
                            result += ' ';
                        }

                        result += lessThanThousand(num);

                    }

                    return result;
                }


                const totalCents = Math.round(number * 100);

                const dollars = Math.floor(totalCents / 100);

                const cents = totalCents % 100;


                let result = convert(dollars) + ' US Dollars';


                if (cents > 0) {

                    result += ' and ' + convert(cents) + ' Cents';

                }


                return result + ' Only';
            }


            function calculateRow(row) {

                const quantity =
                    parseFloat(
                        row.querySelector('.quantity')?.value
                    ) || 0;

                const unitPrice =
                    parseFloat(
                        row.querySelector('.unit-price')?.value
                    ) || 0;

                const amount = quantity * unitPrice;


                const amountElement =
                    row.querySelector('.amount');

                if (amountElement) {

                    amountElement.textContent =
                        formatMoney(amount);

                }

                return amount;
            }


            function calculateGrandTotal() {

                let total = 0;

                const rows =
                    itemsBody.querySelectorAll('.item-row');


                rows.forEach(row => {

                    total += calculateRow(row);

                });


                grandTotalElement.textContent =
                    formatMoney(total);


                if (amountInWordsElement) {

                    amountInWordsElement.value =
                        numberToWords(total);

                }


                if (itemCountElement) {

                    itemCountElement.textContent =
                        rows.length;

                }

            }


            function updateNumbers() {

                const rows =
                    itemsBody.querySelectorAll('.item-row');


                rows.forEach((row, index) => {

                    const number =
                        row.querySelector('.item-number');

                    if (number) {

                        number.textContent =
                            index + 1;

                    }

                });


                if (itemCountElement) {

                    itemCountElement.textContent =
                        rows.length;

                }

            }


            // =========================================================
            // INPUT
            // =========================================================

            itemsBody.addEventListener('input', function(event) {

                if (
                    event.target.classList.contains('quantity') ||
                    event.target.classList.contains('unit-price')
                ) {

                    calculateGrandTotal();

                }

            });


            // =========================================================
            // ADD ITEM
            // =========================================================

            addItemButton.addEventListener('click', function() {

                const row =
                    document.createElement('tr');

                row.className =
                    'item-row group bg-white hover:bg-green-50/30 transition-colors duration-150';


                row.innerHTML = `

            <td class="px-4 py-3 text-center border-r border-gray-200">

                <span
                    class="
                        inline-flex
                        items-center
                        justify-center
                        w-7
                        h-7
                        rounded-lg
                        bg-gray-100
                        text-gray-600
                        text-xs
                        font-bold
                        item-number
                    "
                >
                    ${rowIndex + 1}
                </span>

            </td>


            <td class="px-4 py-3 border-r border-gray-200">

                <input
                    type="text"
                    name="items[${rowIndex}][description]"
                    required
                    maxlength="2000"
                    placeholder="Description of goods or service"
                    class="
                        w-full
                        h-10
                        px-3
                        rounded-lg
                        border
                        border-gray-300
                        text-sm
                        outline-none
                        focus:border-green-500
                        focus:ring-2
                        focus:ring-green-100
                    "
                >

            </td>


            <td class="px-4 py-3 border-r border-gray-200">

                <input
                    type="number"
                    name="items[${rowIndex}][quantity]"
                    value="1"
                    min="0"
                    step="0.01"
                    required
                    class="
                        quantity
                        w-full
                        h-10
                        px-3
                        rounded-lg
                        border
                        border-gray-300
                        text-sm
                        text-center
                        outline-none
                        focus:border-green-500
                        focus:ring-2
                        focus:ring-green-100
                    "
                >

            </td>


            <td class="px-4 py-3 border-r border-gray-200">

                <div class="relative">

                    <span
                        class="
                            absolute
                            inset-y-0
                            left-0
                            pl-3
                            flex
                            items-center
                            text-gray-400
                            text-xs
                        "
                    >
                        $
                    </span>

                    <input
                        type="number"
                        name="items[${rowIndex}][unit_price]"
                        value="0"
                        min="0"
                        step="0.01"
                        required
                        class="
                            unit-price
                            w-full
                            h-10
                            pl-7
                            pr-3
                            rounded-lg
                            border
                            border-gray-300
                            text-sm
                            text-right
                            outline-none
                            focus:border-green-500
                            focus:ring-2
                            focus:ring-green-100
                        "
                    >

                </div>

            </td>


            <td class="px-4 py-3 text-right border-r border-gray-200">

                <div
                    class="
                        inline-flex
                        items-center
                        gap-1
                        px-3
                        py-2
                        rounded-lg
                        bg-green-50
                        text-gray-800
                        font-bold
                        text-sm
                    "
                >

                    <span class="text-gray-400 text-xs">
                        $
                    </span>

                    <span class="amount">
                        0.00
                    </span>

                </div>

            </td>


            <td class="px-4 py-3 text-center">

                <button
                    type="button"
                    class="
                        remove-item
                        inline-flex
                        items-center
                        justify-center
                        w-9
                        h-9
                        rounded-lg
                        bg-red-50
                        text-red-600
                        hover:bg-red-100
                        transition
                    "
                >

                    <i class="fa-solid fa-trash text-xs"></i>

                </button>

            </td>

        `;


                itemsBody.appendChild(row);

                rowIndex++;

                updateNumbers();

                calculateGrandTotal();


                row.querySelector(
                    'input[name*="[description]"]'
                )?.focus();

            });


            // =========================================================
            // REMOVE ITEM
            // =========================================================

            itemsBody.addEventListener('click', function(event) {

                const button =
                    event.target.closest('.remove-item');


                if (!button) {
                    return;
                }


                const rows =
                    itemsBody.querySelectorAll('.item-row');


                if (rows.length <= 1) {

                    alert(
                        'At least one invoice item is required.'
                    );

                    return;
                }


                button.closest('.item-row')?.remove();


                updateNumbers();

                calculateGrandTotal();

            });


            // =========================================================
            // INITIAL CALCULATION
            // =========================================================

            updateNumbers();

            calculateGrandTotal();

        });
    </script>
@endsection