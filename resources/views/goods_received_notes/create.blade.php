@extends('layout.app')

@section('content')
    <div class="mx-auto max-w-full">

        <form action="{{ route('goods-received-notes.store') }}" method="POST">

            @csrf

            <div class="mb-5">

                <div
                    class="relative overflow-hidden rounded-3xl
               border border-gray-100
               bg-white
               shadow-sm">

                    {{-- Decorative background --}}
                    <div
                        class="pointer-events-none absolute
                   -right-16 -top-20
                   h-56 w-56 rounded-full
                   bg-green-50">
                    </div>

                    <div
                        class="pointer-events-none absolute
                   -bottom-24 -left-16
                   h-48 w-48 rounded-full
                   bg-emerald-50/70">
                    </div>


                    <div
                        class="relative flex flex-col
                   gap-5 p-6
                   sm:p-7
                   lg:flex-row
                   lg:items-center
                   lg:justify-between">

                        {{-- ================================================= --}}
                        {{-- LEFT --}}
                        {{-- ================================================= --}}

                        <div class="flex items-start gap-4">

                            {{-- Document Icon --}}
                            <div
                                class="flex h-14 w-14 shrink-0
                           items-center justify-center
                           rounded-2xl
                           bg-green-100
                           text-green-700
                           shadow-sm">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.7">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 3v5h5" />

                                </svg>

                            </div>


                            {{-- Title Content --}}
                            <div>

                                {{-- Small Context --}}
                                <div
                                    class="mb-1 flex items-center
                               gap-2 text-xs
                               font-semibold
                               uppercase tracking-wider
                               text-green-600">

                                    <span>
                                        Finance Management
                                    </span>

                                    <span
                                        class="h-1 w-1 rounded-full
                                   bg-gray-300"></span>

                                    <span>
                                        Receiving
                                    </span>

                                </div>


                                {{-- Title --}}
                                <div class="flex flex-wrap
                               items-center gap-3">

                                    <h1
                                        class="text-2xl font-bold
                                   tracking-tight
                                   text-gray-800
                                   sm:text-3xl">
                                        Create Goods / Service Received Note
                                    </h1>


                                    {{-- FM Badge --}}
                                    <span
                                        class="inline-flex
                                   items-center
                                   rounded-full
                                   border border-green-200
                                   bg-green-50
                                   px-3 py-1
                                   text-xs font-bold
                                   text-green-700">

                                        FM-07

                                    </span>

                                </div>


                                {{-- Description --}}
                                <p
                                    class="mt-2 max-w-2xl
                               text-sm leading-6
                               text-gray-500">

                                    Record goods or services received from a supplier,
                                    including quantity, inspection, acceptance,
                                    and delivery information.

                                </p>


                                {{-- Status Information --}}
                                <div
                                    class="mt-4 flex flex-wrap
                               items-center gap-x-5 gap-y-2
                               text-xs text-gray-500">

                                    <span class="inline-flex
                                   items-center gap-1.5">

                                        <span
                                            class="flex h-5 w-5
                                       items-center
                                       justify-center
                                       rounded-md
                                       bg-green-100
                                       text-green-600">

                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />

                                            </svg>

                                        </span>

                                        Supplier Information

                                    </span>


                                    <span
                                        class="hidden h-1 w-1
                                   rounded-full
                                   bg-gray-300
                                   sm:block"></span>


                                    <span class="inline-flex
                                   items-center gap-1.5">

                                        <span
                                            class="flex h-5 w-5
                                       items-center
                                       justify-center
                                       rounded-md
                                       bg-green-100
                                       text-green-600">

                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 5a3 3 0 016 0v1H9V5z" />

                                            </svg>

                                        </span>

                                        Item Inspection

                                    </span>


                                    <span
                                        class="hidden h-1 w-1
                                   rounded-full
                                   bg-gray-300
                                   sm:block"></span>


                                    <span class="inline-flex
                                   items-center gap-1.5">

                                        <span
                                            class="flex h-5 w-5
                                       items-center
                                       justify-center
                                       rounded-md
                                       bg-green-100
                                       text-green-600">

                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />

                                            </svg>

                                        </span>

                                        Receiving Confirmation

                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- RIGHT --}}
                        {{-- ================================================= --}}

                        <div
                            class="hidden shrink-0
                       lg:flex lg:flex-col
                       lg:items-end lg:gap-2">

                            <span
                                class="text-xs font-medium
                           uppercase tracking-wider
                           text-gray-400">
                                Document Type
                            </span>


                            <div
                                class="flex items-center gap-2
                           rounded-2xl
                           border border-green-100
                           bg-green-50
                           px-4 py-3">

                                <div
                                    class="flex h-8 w-8
                               items-center justify-center
                               rounded-lg
                               bg-white
                               text-green-600
                               shadow-sm">

                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                    </svg>

                                </div>


                                <div>

                                    <div class="text-sm font-bold
                                   text-green-700">
                                        Goods Received Note
                                    </div>

                                    <div class="text-xs
                                   text-green-600/70">
                                        Form FM-07
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="space-y-5">

                <div
                    class="overflow-hidden rounded-3xl
                        border border-gray-100
                        bg-white shadow-sm">


                    <div
                        class="flex items-center justify-between
                            border-b border-gray-100
                            bg-gradient-to-r from-green-50/80 to-white
                            px-6 py-5 sm:px-8">

                        <div class="flex items-center gap-4">

                            {{-- Icon --}}
                            <div
                                class="flex h-11 w-11 shrink-0
                                    items-center justify-center
                                    rounded-xl
                                    bg-green-100
                                    text-green-700">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 3v5h5" />

                                </svg>

                            </div>


                            {{-- Title --}}
                            <div>

                                <div class="flex items-center gap-2">

                                    <h2
                                        class="text-lg font-bold
                               text-gray-800
                               sm:text-xl">
                                        GRN Information
                                    </h2>

                                    <span
                                        class="hidden rounded-full
                                            bg-green-100
                                            px-2.5 py-1
                                            text-[10px] font-bold
                                            uppercase tracking-wide
                                            text-green-700
                                            sm:inline-flex">
                                        Document Details
                                    </span>

                                </div>


                                <p class="mt-0.5 text-xs text-gray-500 sm:text-sm">
                                    Enter the receiving note and related purchase information.
                                </p>

                            </div>

                        </div>


                        {{-- Section number --}}
                        <span class="hidden text-xs font-bold
                             text-gray-400 sm:block">
                            01
                        </span>

                    </div>

                    <div class="p-6 sm:p-8">

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-5">
                            <div>

                                <label for="grn_no"
                                    class="mb-2.5 flex items-center
                                        gap-1.5 text-sm font-semibold
                                        text-gray-700">

                                    GRN No.

                                    <span
                                        class="rounded-full
                                            bg-gray-100
                                            px-2 py-0.5
                                            text-[10px]
                                            font-bold uppercase
                                            text-gray-500">
                                        Auto
                                    </span>

                                </label>


                                <div class="relative">

                                    {{-- Document icon --}}
                                    <div
                                        class="pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                        </svg>

                                    </div>


                                    <input id="grn_no" type="text" name="grn_no"
                                        value="{{ old('grn_no', $grnNo) }}" readonly
                                        class="w-full cursor-not-allowed
                                            rounded-2xl
                                            border border-gray-200
                                            bg-gray-100
                                            py-3.5 pl-12 pr-4
                                            text-sm font-bold
                                            text-gray-600
                                            shadow-inner
                                            focus:outline-none">

                                </div>


                                <p class="mt-2 text-xs text-gray-400">
                                    Automatically generated.
                                </p>

                            </div>

                            <div>

                                <label for="grn_date"
                                    class="mb-2.5 flex items-center
                                        gap-1.5 text-sm font-semibold
                                        text-gray-700">

                                    GRN Date

                                    <span class="text-red-500">*</span>

                                </label>


                                <div class="relative">

                                    {{-- Calendar icon --}}
                                    <div
                                        class="pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 4h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />

                                        </svg>

                                    </div>


                                    <input id="grn_date" type="date" name="grn_date"
                                        value="{{ old('grn_date', now()->format('Y-m-d')) }}" required
                                        class="w-full rounded-2xl
                                            border border-gray-200
                                            bg-gray-50
                                            py-3.5 pl-12 pr-4
                                            text-sm text-gray-800
                                            transition-all duration-200
                                            hover:border-gray-300
                                            focus:border-green-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-green-500/10">

                                </div>


                                <p class="mt-2 text-xs text-gray-400">
                                    Date the goods or services were received.
                                </p>

                            </div>


                            <div>

                                <label for="po_no"
                                    class="mb-2.5 block
                                        text-sm font-semibold
                                        text-gray-700">

                                    PO / Contract No.

                                    <span class="ml-1 text-xs font-normal
                               text-gray-400">
                                        Optional
                                    </span>

                                </label>


                                <div class="relative">

                                    {{-- Link/document icon --}}
                                    <div
                                        class="pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                        </svg>

                                    </div>


                                    <input id="po_no" type="text" name="po_no" value="{{ old('po_no') }}"
                                        placeholder="e.g. PO-2026-001"
                                        class="w-full rounded-2xl
                                            border border-gray-200
                                            bg-gray-50
                                            py-3.5 pl-12 pr-4
                                            text-sm text-gray-800
                                            placeholder:text-gray-400
                                            transition-all duration-200
                                            hover:border-gray-300
                                            focus:border-green-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-green-500/10">

                                </div>


                                <p class="mt-2 text-xs text-gray-400">
                                    Reference the related purchase order or contract.
                                </p>

                            </div>


                            <div>

                                <label for="vendor_invoice_no"
                                    class="mb-2.5 block
                                        text-sm font-semibold
                                        text-gray-700">

                                    Vendor Invoice No.

                                    <span class="ml-1 text-xs font-normal
                               text-gray-400">
                                        Optional
                                    </span>

                                </label>


                                <div class="relative">

                                    {{-- Invoice icon --}}
                                    <div
                                        class="pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 14h6m-6 4h6M9 6h6m2 15H7a2 2 0 01-2-2V5a2 2 0 012-2h8.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                        </svg>

                                    </div>


                                    <input id="vendor_invoice_no" type="text" name="vendor_invoice_no"
                                        value="{{ old('vendor_invoice_no') }}" placeholder="e.g. INV-00125"
                                        class="w-full rounded-2xl
                                            border border-gray-200
                                            bg-gray-50
                                            py-3.5 pl-12 pr-4
                                            text-sm text-gray-800
                                            placeholder:text-gray-400
                                            transition-all duration-200
                                            hover:border-gray-300
                                            focus:border-green-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-green-500/10">

                                </div>


                                <p class="mt-2 text-xs text-gray-400">
                                    Enter the supplier's invoice reference.
                                </p>

                            </div>


                            <div>

                                <label for="delivery_note_no"
                                    class="mb-2.5 block
                                        text-sm font-semibold
                                        text-gray-700">

                                    Delivery Note No.

                                    <span class="ml-1 text-xs font-normal
                               text-gray-400">
                                        Optional
                                    </span>

                                </label>


                                <div class="relative">

                                    {{-- Delivery icon --}}
                                    <div
                                        class="pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 7h11v10H3zM14 10h4l3 3v4h-7z" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 17a2 2 0 104 0m6 0a2 2 0 104 0" />

                                        </svg>

                                    </div>


                                    <input id="delivery_note_no" type="text" name="delivery_note_no"
                                        value="{{ old('delivery_note_no') }}" placeholder="e.g. DN-00025"
                                        class="w-full rounded-2xl
                                            border border-gray-200
                                            bg-gray-50
                                            py-3.5 pl-12 pr-4
                                            text-sm text-gray-800
                                            placeholder:text-gray-400
                                            transition-all duration-200
                                            hover:border-gray-300
                                            focus:border-green-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-green-500/10">

                                </div>


                                <p class="mt-2 text-xs text-gray-400">
                                    Reference the supplier's delivery note.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SUPPLIER --}}
                <div
                    class="overflow-hidden rounded-3xl
                    border border-gray-100
                    bg-white shadow-sm">

                    <div
                        class="flex items-center justify-between
                            border-b border-gray-100
                            bg-gradient-to-r from-green-50/80 to-white
                            px-6 py-5 sm:px-8">

                        <div class="flex items-center gap-4">

                            {{-- Icon --}}
                            <div
                                class="flex h-11 w-11 shrink-0
                                    items-center justify-center
                                    rounded-xl
                                    bg-green-100
                                    text-green-700">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19a6 6 0 00-12 0" />

                                    <circle cx="9" cy="7" r="4" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 19a6 6 0 00-4-5.65" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 3.35a4 4 0 010 7.3" />
                                </svg>

                            </div>


                            {{-- Title --}}
                            <div>

                                <div class="flex items-center gap-2">

                                    <h2
                                        class="text-lg font-bold
                                            text-gray-800
                                            sm:text-xl">
                                        Supplier Information
                                    </h2>


                                    <span
                                        class="hidden rounded-full
                                            bg-green-100
                                            px-2.5 py-1
                                            text-[10px] font-bold
                                            uppercase tracking-wide
                                            text-green-700
                                            sm:inline-flex">
                                        Required
                                    </span>

                                </div>


                                <p class="mt-0.5 text-xs text-gray-500 sm:text-sm">
                                    Enter the supplier details for this received order.
                                </p>

                            </div>

                        </div>


                        {{-- Section number --}}
                        <span class="hidden text-xs font-bold
                              text-gray-400 sm:block">
                            02
                        </span>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <div>

                                <label for="supplier_name"
                                    class="mb-2.5 flex items-center
                                        gap-1.5 text-sm font-semibold
                                        text-gray-700">

                                    Supplier Name

                                    <span class="text-red-500">*</span>

                                </label>


                                <div class="relative">

                                    {{-- Icon --}}
                                    <div
                                        class="pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 19a6 6 0 00-12 0" />

                                            <circle cx="9" cy="7" r="4" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 19a6 6 0 00-4-5.65" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 3.35a4 4 0 010 7.3" />
                                        </svg>

                                    </div>


                                    <input id="supplier_name" type="text" name="supplier_name"
                                        value="{{ old('supplier_name') }}" required placeholder="Enter supplier name"
                                        class="w-full rounded-2xl
                                            border border-gray-200
                                            bg-gray-50
                                            py-3.5 pl-12 pr-4
                                            text-sm text-gray-800
                                            placeholder:text-gray-400
                                            transition-all duration-200
                                            hover:border-gray-300
                                            focus:border-green-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-green-500/10">

                                </div>


                                <p class="mt-2 text-xs text-gray-400">
                                    Enter the registered or official supplier name.
                                </p>

                            </div>


                            {{-- ================================================= --}}
                            {{-- TELEPHONE --}}
                            {{-- ================================================= --}}

                            <div>

                                <label for="supplier_tel"
                                    class="mb-2.5 block
                                        text-sm font-semibold
                                        text-gray-700">

                                    Supplier Telephone

                                    <span class="ml-1 text-xs font-normal text-gray-400">
                                        Optional
                                    </span>

                                </label>


                                <div class="relative">

                                    {{-- Phone icon --}}
                                    <div
                                        class="pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center pl-4
                                            text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.02 3.06a1 1 0 01-.272 1.023L8.7 8.95a16 16 0 006.35 6.35l1.183-1.276a1 1 0 011.023-.272l3.06 1.02A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />

                                        </svg>

                                    </div>


                                    <input id="supplier_tel" type="text" name="supplier_tel"
                                        value="{{ old('supplier_tel') }}" placeholder="e.g. +855 12 345 678"
                                        class="w-full rounded-2xl
                                            border border-gray-200
                                            bg-gray-50
                                            py-3.5 pl-12 pr-4
                                            text-sm text-gray-800
                                            placeholder:text-gray-400
                                            transition-all duration-200
                                            hover:border-gray-300
                                            focus:border-green-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-green-500/10">

                                </div>


                                <p class="mt-2 text-xs text-gray-400">
                                    Supplier contact number for delivery or follow-up.
                                </p>

                            </div>


                            {{-- ================================================= --}}
                            {{-- ADDRESS --}}
                            {{-- ================================================= --}}

                            <div class="md:col-span-2">

                                <label for="supplier_address"
                                    class="mb-2.5 flex items-center gap-2
                                        text-sm font-semibold
                                        text-gray-700">

                                    Supplier Address

                                    <span class="text-xs font-normal text-gray-400">
                                        Optional
                                    </span>

                                </label>


                                <div class="relative">

                                    {{-- Location icon --}}
                                    <div
                                        class="pointer-events-none
                                            absolute left-4 top-4
                                            text-gray-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                                        </svg>

                                    </div>


                                    <textarea id="supplier_address" name="supplier_address" rows="3" placeholder="Enter supplier address..."
                                        class="w-full resize-none rounded-2xl
                                            border border-gray-200
                                            bg-gray-50
                                            py-3.5 pl-12 pr-4
                                            text-sm text-gray-800
                                            placeholder:text-gray-400
                                            transition-all duration-200
                                            hover:border-gray-300
                                            focus:border-green-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-green-500/10">{{ old('supplier_address') }}</textarea>

                                </div>


                                <div class="mt-2 flex items-center justify-between">

                                    <p class="text-xs text-gray-400">
                                        Include street, district, city, or other useful
                                        delivery information.
                                    </p>

                                    <span class="hidden text-xs text-gray-400 sm:block">
                                        Optional
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ITEMS --}}
                <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">


                    <div
                        class="flex flex-col gap-4
                            border-b border-gray-100
                            bg-gradient-to-r from-green-50/80 to-white
                            px-6 py-5
                            sm:flex-row sm:items-center
                            sm:justify-between
                            sm:px-8">

                        <div class="flex items-center gap-4">

                            {{-- Icon --}}
                            <div
                                class="flex h-11 w-11 shrink-0
                                    items-center justify-center
                                    rounded-xl
                                    bg-green-100
                                    text-green-700">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                    {{-- Package --}}
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 7.5L12 3l8.25 4.5M3.75 7.5L12 12m8.25-4.5L12 12m0 0v9" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 7.5V16.5L12 21l8.25-4.5V7.5" />

                                </svg>

                            </div>


                            {{-- Title --}}
                            <div>

                                <div class="flex items-center gap-2">

                                    <h2
                                        class="text-lg font-bold
                                            text-gray-800
                                            sm:text-xl">
                                        Goods / Service Items
                                    </h2>

                                    <span
                                        class="hidden rounded-full
                                            bg-green-100
                                            px-2.5 py-1
                                            text-[10px] font-bold
                                            uppercase tracking-wide
                                            text-green-700
                                            sm:inline-flex">
                                        Receiving Details
                                    </span>

                                </div>


                                <p class="mt-0.5 text-xs text-gray-500 sm:text-sm">
                                    Record quantities received and inspection results for each item.
                                </p>

                            </div>

                        </div>


                        {{-- Section number --}}
                        <span class="hidden text-xs font-bold
                                 text-gray-400 sm:block">
                            03
                        </span>

                    </div>


                    {{-- ===================================================== --}}
                    {{-- TABLE --}}
                    {{-- ===================================================== --}}

                    <div class="p-5 sm:p-6">

                        <div class="overflow-hidden rounded-2xl border border-gray-200">

                            <div class="overflow-x-auto">

                                <table id="itemsTable" class="min-w-[1250px] w-full border-collapse">

                                    {{-- ================================================= --}}
                                    {{-- TABLE HEADER --}}
                                    {{-- ================================================= --}}

                                    <thead>

                                        {{-- Main header --}}
                                        <tr
                                            class="bg-gray-50
                                                text-[11px]
                                                uppercase
                                                tracking-wider
                                                text-gray-600">

                                            <th rowspan="2"
                                                class="w-14 border-b border-r
                                                    border-gray-200
                                                    px-3 py-4
                                                    text-center
                                                    font-bold">
                                                #
                                            </th>


                                            <th rowspan="2"
                                                class="min-w-[250px]
                                                    border-b border-r
                                                    border-gray-200
                                                    px-4 py-4
                                                    text-left
                                                    font-bold">
                                                Description
                                            </th>


                                            <th rowspan="2"
                                                class="min-w-[230px]
                                                    border-b border-r
                                                    border-gray-200
                                                    px-4 py-4
                                                    text-left
                                                    font-bold">
                                                Inspection Criteria
                                            </th>

                                            {{-- Inspection group --}}
                                            <th colspan="5"
                                                class="border-b border-r
                                                    border-gray-200
                                                    bg-green-50
                                                    px-4 py-3
                                                    text-center
                                                    font-bold
                                                    text-green-700">
                                                Inspection & Acceptance QUANTITY
                                            </th>


                                            <th rowspan="2"
                                                class="w-28
                                                    border-b
                                                    border-gray-200
                                                    px-4 py-4
                                                    text-center
                                                    font-bold">
                                                Action
                                            </th>

                                        </tr>


                                        {{-- Status header --}}
                                        <tr
                                            class="bg-green-50/60
                                                text-[10px]
                                                uppercase
                                                tracking-wide">

                                            <th
                                                class="w-28
                                                    border-b border-r
                                                    border-gray-200
                                                    px-4 py-4
                                                    text-center
                                                    font-bold">
                                                Ordered
                                            </th>

                                            <th
                                                class="w-28
                                                    border-b border-r
                                                    border-gray-200
                                                    px-3 py-3
                                                    text-center
                                                    font-bold
                                                    text-gray-600">
                                                Received
                                            </th>


                                            <th
                                                class="w-28
                                                    border-b border-r
                                                    border-gray-200
                                                    px-3 py-3
                                                    text-center
                                                    font-bold
                                                    text-gray-600">
                                                Inspected
                                            </th>


                                            <th
                                                class="w-28
                                                    border-b border-r
                                                    border-gray-200
                                                    px-3 py-3
                                                    text-center
                                                    font-bold
                                                    text-green-700">
                                                Accepted
                                            </th>


                                            <th
                                                class="w-28
                                                    border-b border-r
                                                    border-gray-200
                                                    px-3 py-3
                                                    text-center
                                                    font-bold
                                                    text-red-600">
                                                Rejected
                                            </th>

                                        </tr>

                                    </thead>


                                    {{-- ================================================= --}}
                                    {{-- TABLE BODY --}}
                                    {{-- ================================================= --}}

                                    <tbody>

                                        <tr
                                            class="item-row
                                                bg-white
                                                transition-colors
                                                hover:bg-green-50/30">

                                            <td
                                                class="border-b border-r
                                                    border-gray-200
                                                    p-3 text-center
                                                    align-center">

                                                <span
                                                    class="item-number
                                                        inline-flex h-8 w-8
                                                        items-center
                                                        justify-center
                                                        rounded-lg
                                                        bg-gray-100
                                                        text-xs font-bold
                                                        text-gray-600">
                                                    1
                                                </span>

                                            </td>

                                            <td
                                                class="border-b border-r
                                                        border-gray-200
                                                        p-3 align-top">

                                                <textarea name="items[0][description]" rows="2" required placeholder="Describe the goods or service..."
                                                    class="w-full resize-none
                                                        rounded-xl
                                                        border border-gray-200
                                                        bg-gray-50
                                                        px-3.5 py-3
                                                        text-sm
                                                        text-gray-800
                                                        placeholder:text-gray-400
                                                        transition-all
                                                        focus:border-green-500
                                                        focus:bg-white
                                                        focus:ring-4
                                                        focus:ring-green-500/10"></textarea>

                                            </td>

                                            <td
                                                class="border-b border-r
                                                    border-gray-200
                                                    p-3 align-top">

                                                <textarea name="items[0][inspection_criteria]" rows="2" placeholder="Quality, specification, condition..."
                                                    class="w-full resize-none
                                                            rounded-xl
                                                            border border-gray-200
                                                            bg-gray-50
                                                            px-3.5 py-3
                                                            text-sm
                                                            text-gray-800
                                                            placeholder:text-gray-400
                                                            transition-all
                                                            focus:border-green-500
                                                            focus:bg-white
                                                            focus:ring-4
                                                            focus:ring-green-500/10"></textarea>

                                            </td>

                                            <td
                                                class="border-b border-r
                                                        border-gray-200
                                                        p-3 align-center">

                                                <input type="number" name="items[0][ordered_quantity]" min="0"
                                                    step="0.01" placeholder="0"
                                                    class="w-full rounded-xl
                                                            border border-gray-200
                                                            bg-gray-50
                                                            px-3 py-3
                                                            text-center text-sm
                                                            font-semibold
                                                            text-gray-800
                                                            transition-all
                                                            focus:border-green-500
                                                            focus:bg-white
                                                            focus:ring-4
                                                            focus:ring-green-500/10">

                                            </td>

                                            <td
                                                class="border-b border-r
                                                    border-gray-200
                                                    p-3
                                                    text-center
                                                    align-middle">

                                                <label
                                                    class="group flex cursor-pointer
                                                        flex-col items-center
                                                        justify-center gap-2">

                                                    <input type="checkbox" name="items[0][received]" value="1"
                                                        class="h-5 w-5 cursor-pointer
                                                            rounded-md
                                                            border-gray-300
                                                            text-green-600
                                                            focus:ring-green-500">

                                                    <span
                                                        class="text-[10px]
                                                            font-medium
                                                            text-gray-400
                                                            group-hover:text-green-600">
                                                        Received
                                                    </span>

                                                </label>

                                            </td>

                                            <td
                                                class="border-b border-r
                                                    border-gray-200
                                                    p-3
                                                    text-center
                                                    align-middle">

                                                <label
                                                    class="group flex cursor-pointer
                                                        flex-col items-center
                                                        justify-center gap-2">

                                                    <input type="checkbox" name="items[0][inspected]" value="1"
                                                        class="h-5 w-5 cursor-pointer
                                                            rounded-md
                                                            border-gray-300
                                                            text-green-600
                                                            focus:ring-green-500">

                                                    <span
                                                        class="text-[10px]
                                                            font-medium
                                                            text-gray-400
                                                            group-hover:text-green-600">
                                                        Inspected
                                                    </span>

                                                </label>

                                            </td>


                                            <td
                                                class="border-b border-r
                                                    border-gray-200
                                                    bg-green-50/20
                                                    p-3
                                                    text-center
                                                    align-middle">

                                                <label
                                                    class="group flex cursor-pointer
                                                        flex-col items-center
                                                        justify-center gap-2">

                                                    <input type="radio" name="items[0][result]" value="accepted"
                                                        class="h-5 w-5 cursor-pointer
                                                            border-gray-300
                                                            text-green-600
                                                            focus:ring-green-500">

                                                    <span
                                                        class="inline-flex
                                                            items-center gap-1
                                                            text-[10px]
                                                            font-semibold
                                                            text-green-600">

                                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor" stroke-width="2">

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5 13l4 4L19 7" />

                                                        </svg>

                                                        Accepted

                                                    </span>

                                                </label>

                                            </td>


                                            <td
                                                class="border-b border-r
                                                    border-gray-200
                                                    bg-red-50/20
                                                    p-3
                                                    text-center
                                                    align-middle">

                                                <label
                                                    class="group flex cursor-pointer
                                                        flex-col items-center
                                                        justify-center gap-2">

                                                    <input type="radio" name="items[0][result]" value="rejected"
                                                        class="h-5 w-5 cursor-pointer
                                                            border-gray-300
                                                            text-red-600
                                                            focus:ring-red-500">

                                                    <span
                                                        class="inline-flex
                                                            items-center gap-1
                                                            text-[10px]
                                                            font-semibold
                                                            text-red-600">

                                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor" stroke-width="2">

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />

                                                        </svg>

                                                        Rejected

                                                    </span>

                                                </label>

                                            </td>


                                            <td
                                                class="border-b
                                                    border-gray-200
                                                    p-3
                                                    text-center
                                                    align-middle">

                                                <button type="button" onclick="removeItem(this)" title="Remove item"
                                                    class="inline-flex h-9 w-9
                                                        items-center
                                                        justify-center
                                                        rounded-xl
                                                        border border-red-100
                                                        bg-red-50
                                                        text-red-600
                                                        transition-all
                                                        hover:-translate-y-0.5
                                                        hover:border-red-200
                                                        hover:bg-red-100
                                                        hover:shadow-sm">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.8">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7" />

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10 11v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14" />

                                                    </svg>

                                                </button>

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>


                        <div
                            class="mt-4 flex flex-col gap-4
                                sm:flex-row
                                sm:items-center
                                sm:justify-between">

                            {{-- Help text --}}
                            <div class="flex items-start gap-2
                                    text-xs text-gray-500">

                                <svg class="mt-0.5 h-4 w-4
                                    shrink-0 text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z" />

                                </svg>

                                <span>
                                    Mark each item according to the actual receiving
                                    and inspection result.
                                </span>

                            </div>


                            {{-- Add item --}}
                            <button type="button" onclick="addItem()"
                                class="group inline-flex
                                    items-center justify-center
                                    gap-2
                                    rounded-xl
                                    bg-green-600
                                    px-5 py-3
                                    text-sm font-semibold
                                    text-white
                                    shadow-sm
                                    transition-all duration-200
                                    hover:-translate-y-0.5
                                    hover:bg-green-700
                                    hover:shadow-md
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-green-500
                                    focus:ring-offset-2">

                                <span
                                    class="flex h-5 w-5
                                        items-center justify-center
                                        rounded-md
                                        bg-white/15">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4
                                            transition-transform
                                            group-hover:rotate-90"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                                    </svg>

                                </span>

                                Add Item

                            </button>

                        </div>

                    </div>

                </div>


                {{-- FURTHER COMMENTS --}}
                <div
                    class="overflow-hidden rounded-3xl
                        border border-gray-100
                        bg-white shadow-sm">

                    <div
                        class="flex items-center justify-between
                            border-b border-gray-100
                            bg-gradient-to-r from-green-50/80 to-white
                            px-6 py-5 sm:px-8">

                        <div class="flex items-center gap-4">

                            {{-- Icon --}}
                            <div
                                class="flex h-11 w-11 shrink-0
                                    items-center justify-center
                                    rounded-xl
                                    bg-green-100
                                    text-green-700">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11.5a7.5 7.5 0 01-7.5 7.5c-1.4 0-2.7-.38-3.82-1.04L4 19l1.04-3.68A7.5 7.5 0 014 11.5 7.5 7.5 0 0111.5 4h.5A7.5 7.5 0 0119 11.5z" />

                                </svg>

                            </div>


                            {{-- Title --}}
                            <div>

                                <div class="flex items-center gap-2">

                                    <h2
                                        class="text-lg font-bold
                               text-gray-800
                               sm:text-xl">
                                        Further Comments
                                    </h2>

                                    <span
                                        class="hidden rounded-full
                               bg-gray-100
                               px-2.5 py-1
                               text-[10px] font-bold
                               uppercase tracking-wide
                               text-gray-500
                               sm:inline-flex">
                                        Optional
                                    </span>

                                </div>


                                <p class="mt-0.5 text-xs text-gray-500 sm:text-sm">
                                    Add any additional information, observations, or remarks
                                    about the received goods or services.
                                </p>

                            </div>

                        </div>


                        {{-- Section number --}}
                        <span class="hidden text-xs font-bold
                                text-gray-400 sm:block">
                            04
                        </span>

                    </div>


                    <div class="p-6 sm:p-8">

                        <label for="comments"
                            class="mb-2.5 flex items-center
                                justify-between
                                text-sm font-semibold
                                text-gray-700">

                            <span>
                                Comments / Remarks
                            </span>

                            <span class="text-xs font-normal
                                    text-gray-400">
                                Optional
                            </span>

                        </label>


                        <div class="relative">

                            {{-- Comment icon --}}
                            <div
                                class="pointer-events-none
                                    absolute left-4 top-4
                                    text-gray-400">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11.5a7.5 7.5 0 01-7.5 7.5c-1.4 0-2.7-.38-3.82-1.04L4 19l1.04-3.68A7.5 7.5 0 014 11.5 7.5 7.5 0 0111.5 4h.5A7.5 7.5 0 0119 11.5z" />

                                </svg>

                            </div>


                            <textarea id="comments" name="comments" rows="5" maxlength="2000"
                                placeholder="Enter any additional comments, observations, delivery issues, quality concerns, or other relevant information..."
                                class="w-full resize-y
                                    rounded-2xl
                                    border border-gray-200
                                    bg-gray-50
                                    py-4 pl-12 pr-4
                                    text-sm
                                    leading-6
                                    text-gray-800
                                    placeholder:text-gray-400
                                    transition-all duration-200
                                    hover:border-gray-300
                                    focus:border-green-500
                                    focus:bg-white
                                    focus:ring-4
                                    focus:ring-green-500/10">{{ old('comments') }}</textarea>

                        </div>


                        {{-- Helper / character information --}}
                        <div
                            class="mt-2.5 flex flex-col
                                gap-1
                                sm:flex-row
                                sm:items-center
                                sm:justify-between">

                            <div
                                class="flex items-center gap-1.5
                                    text-xs text-gray-400">

                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z" />

                                </svg>

                                Include any information that may help explain the
                                receiving or inspection result.

                            </div>


                            <span id="commentsCounter" class="text-xs text-gray-400">
                                0 / 2000
                            </span>

                        </div>

                    </div>

                </div>


                {{-- ACTION --}}
                <div
                    class="flex flex-col gap-3
                        border-t border-gray-100
                        bg-gray-50/70
                        px-6 py-5
                        sm:flex-row
                        sm:items-center
                        sm:justify-end
                        sm:px-8">

                    {{-- ===================================================== --}}
                    {{-- CANCEL --}}
                    {{-- ===================================================== --}}

                    <a href="{{ route('goods-received-notes.index') }}"
                        class="inline-flex items-center
                                justify-center gap-2
                                rounded-xl
                                border border-gray-200
                                bg-white
                                px-6 py-3
                                text-sm font-semibold
                                text-gray-700
                                shadow-sm
                                transition-all duration-200
                                hover:-translate-y-0.5
                                hover:border-orange-200
                                hover:bg-orange-50
                                hover:text-orange-700
                                hover:shadow-md
                                focus:outline-none
                                focus:ring-2
                                focus:ring-orange-400
                                focus:ring-offset-2">

                        {{-- X Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />

                        </svg>

                        Cancel

                    </a>


                    {{-- ===================================================== --}}
                    {{-- SAVE --}}
                    {{-- ===================================================== --}}

                    <button type="submit"
                        class="inline-flex items-center
                            justify-center gap-2
                            rounded-xl
                            bg-green-600
                            px-7 py-3
                            text-sm font-semibold
                            text-white
                            shadow-sm
                            transition-all duration-200
                            hover:-translate-y-0.5
                            hover:bg-green-700
                            hover:shadow-md
                            active:translate-y-0
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            focus:ring-offset-2">

                        {{-- Save Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3h11l3 3v15H5V3z" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 3v6h8V3M8 21v-6h8v6" />

                        </svg>

                        Save

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        let itemIndex = 1;


        // =========================================================
        // ADD ITEM
        // =========================================================

        function addItem() {

            const tbody = document.querySelector('#itemsTable tbody');

            const index = itemIndex;


            const row = document.createElement('tr');

            row.className =
                'item-row bg-white transition-colors hover:bg-green-50/30';


            row.innerHTML = `

                {{-- ================================================= --}}
                {{-- NUMBER --}}
                {{-- ================================================= --}}

                <td
                    class="border-b border-r border-gray-200
                        p-3 text-center align-center"
                >

                    <span
                        class="item-number
                            inline-flex h-8 w-8
                            items-center justify-center
                            rounded-lg
                            bg-gray-100
                            text-xs font-bold
                            text-gray-600"
                    >
                        ${index + 1}
                    </span>

                </td>


                {{-- ================================================= --}}
                {{-- DESCRIPTION --}}
                {{-- ================================================= --}}

                <td
                    class="border-b border-r
                        border-gray-200
                        p-3 align-top"
                >

                    <textarea
                        name="items[${index}][description]"
                        rows="2"
                        required
                        placeholder="Describe the goods or service..."
                        class="w-full resize-none
                            rounded-xl
                            border border-gray-200
                            bg-gray-50
                            px-3.5 py-3
                            text-sm
                            text-gray-800
                            placeholder:text-gray-400
                            transition-all
                            focus:border-green-500
                            focus:bg-white
                            focus:ring-4
                            focus:ring-green-500/10"
                    ></textarea>

                </td>


                {{-- ================================================= --}}
                {{-- INSPECTION CRITERIA --}}
                {{-- ================================================= --}}

                <td
                    class="border-b border-r
                        border-gray-200
                        p-3 align-top"
                >

                    <textarea
                        name="items[${index}][inspection_criteria]"
                        rows="2"
                        placeholder="Quality, specification, condition..."
                        class="w-full resize-none
                            rounded-xl
                            border border-gray-200
                            bg-gray-50
                            px-3.5 py-3
                            text-sm
                            text-gray-800
                            placeholder:text-gray-400
                            transition-all
                            focus:border-green-500
                            focus:bg-white
                            focus:ring-4
                            focus:ring-green-500/10"
                    ></textarea>

                </td>


                {{-- ================================================= --}}
                {{-- ORDERED QUANTITY --}}
                {{-- ================================================= --}}

                <td
                    class="border-b border-r
                        border-gray-200
                        p-3 align-center"
                >

                    <input
                        type="number"
                        name="items[${index}][ordered_quantity]"
                        min="0"
                        step="0.01"
                        placeholder="0"
                        class="w-full rounded-xl
                            border border-gray-200
                            bg-gray-50
                            px-3 py-3
                            text-center
                            text-sm font-semibold
                            text-gray-800
                            transition-all
                            focus:border-green-500
                            focus:bg-white
                            focus:ring-4
                            focus:ring-green-500/10"
                    >

                </td>


                {{-- ================================================= --}}
                {{-- RECEIVED --}}
                {{-- ================================================= --}}

                <td
                    class="border-b border-r
                        border-gray-200
                        p-3 text-center
                        align-middle"
                >

                    <label
                        class="group flex cursor-pointer
                            flex-col items-center
                            justify-center gap-2"
                    >

                        <input
                            type="checkbox"
                            name="items[${index}][received]"
                            value="1"
                            class="h-5 w-5 cursor-pointer
                                rounded-md
                                border-gray-300
                                text-green-600
                                focus:ring-green-500"
                        >

                        <span
                            class="text-[10px]
                                font-medium
                                text-gray-400
                                group-hover:text-green-600"
                        >
                            Received
                        </span>

                    </label>

                </td>


                {{-- ================================================= --}}
                {{-- INSPECTED --}}
                {{-- ================================================= --}}

                <td
                    class="border-b border-r
                        border-gray-200
                        p-3 text-center
                        align-middle"
                >

                    <label
                        class="group flex cursor-pointer
                            flex-col items-center
                            justify-center gap-2"
                    >

                        <input
                            type="checkbox"
                            name="items[${index}][inspected]"
                            value="1"
                            class="h-5 w-5 cursor-pointer
                                rounded-md
                                border-gray-300
                                text-green-600
                                focus:ring-green-500"
                        >

                        <span
                            class="text-[10px]
                                font-medium
                                text-gray-400
                                group-hover:text-green-600"
                        >
                            Inspected
                        </span>

                    </label>

                </td>


                {{-- ================================================= --}}
                {{-- ACCEPTED --}}
                {{-- ================================================= --}}

                <td
                    class="border-b border-r
                        border-gray-200
                        bg-green-50/20
                        p-3 text-center
                        align-middle"
                >

                    <label
                        class="group flex cursor-pointer
                            flex-col items-center
                            justify-center gap-2"
                    >

                        <input
                            type="radio"
                            name="items[${index}][result]"
                            value="accepted"
                            class="h-5 w-5 cursor-pointer
                                border-gray-300
                                text-green-600
                                focus:ring-green-500"
                        >

                        <span
                            class="inline-flex
                                items-center gap-1
                                text-[10px]
                                font-semibold
                                text-green-600"
                        >

                            <svg
                                class="h-3.5 w-3.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />

                            </svg>

                            Accepted

                        </span>

                    </label>

                </td>


                {{-- ================================================= --}}
                {{-- REJECTED --}}
                {{-- ================================================= --}}

                <td
                    class="border-b border-r
                        border-gray-200
                        bg-red-50/20
                        p-3 text-center
                        align-middle"
                >

                    <label
                        class="group flex cursor-pointer
                            flex-col items-center
                            justify-center gap-2"
                    >

                        <input
                            type="radio"
                            name="items[${index}][result]"
                            value="rejected"
                            class="h-5 w-5 cursor-pointer
                                border-gray-300
                                text-red-600
                                focus:ring-red-500"
                        >

                        <span
                            class="inline-flex
                                items-center gap-1
                                text-[10px]
                                font-semibold
                                text-red-600"
                        >

                            <svg
                                class="h-3.5 w-3.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"
                                />

                            </svg>

                            Rejected

                        </span>

                    </label>

                </td>


                {{-- ================================================= --}}
                {{-- ACTION --}}
                {{-- ================================================= --}}

                <td
                    class="border-b
                        border-gray-200
                        p-3 text-center
                        align-middle"
                >

                    <button
                        type="button"
                        onclick="removeItem(this)"
                        title="Remove item"
                        class="inline-flex h-9 w-9
                            items-center justify-center
                            rounded-xl
                            border border-red-100
                            bg-red-50
                            text-red-600
                            transition-all
                            hover:-translate-y-0.5
                            hover:border-red-200
                            hover:bg-red-100
                            hover:shadow-sm"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10 11v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"
                            />

                        </svg>

                    </button>

                </td>

            `;


            tbody.appendChild(row);


            itemIndex++;


            updateItemNumbers();

        }


        // =========================================================
        // REMOVE ITEM
        // =========================================================

        function removeItem(button) {

            const tbody =
                document.querySelector('#itemsTable tbody');


            if (tbody.rows.length <= 1) {

                alert('At least one item is required.');

                return;
            }


            button.closest('tr').remove();


            updateItemNumbers();

        }


        // =========================================================
        // UPDATE DISPLAY NUMBERS
        // =========================================================

        function updateItemNumbers() {

            const rows =
                document.querySelectorAll(
                    '#itemsTable tbody tr'
                );


            rows.forEach((row, index) => {

                const number =
                    row.querySelector('.item-number');


                if (number) {

                    number.textContent = index + 1;

                }

            });

        }

        document.addEventListener('DOMContentLoaded', function() {

            const comments = document.getElementById('comments');
            const counter = document.getElementById('commentsCounter');

            if (!comments || !counter) {
                return;
            }

            function updateCommentsCounter() {

                const length = comments.value.length;

                counter.textContent = `${length} / 2000`;

                if (length >= 1900) {
                    counter.classList.remove(
                        'text-gray-400',
                        'text-green-600'
                    );

                    counter.classList.add('text-orange-600');

                } else if (length > 0) {

                    counter.classList.remove(
                        'text-gray-400',
                        'text-orange-600'
                    );

                    counter.classList.add('text-green-600');

                } else {

                    counter.classList.remove(
                        'text-green-600',
                        'text-orange-600'
                    );

                    counter.classList.add('text-gray-400');
                }
            }

            comments.addEventListener(
                'input',
                updateCommentsCounter
            );

            updateCommentsCounter();
        });
    </script>
@endsection
