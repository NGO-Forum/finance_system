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
                   lg:flex-row
                   lg:items-center
                   lg:justify-between
                   gap-5
                   px-6 py-5 pl-7">


                    {{-- ================================================= --}}
                    {{-- Title --}}
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
                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2.5">

                                <h1
                                    class="text-xl sm:text-2xl
                                   font-bold
                                   tracking-tight
                                   text-gray-800">

                                    Purchase Order

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
                                    Purchase Order No.
                                </span>

                                <span
                                    class="inline-flex items-center
                                   px-2.5 py-1
                                   rounded-lg
                                   bg-gray-100
                                   text-gray-700
                                   text-sm
                                   font-semibold">

                                    {{ $purchaseOrder->po_no }}

                                </span>

                            </div>


                            <p class="text-xs text-gray-400 mt-2">

                                View and manage purchase order details

                            </p>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- Actions --}}
                    {{-- ================================================= --}}

                    <div
                        class="flex flex-col
                       sm:flex-row
                       gap-2.5
                       w-full lg:w-auto">


                        {{-- Back --}}
                        <a href="{{ route('purchase-orders.index') }}"
                            class="group
                           inline-flex items-center
                           justify-center
                           gap-2
                           px-4 py-2.5
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

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4
                               transition-transform
                               duration-200
                               group-hover:-translate-x-1"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                            </svg>

                            Back

                        </a>


                        {{-- Edit --}}
                        <a href="{{ route('purchase-orders.edit', $purchaseOrder) }}"
                            class="inline-flex items-center
                           justify-center
                           gap-2
                           px-4 py-2.5
                           rounded-xl
                           bg-amber-500
                           hover:bg-amber-600
                           active:bg-amber-700
                           text-white
                           text-sm
                           font-semibold
                           shadow-sm
                           hover:shadow-md
                           transition-all duration-200
                           focus:outline-none
                           focus:ring-2
                           focus:ring-amber-400
                           focus:ring-offset-2">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                                               M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />

                            </svg>

                            Edit

                        </a>


                        {{-- PDF --}}
                        <a href="{{ route('purchase-orders.pdf', $purchaseOrder) }}" target="_blank"
                            class="inline-flex items-center
                                justify-center
                                gap-2
                                px-5 py-2.5
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

                            {{-- PDF Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M7 3h7l5 5v13H7a2 2 0 01-2-2V5a2 2 0 012-2z" />

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14 3v6h6" />

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 14h2a1.5 1.5 0 000-3H8v6" />

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M13 11h1.5a2.5 2.5 0 010 5H13v-5z" />

                            </svg>

                            PDF

                        </a>

                    </div>

                </div>

            </div>

        </div>



        {{-- PO --}}
        <div
            class="bg-white
                border border-gray-300
                shadow-sm
                print:shadow-none">


            {{-- ========================================================= --}}
            {{-- PURCHASE ORDER HEADER --}}
            {{-- ========================================================= --}}
            <div class="border border-gray-300 bg-white">

                {{-- ===================================================== --}}
                {{-- TOP HEADER --}}
                {{-- ===================================================== --}}

                <div class="grid grid-cols-12 border-b border-gray-300">


                    {{-- ================================================= --}}
                    {{-- LOGO --}}
                    {{-- ================================================= --}}

                    <div
                        class="col-span-2
                   flex items-start justify-center
                   px-3 py-2
                   ">

                        <img src="{{ asset('images/logo.png') }}" alt="The NGO Forum on Cambodia"
                            class="w-auto h-20 object-contain">

                    </div>


                    {{-- ================================================= --}}
                    {{-- ORGANIZATION NAME --}}
                    {{-- ================================================= --}}

                    <div
                        class="col-span-9
                        flex items-start justify-center
                        px-3 py-2
                        ">

                        <img src="{{ asset('images/exp.jpg') }}" alt="The NGO Forum on Cambodia"
                            class="w-auto h-20 object-contain">

                    </div>


                    {{-- ================================================= --}}
                    {{-- FORM CODE --}}
                    {{-- ================================================= --}}

                    <div
                        class="col-span-1
                        flex items-start
                        justify-end
                        px-3 py-1">

                        <span class="text-gray-600
                       text-sm
                       font-medium">

                            FM02-11

                        </span>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- TITLE + DATE / PO / PR --}}
                {{-- ===================================================== --}}

                <div class="grid grid-cols-12">


                    {{-- ================================================= --}}
                    {{-- LEFT SIDE --}}
                    {{-- ================================================= --}}

                    <div class="col-span-3 border-r border-gray-300">

                        {{-- Address --}}
                        <div
                            class="px-4 py-3
                                text-sm
                                text-gray-800
                                leading-7">

                            #9-11, St. 476, Sangkat Toul Tompoung I,
                            Khan Chamkarmon, Phnom Penh.

                            Tel: (+855) 78 550 449,
                            Fax: (+855) 78 550 449

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- CENTER SIDE --}}
                    {{-- --}}
                    <div class="col-span-6 border-r border-gray-300">


                        {{-- Purchase Order Title --}}
                        <div class="flex justify-center py-3">

                            <div
                                class="border
                                    border-gray-500
                                    px-8 py-2
                                    min-w-[380px]
                                    text-center">

                                <h1
                                    class="text-2xl
                                        font-bold
                                        text-green-800
                                        tracking-wide">

                                    ប័ណ្ណបញ្ជាទិញ Purchase Order

                                </h1>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- RIGHT SIDE --}}
                    {{-- ================================================= --}}

                    <div class="col-span-3">


                        {{-- Date --}}
                        <div class="flex border-b border-gray-300">

                            <div
                                class="w-[190px]
                                    px-4 py-2
                                    text-left
                                    font-semibold
                                    text-gray-700">

                                កាលបរិច្ឆេទ
                                <span class="font-bold">
                                    Date:
                                </span>

                            </div>

                            <div
                                class="
                                    px-4 py-2
                                    text-center
                                    font-semibold
                                    border-l border-gray-300">

                                {{ $purchaseOrder->po_date ? $purchaseOrder->po_date->format('d-M-y') : '-' }}

                            </div>

                        </div>


                        {{-- PO Number --}}
                        <div class="flex border-b border-gray-300">

                            <div
                                class="w-[190px]
                                    px-4 py-2
                                    text-left
                                    font-semibold
                                    text-gray-700">

                                លេខបញ្ជាទិញ
                                <span class="font-bold">
                                    PO No.
                                </span>

                            </div>

                            <div
                                class="
                                    px-4 py-2
                                    text-center
                                    font-bold
                                    border-l border-gray-300">

                                {{ $purchaseOrder->po_no }}

                            </div>

                        </div>


                        {{-- PR Number --}}
                        <div class="flex">

                            <div
                                class="w-[190px]
                                    px-4 py-2
                                    text-left
                                    font-semibold
                                    text-gray-700">

                                លេខសំណើទិញ
                                <span class="font-bold">
                                    PR No.
                                </span>

                            </div>

                            <div
                                class="
                                    px-4 py-2
                                    text-center
                                    font-bold
                                    border-l border-gray-300">

                                {{ $purchaseOrder->pr_no ?? ' ' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Supplier --}}
            <div class="grid grid-cols-2
                    border-b border-gray-300">


                <div class="border-r
                        border-gray-300">

                    <div class="bg-green-100 px-4 py-2 text-left font-semibold">

                        SUPPLIER INFORMATION

                    </div>


                    <div class="px-4 py-3">

                        <div class="font-bold">

                            {{ $purchaseOrder->supplier_name }}

                            @if ($purchaseOrder->supplier_address)
                                - {{ $purchaseOrder->supplier_address }}
                            @endif

                            @if ($purchaseOrder->supplier_phone)
                                - Tel:
                                {{ $purchaseOrder->supplier_phone }}
                            @endif

                        </div>

                    </div>

                </div>



                <div>

                    <div class="bg-green-100 px-4 py-2 text-left font-semibold">

                        DELIVERED TO ADDRESS

                    </div>


                    <div class="px-4 py-3">

                        {{ $purchaseOrder->delivery_address }}

                    </div>

                </div>

            </div>


            {{-- Terms --}}
            <div class="grid grid-cols-2 border-b border-gray-300">


                <div class="border-r border-gray-300">

                    <div
                        class="bg-green-100
                            px-4 py-2
                            font-bold
                            text-sm">

                        TERM OF PAYMENT

                    </div>

                    <div class="p-4">

                        {{ $purchaseOrder->term_of_payment ?? '-' }}

                    </div>

                </div>



                <div>

                    <div
                        class="bg-green-100
                            px-4 py-2
                            font-bold
                            text-sm">

                        DELIVERY DATE

                    </div>

                    <div class="p-4">

                        {{ $purchaseOrder->delivery_date ? $purchaseOrder->delivery_date->format('d-M-Y') : '-' }}

                    </div>

                </div>

            </div>



            <div class="grid grid-cols-2
                    border-b border-gray-300">


                <div class="border-r
                        border-gray-300">

                    <div
                        class="bg-green-100
                            px-4 py-2
                            font-bold
                            text-sm">

                        MODE OF PAYMENT

                    </div>

                    <div class="p-4">

                        {{ $purchaseOrder->mode_of_payment ?? '-' }}

                    </div>

                </div>



                <div>

                    <div
                        class="bg-green-100
                            px-4 py-2
                            font-bold
                            text-sm">

                        TERM OF DELIVERY

                    </div>

                    <div class="p-4">

                        {{ $purchaseOrder->term_of_delivery ?? '-' }}

                    </div>

                </div>

            </div>



            {{-- Items --}}
            <div class="overflow-x-auto">

                <table class="w-full border-collapse">

                    <thead>

                        <tr class="bg-green-100">

                            <th
                                class="border
                                   border-gray-300
                                   px-3 py-3
                                   text-sm">
                                #
                            </th>

                            <th
                                class="border
                                   border-gray-300
                                   px-3 py-3
                                   text-left
                                   text-sm">
                                Description
                            </th>

                            <th
                                class="border
                                   border-gray-300
                                   px-3 py-3
                                   text-sm">
                                Required Date
                            </th>

                            <th
                                class="border
                                   border-gray-300
                                   px-3 py-3
                                   text-sm">
                                Unit
                            </th>

                            <th
                                class="border
                                   border-gray-300
                                   px-3 py-3
                                   text-sm">
                                Qty
                            </th>

                            <th
                                class="border
                                   border-gray-300
                                   px-3 py-3
                                   text-right
                                   text-sm">
                                Unit Price
                            </th>

                            <th
                                class="border
                                   border-gray-300
                                   px-3 py-3
                                   text-right
                                   text-sm">
                                Total
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($purchaseOrder->items as $item)
                            <tr>

                                <td
                                    class="border
                                       border-gray-300
                                       px-3 py-2
                                       text-center">

                                    {{ $loop->iteration }}

                                </td>


                                <td
                                    class="border
                                       border-gray-300
                                       px-3 py-2">

                                    {{ $item->description }}

                                </td>


                                <td
                                    class="border
                                       border-gray-300
                                       px-3 py-2
                                       text-center">

                                    {{ $item->required_date ? $item->required_date->format('d-M-Y') : '-' }}

                                </td>


                                <td
                                    class="border
                                       border-gray-300
                                       px-3 py-2
                                       text-center">

                                    {{ $item->unit }}

                                </td>


                                <td
                                    class="border
                                       border-gray-300
                                       px-3 py-2
                                       text-center">

                                    {{ number_format($item->quantity, 2) }}

                                </td>


                                <td
                                    class="border
                                       border-gray-300
                                       px-3 py-2
                                       text-right">

                                    {{ number_format($item->unit_price, 2) }}

                                </td>


                                <td
                                    class="border
                                       border-gray-300
                                       px-3 py-2
                                       text-right
                                       font-semibold">

                                    {{ number_format($item->total, 2) }}

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>



            {{-- Notes + Totals --}}
            <div class="grid grid-cols-3
                    border-t border-gray-300">


                <div class="col-span-2 p-4
                        border-r
                        border-gray-300">

                    <div class="font-bold mb-3">
                        Note:
                    </div>


                    @if ($purchaseOrder->notes)
                        <div class="text-sm
                                whitespace-pre-line">

                            {{ $purchaseOrder->notes }}

                        </div>
                    @else
                        <div
                            class="text-sm
                                text-gray-600
                                leading-7">

                            <p>
                                1. Please notify us immediately if you
                                are unable to deliver as specified.
                            </p>

                            <p>
                                2. Check will be used to settle this
                                order if the settled amount is equal
                                to or greater than USD150.
                            </p>

                            <p>
                                3. Please send all correspondence to
                                address above.
                            </p>

                        </div>
                    @endif

                </div>



                <div>

                    <div
                        class="flex
                            justify-between
                            px-4 py-3
                            border-b
                            border-gray-300">

                        <span>
                            SUB TOTAL
                        </span>

                        <strong>
                            {{ $purchaseOrder->currency }}
                            {{ number_format($purchaseOrder->subtotal, 2) }}
                        </strong>

                    </div>


                    <div
                        class="flex
                            justify-between
                            px-4 py-3
                            border-b
                            border-gray-300">

                        <span>
                            VAT
                            ({{ number_format($purchaseOrder->tax_percent, 2) }}%)
                        </span>

                        <strong>
                            {{ $purchaseOrder->currency }}
                            {{ number_format($purchaseOrder->taxAmount, 2) }}
                        </strong>

                    </div>


                    <div
                        class="flex
                            justify-between
                            px-4 py-3
                            border-b
                            border-gray-300">

                        <span>
                            Other Charges
                        </span>

                        <strong>
                            {{ $purchaseOrder->currency }}
                            {{ number_format($purchaseOrder->other_charges, 2) }}
                        </strong>

                    </div>


                    <div
                        class="flex
                            justify-between
                            px-4 py-4
                            font-bold
                            text-lg">

                        <span>
                            TOTAL
                        </span>

                        <span class="text-green-700">

                            {{ $purchaseOrder->currency }}

                            {{ number_format($purchaseOrder->grand_total, 2) }}

                        </span>

                    </div>

                </div>

            </div>



            {{-- Signatures --}}
            <div class="grid grid-cols-3
                    border-t
                    border-gray-300">


                {{-- Ordered --}}
                <div class="p-5
                        border-r
                        border-gray-300">

                    <div class="font-bold
                            text-sm mb-8">

                        Ordered by:

                    </div>


                    <div class="border-b h-20  mb-2">



                    </div>


                    <div class="text-sm">
                        Name:
                    </div>

                    <div class="text-sm mt-2">

                        Position:

                    </div>

                    <div class="text-sm mt-2">
                        Date:
                    </div>

                </div>



                {{-- Approved --}}
                <div class="p-5
                        border-r
                        border-gray-300">

                    <div class="font-bold
                            text-sm mb-8">

                        Approved by:

                    </div>


                    <div class="border-b h-20 mb-2">



                    </div>


                    <div class="text-sm">
                        Name:
                    </div>

                    <div class="text-sm mt-2">

                        Position:

                    </div>

                    <div class="text-sm mt-2">
                        Date:
                    </div>

                </div>



                {{-- Vendor --}}
                <div class="p-5">

                    <div class="font-bold
                            text-sm mb-2">

                        Vendor Acceptance

                    </div>


                    <p class="text-xs
                          text-gray-600
                          mb-5">

                        I hereby accept the terms and conditions
                        in the contract and purchase order.

                    </p>


                    <div class="text-sm">

                        Vendor Name:

                        <strong>
                            {{ $purchaseOrder->vendor_name }}
                        </strong>

                    </div>


                    <div class="text-sm mt-2">

                        Position:

                        <strong>
                            {{ $purchaseOrder->vendor_position }}
                        </strong>

                    </div>


                    <div class="text-sm mt-2">

                        Date:

                        <strong>

                            {{ $purchaseOrder->vendor_date ? $purchaseOrder->vendor_date->format('d-M-Y') : '' }}

                        </strong>

                    </div>


                    <div class="mt-12 border-b text-sm">
                        Signature
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
