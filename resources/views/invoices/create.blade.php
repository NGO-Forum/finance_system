@extends('layout.app')

@section('content')

    <div class="max-w-full mx-auto">

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

                <div class="flex items-center gap-4">

                    {{-- Icon --}}
                    <div
                        class="
                            w-12
                            h-12
                            rounded-xl
                            bg-green-100
                            text-green-700
                            flex
                            items-center
                            justify-center
                            shrink-0
                        ">

                        <i class="fa-solid fa-file-circle-plus text-xl"></i>

                    </div>


                    {{-- Title --}}
                    <div>

                        <div class="flex items-center gap-2">

                            <h1
                                class="
                                    text-2xl
                                    font-bold
                                    text-gray-800
                                    tracking-tight
                                ">
                                Create Invoice
                            </h1>


                            <span
                                class="
                                    inline-flex
                                    items-center
                                    px-2.5
                                    py-1
                                    rounded-full
                                    bg-green-50
                                    text-green-700
                                    border
                                    border-green-100
                                    text-xs
                                    font-bold
                                ">
                                FM02-14
                            </span>

                        </div>


                        <p
                            class="
                                text-sm
                                text-gray-500
                                mt-1
                            ">
                            Create a new invoice and add goods or services.
                        </p>

                    </div>

                </div>

                <a href="{{ route('invoices.index') }}"
                    class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-4
                            py-2.5
                            bg-green-600
                            hover:bg-green-700
                            text-white
                            rounded-lg
                            text-sm
                            font-semibold
                            transition
                            duration-200
                            whitespace-nowrap
                        ">

                    <i class="fa-solid fa-arrow-left text-xs"></i>

                    Back

                </a>

            </div>

        </div>


        {{-- ERRORS --}}
        @if ($errors->any())
            <div
                class="
                    mb-6
                    p-4
                    bg-red-50
                    border
                    border-red-200
                    rounded-lg
                    text-red-700
                ">

                <ul class="list-disc ml-5 text-sm">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif


        <form method="POST" action="{{ route('invoices.store') }}" id="invoiceForm">

            @csrf

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

                    {{-- Icon --}}
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


                    {{-- Title --}}
                    <div>

                        <h2 class="text-base font-bold text-gray-800">
                            Invoice Information
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Enter the basic invoice and customer information.
                        </p>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-x-5 gap-y-5">


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

                                <span class="text-red-500">
                                    *
                                </span>

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


                                <input type="text" id="invoice_no" name="invoice_no" value="{{ old('invoice_no') }}"
                                    placeholder="INV-0001" maxlength="100" required autocomplete="off"
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
                                            placeholder-gray-400
                                            outline-none
                                            transition
                                            duration-200
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

                                <span class="text-red-500">
                                    *
                                </span>

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
                                    value="{{ old('invoice_date', now()->format('Y-m-d')) }}" required
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
                                            duration-200
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


                                <input type="text" id="customer" name="customer" value="{{ old('customer') }}"
                                    placeholder="Customer name" maxlength="255" autocomplete="off"
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
                                        placeholder-gray-400
                                        outline-none
                                        transition
                                        duration-200
                                        hover:border-gray-400
                                        focus:border-green-500
                                        focus:ring-2
                                        focus:ring-green-100
                                    ">

                            </div>

                            @error('customer')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <div>

                            <label for="comany"
                                class="
                                        block
                                        text-xs
                                        font-bold
                                        uppercase
                                        tracking-wide
                                        text-gray-600
                                        mb-1.5
                                    ">

                                ENTITY​/CUSTOMER

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


                                <input type="text" id="company" name="company" value="{{ old('company') }}"
                                    placeholder="Entity name" maxlength="255" autocomplete="off"
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
                                        placeholder-gray-400
                                        outline-none
                                        transition
                                        duration-200
                                        hover:border-gray-400
                                        focus:border-green-500
                                        focus:ring-2
                                        focus:ring-green-100
                                    ">

                            </div>

                            @error('company')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>



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


                                <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}"
                                    placeholder="+855 XX XXX XXX" maxlength="100" autocomplete="off"
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
                                        placeholder-gray-400
                                        outline-none
                                        transition
                                        duration-200
                                        hover:border-gray-400
                                        focus:border-green-500
                                        focus:ring-2
                                        focus:ring-green-100
                                    ">

                            </div>

                            @error('telephone')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


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
                                        left-3
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
                                        duration-200
                                        hover:border-gray-400
                                        focus:border-green-500
                                        focus:ring-2
                                        focus:ring-green-100
                                    ">{{ old('address') }}</textarea>

                            </div>

                            @error('address')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

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
                    overflow-hidden
                    mb-6
                ">


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

                    {{-- LEFT --}}
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
                                    1
                                </span>

                            </div>


                            <p class="text-xs text-gray-500 mt-0.5">
                                Add goods or services included in this invoice.
                            </p>

                        </div>

                    </div>



                    {{-- ADD ITEM BUTTON --}}
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
                            hover:shadow
                            transition-all
                            duration-200
                            whitespace-nowrap
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


                <div class="p-6">

                    <div
                        class="
                            overflow-x-auto
                            rounded-xl
                            border
                            border-gray-200
                        ">

                        <table class="w-full border-collapse min-w-[850px]" id="itemsTable">

                            <thead>

                                <tr class="bg-green-50 border-b border-green-100">

                                    <th
                                        class="
                                            px-4
                                            py-3
                                            text-center
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-gray-600
                                            border-r
                                            border-green-100
                                            w-16
                                        ">
                                        No.
                                    </th>


                                    <th
                                        class="
                                            px-4
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-gray-600
                                            border-r
                                            border-green-100
                                        ">
                                        Description
                                    </th>


                                    <th
                                        class="
                                            px-4
                                            py-3
                                            text-center
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-gray-600
                                            border-r
                                            border-green-100
                                            w-24
                                        ">
                                        Quantity
                                    </th>


                                    <th
                                        class="
                                            px-4
                                            py-3
                                            text-center
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-gray-600
                                            border-r
                                            border-green-100
                                            w-32
                                        ">
                                        Unit Price
                                    </th>


                                    <th
                                        class="
                                            px-4
                                            py-3
                                            text-center
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-gray-600
                                            border-r
                                            border-green-100
                                            w-28
                                        ">
                                        Amount
                                    </th>


                                    <th
                                        class="
                                            px-4
                                            py-3
                                            text-center
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-gray-600
                                            w-20
                                        ">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="itemsBody" class="divide-y divide-gray-100">


                                <tr
                                    class="
                                        item-row
                                        group
                                        bg-white
                                        hover:bg-green-50/30
                                        transition-colors
                                        duration-150
                                    ">

                                    {{-- NUMBER --}}
                                    <td
                                        class="
                                            px-4
                                            py-3
                                            text-center
                                            border-r
                                            border-gray-200
                                            align-middle
                                        ">

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
                                            1
                                        </span>

                                    </td>



                                    {{-- DESCRIPTION --}}
                                    <td
                                        class="
                                            px-4
                                            py-3
                                            border-r
                                            border-gray-200
                                        ">

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


                                            <input type="text" name="items[0][description]" required maxlength="2000"
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
                                                    placeholder-gray-400
                                                    outline-none
                                                    transition
                                                    duration-200
                                                    hover:border-gray-400
                                                    focus:border-green-500
                                                    focus:ring-2
                                                    focus:ring-green-100
                                                ">

                                        </div>

                                    </td>



                                    {{-- QUANTITY --}}
                                    <td
                                        class="
                                            px-4
                                            py-3
                                            border-r
                                            border-gray-200
                                        ">

                                        <input type="number" name="items[0][quantity]" value="1" min="0"
                                            step="0.01" required
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
                                                text-gray-700
                                                text-center
                                                outline-none
                                                transition
                                                duration-200
                                                hover:border-gray-400
                                                focus:border-green-500
                                                focus:ring-2
                                                focus:ring-green-100
                                            ">

                                    </td>



                                    {{-- UNIT PRICE --}}
                                    <td
                                        class="
                                                px-4
                                                py-3
                                                border-r
                                                border-gray-200
                                            ">

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


                                            <input type="number" name="items[0][unit_price]" value="0"
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
                                                    text-gray-700
                                                    text-right
                                                    outline-none
                                                    transition
                                                    duration-200
                                                    hover:border-gray-400
                                                    focus:border-green-500
                                                    focus:ring-2
                                                    focus:ring-green-100
                                                ">

                                        </div>

                                    </td>



                                    {{-- AMOUNT --}}
                                    <td
                                        class="
                                            px-4
                                            py-3
                                            text-right
                                            border-r
                                            border-gray-200
                                            align-middle
                                        ">

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
                                                0.00
                                            </span>

                                        </div>

                                    </td>



                                    {{-- REMOVE --}}
                                    <td
                                        class="
                                            px-4
                                            py-3
                                            text-center
                                            align-middle
                                        ">

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

                            </tbody>


                            <tfoot>

                                <tr>

                                    {{-- GRAND TOTAL LABEL --}}
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

                                            <i
                                                class="
                                                    fa-solid
                                                    fa-calculator
                                                    text-green-600
                                                "></i>

                                            Grand Total

                                        </div>

                                    </td>



                                    {{-- GRAND TOTAL --}}
                                    <td colspan="2"
                                        class="
                                            px-4
                                            py-4
                                            text-right
                                            bg-green-600
                                            border-t
                                            border-green-100
                                            border-r
                                        ">

                                        <div
                                            class="
                                                text-lg
                                                font-bold
                                                text-white
                                            ">

                                            <span class="text-sm font-semibold">
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


                        {{-- AMOUNT IN WORDS --}}
                        <div class="m-5">

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
                                        "
                                    placeholder="Amount in words will appear automatically">

                            </div>

                            <p class="mt-1.5 text-xs text-gray-400">
                                Automatically generated from the Grand Total.
                            </p>

                        </div>

                    </div>


                    <div
                        class="
                            flex
                            items-center
                            gap-2
                            mt-3
                            text-xs
                            text-gray-400
                        ">

                        <i class="fa-solid fa-circle-info"></i>

                        <span>
                            Amount is calculated automatically from quantity × unit price.
                        </span>

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
                                bg-green-50
                                text-green-600
                                flex
                                items-center
                                justify-center
                                shrink-0
                            ">

                            <i class="fa-solid fa-circle-check text-sm"></i>

                        </div>


                        <div>

                            <p class="text-sm font-semibold text-gray-700">
                                Ready to save?
                            </p>

                            <p class="text-xs text-gray-400 mt-0.5">
                                Review the invoice information before saving.
                            </p>

                        </div>

                    </div>


                    <div
                        class="
                            flex
                            items-center
                            justify-end
                            gap-2
                        ">

                        {{-- CANCEL --}}
                        <a href="{{ route('invoices.index') }}"
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
                                transition-all
                                duration-200
                            ">

                            <i class="fa-solid fa-xmark text-xs"></i>

                            Cancel

                        </a>



                        {{-- SAVE --}}
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
                                transition-all
                                duration-200
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

                            Save

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>


    <<script>
        document.addEventListener('DOMContentLoaded', function() {

            // ============================================================
            // ELEMENTS
            // ============================================================

            const itemsBody =
                document.getElementById('itemsBody');

            const addItemButton =
                document.getElementById('addItem');

            const grandTotalElement =
                document.getElementById('grandTotal');

            const amountInWordsElement =
                document.getElementById('amount_in_words');

            const itemCountElement =
                document.getElementById('itemCount');


            // ============================================================
            // SAFETY CHECK
            // ============================================================

            if (!itemsBody) {
                return;
            }


            // ============================================================
            // ROW INDEX
            // ============================================================

            let rowIndex =
                itemsBody.querySelectorAll('.item-row').length;


            // ============================================================
            // FORMAT MONEY
            // ============================================================

            function formatMoney(number) {
                return Number(number || 0).toLocaleString(
                    'en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                );
            }


            // ============================================================
            // NUMBER TO WORDS
            // ============================================================

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


                // --------------------------------------------------------
                // Convert numbers from 0 - 999
                // --------------------------------------------------------

                function convertLessThanThousand(num) {
                    let words = '';


                    if (num >= 100) {

                        words +=
                            ones[Math.floor(num / 100)] +
                            ' Hundred';

                        num %= 100;


                        if (num > 0) {
                            words += ' ';
                        }

                    }


                    if (num >= 20) {

                        words +=
                            tens[Math.floor(num / 10)];

                        num %= 10;


                        if (num > 0) {

                            words +=
                                ' ' + ones[num];

                        }

                    } else if (num > 0) {

                        words +=
                            ones[num];

                    }


                    return words;
                }


                // --------------------------------------------------------
                // Convert large number
                // --------------------------------------------------------

                function convert(num) {
                    if (num === 0) {
                        return 'Zero';
                    }


                    let result = '';


                    // Billion
                    const billion =
                        Math.floor(num / 1000000000);

                    num %= 1000000000;


                    if (billion > 0) {

                        result +=
                            convertLessThanThousand(billion) +
                            ' Billion';

                    }


                    // Million
                    const million =
                        Math.floor(num / 1000000);

                    num %= 1000000;


                    if (million > 0) {

                        if (result !== '') {
                            result += ' ';
                        }


                        result +=
                            convertLessThanThousand(million) +
                            ' Million';

                    }


                    // Thousand
                    const thousand =
                        Math.floor(num / 1000);

                    num %= 1000;


                    if (thousand > 0) {

                        if (result !== '') {
                            result += ' ';
                        }


                        result +=
                            convertLessThanThousand(thousand) +
                            ' Thousand';

                    }


                    // Remaining
                    if (num > 0) {

                        if (result !== '') {
                            result += ' ';
                        }


                        result +=
                            convertLessThanThousand(num);

                    }


                    return result;
                }


                // --------------------------------------------------------
                // Separate dollars and cents
                // --------------------------------------------------------

                const totalCents =
                    Math.round(number * 100);


                const dollars =
                    Math.floor(totalCents / 100);


                const cents =
                    totalCents % 100;


                // --------------------------------------------------------
                // Build result
                // --------------------------------------------------------

                let result =
                    convert(dollars) +
                    ' US Dollars';


                if (cents > 0) {

                    result +=
                        ' and ' +
                        convert(cents) +
                        ' Cents';

                }


                return result + ' Only';
            }


            // ============================================================
            // CALCULATE ONE ROW
            // ============================================================

            function calculateRow(row) {
                if (!row) {
                    return 0;
                }


                const quantityInput =
                    row.querySelector('.quantity');

                const unitPriceInput =
                    row.querySelector('.unit-price');

                const amountElement =
                    row.querySelector('.amount');


                const quantity =
                    parseFloat(
                        quantityInput?.value
                    ) || 0;


                const unitPrice =
                    parseFloat(
                        unitPriceInput?.value
                    ) || 0;


                const amount =
                    quantity * unitPrice;


                if (amountElement) {

                    amountElement.textContent =
                        formatMoney(amount);

                }


                return amount;
            }


            // ============================================================
            // CALCULATE GRAND TOTAL
            // ============================================================

            function calculateGrandTotal() {
                let total = 0;


                const rows =
                    itemsBody.querySelectorAll('.item-row');


                rows.forEach(function(row) {

                    total +=
                        calculateRow(row);

                });


                // --------------------------------------------------------
                // Update Grand Total
                // --------------------------------------------------------

                if (grandTotalElement) {

                    grandTotalElement.textContent =
                        formatMoney(total);

                }


                // --------------------------------------------------------
                // Update Amount in Words
                // --------------------------------------------------------

                if (amountInWordsElement) {

                    amountInWordsElement.value =
                        numberToWords(total);

                }


                // --------------------------------------------------------
                // Update item count
                // --------------------------------------------------------

                if (itemCountElement) {

                    itemCountElement.textContent =
                        rows.length;

                }
            }


            // ============================================================
            // UPDATE ROW NUMBERS
            // ============================================================

            function updateNumbers() {
                const rows =
                    itemsBody.querySelectorAll('.item-row');


                rows.forEach(function(row, index) {

                    const numberElement =
                        row.querySelector('.item-number');


                    if (numberElement) {

                        numberElement.textContent =
                            index + 1;

                    }

                });


                // Update item count
                if (itemCountElement) {

                    itemCountElement.textContent =
                        rows.length;

                }
            }


            // ============================================================
            // INPUT CALCULATION
            // ============================================================

            itemsBody.addEventListener(
                'input',
                function(event) {

                    const row =
                        event.target.closest('.item-row');


                    if (!row) {
                        return;
                    }


                    if (
                        event.target.classList.contains('quantity') ||
                        event.target.classList.contains('unit-price')
                    ) {

                        calculateRow(row);

                        calculateGrandTotal();

                    }

                }
            );


            // ============================================================
            // ADD ITEM
            // ============================================================

            if (addItemButton) {

                addItemButton.addEventListener(
                    'click',
                    function() {

                        const row =
                            document.createElement('tr');


                        row.className =
                            `
                    item-row
                    group
                    bg-white
                    hover:bg-green-50/30
                    transition-colors
                    duration-150
                    `;


                        row.innerHTML = `

                    <!-- NUMBER -->

                    <td
                        class="
                            px-4
                            py-3
                            text-center
                            border-r
                            border-gray-200
                            align-middle
                        "
                    >

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


                    <!-- DESCRIPTION -->

                    <td
                        class="
                            px-4
                            py-3
                            border-r
                            border-gray-200
                        "
                    >

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
                                "
                            >

                                <i
                                    class="
                                        fa-solid
                                        fa-align-left
                                        text-xs
                                    "
                                ></i>

                            </div>


                            <input
                                type="text"
                                name="items[${rowIndex}][description]"
                                required
                                maxlength="2000"
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
                                    placeholder-gray-400
                                    outline-none
                                    transition
                                    duration-200
                                    hover:border-gray-400
                                    focus:border-green-500
                                    focus:ring-2
                                    focus:ring-green-100
                                "
                            >

                        </div>

                    </td>


                    <!-- QUANTITY -->

                    <td
                        class="
                            px-4
                            py-3
                            border-r
                            border-gray-200
                        "
                    >

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
                                bg-white
                                text-sm
                                text-gray-700
                                text-center
                                outline-none
                                transition
                                duration-200
                                hover:border-gray-400
                                focus:border-green-500
                                focus:ring-2
                                focus:ring-green-100
                            "
                        >

                    </td>


                    <!-- UNIT PRICE -->

                    <td
                        class="
                            px-4
                            py-3
                            border-r
                            border-gray-200
                        "
                    >

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
                                    bg-white
                                    text-sm
                                    text-gray-700
                                    text-right
                                    outline-none
                                    transition
                                    duration-200
                                    hover:border-gray-400
                                    focus:border-green-500
                                    focus:ring-2
                                    focus:ring-green-100
                                "
                            >

                        </div>

                    </td>


                    <!-- AMOUNT -->

                    <td
                        class="
                            px-4
                            py-3
                            text-right
                            border-r
                            border-gray-200
                            align-middle
                        "
                    >

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
                            "
                        >

                            <span
                                class="
                                    text-gray-400
                                    text-xs
                                "
                            >
                                $
                            </span>

                            <span class="amount">
                                0.00
                            </span>

                        </div>

                    </td>


                    <!-- REMOVE -->

                    <td
                        class="
                            px-4
                            py-3
                            text-center
                            align-middle
                        "
                    >

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
                                hover:text-red-700
                                transition
                            "
                            title="Remove item"
                        >

                            <i
                                class="
                                    fa-solid
                                    fa-trash
                                    text-xs
                                "
                            ></i>

                        </button>

                    </td>

                `;


                        itemsBody.appendChild(row);


                        rowIndex++;


                        updateNumbers();

                        calculateGrandTotal();


                        // Focus new description
                        const descriptionInput =
                            row.querySelector(
                                'input[name*="[description]"]'
                            );


                        if (descriptionInput) {

                            descriptionInput.focus();

                        }

                    }
                );

            }


            // ============================================================
            // REMOVE ITEM
            // ============================================================

            itemsBody.addEventListener(
                'click',
                function(event) {

                    const button =
                        event.target.closest('.remove-item');


                    if (!button) {
                        return;
                    }


                    const rows =
                        itemsBody.querySelectorAll('.item-row');


                    // Don't allow removing the last item
                    if (rows.length <= 1) {

                        alert(
                            'At least one invoice item is required.'
                        );

                        return;

                    }


                    const row =
                        button.closest('.item-row');


                    if (row) {

                        row.remove();

                    }


                    updateNumbers();

                    calculateGrandTotal();

                }
            );


            // ============================================================
            // INITIAL CALCULATION
            // ============================================================

            updateNumbers();

            calculateGrandTotal();

        });
    </script>
@endsection
