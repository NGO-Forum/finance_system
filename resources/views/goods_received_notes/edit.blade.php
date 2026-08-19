@extends('layout.app')

@section('content')

    <div class="mx-auto max-w-full">

        {{-- ========================================================= --}}
        {{-- FORM --}}
        {{-- ========================================================= --}}

        <form action="{{ route('goods-received-notes.update', $goodsReceivedNote) }}" method="POST" id="grnForm">

            @csrf
            @method('PUT')


            {{-- ========================================================= --}}
            {{-- ERROR MESSAGE --}}
            {{-- ========================================================= --}}

            @if ($errors->any())

                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-5">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v4m0 4h.01M10.29 3.86l-7.1 12.28A2 2 0 004.92 19h14.16a2 2 0 001.73-2.86l-7.1-12.28a2 2 0 00-3.42 0z" />
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-semibold text-red-800">
                                Please correct the following errors:
                            </h3>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- PAGE HEADER --}}
            {{-- ========================================================= --}}

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
                        class="relative flex flex-col gap-5 p-6
                           sm:p-7
                           lg:flex-row
                           lg:items-center
                           lg:justify-between">

                        {{-- LEFT --}}

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


                            {{-- Title --}}

                            <div>

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


                                <div class="flex flex-wrap items-center gap-3">

                                    <h1
                                        class="text-2xl font-bold
                                           tracking-tight
                                           text-gray-800
                                           sm:text-3xl">
                                        Update Goods / Service Received Note
                                    </h1>


                                    <span
                                        class="inline-flex items-center
                                           rounded-full
                                           border border-green-200
                                           bg-green-50
                                           px-3 py-1
                                           text-xs font-bold
                                           text-green-700">
                                        FM-07
                                    </span>

                                </div>


                                <p
                                    class="mt-2 max-w-2xl
                                       text-sm leading-6
                                       text-gray-500">
                                    Update goods or services received from a supplier,
                                    including quantity, inspection, acceptance,
                                    and delivery information.
                                </p>


                                <div
                                    class="mt-4 flex flex-wrap
                                       items-center gap-x-5 gap-y-2
                                       text-xs text-gray-500">

                                    <span class="inline-flex items-center gap-1.5">

                                        <span
                                            class="flex h-5 w-5 items-center
                                               justify-center rounded-md
                                               bg-green-100 text-green-600">

                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />

                                            </svg>

                                        </span>

                                        Supplier Information

                                    </span>


                                    <span
                                        class="hidden h-1 w-1 rounded-full
                                           bg-gray-300 sm:block"></span>


                                    <span class="inline-flex items-center gap-1.5">

                                        <span
                                            class="flex h-5 w-5 items-center
                                               justify-center rounded-md
                                               bg-green-100 text-green-600">

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
                                        class="hidden h-1 w-1 rounded-full
                                           bg-gray-300 sm:block"></span>


                                    <span class="inline-flex items-center gap-1.5">

                                        <span
                                            class="flex h-5 w-5 items-center
                                               justify-center rounded-md
                                               bg-green-100 text-green-600">

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


                        {{-- RIGHT --}}

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
                                    class="flex h-8 w-8 items-center
                                       justify-center rounded-lg
                                       bg-white text-green-600
                                       shadow-sm">

                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                    </svg>

                                </div>


                                <div>

                                    <div class="text-sm font-bold text-green-700">
                                        Goods Received Note
                                    </div>

                                    <div class="text-xs text-green-600/70">
                                        Form FM-07
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="space-y-5">


                {{-- ========================================================= --}}
                {{-- GRN INFORMATION --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-3xl
                       border border-gray-100
                       bg-white shadow-sm">

                    <div
                        class="flex items-center justify-between
                           border-b border-gray-100
                           bg-gradient-to-r
                           from-green-50/80 to-white
                           px-6 py-5 sm:px-8">

                        <div class="flex items-center gap-4">

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


                            <div>

                                <div class="flex items-center gap-2">

                                    <h2 class="text-lg font-bold text-gray-800 sm:text-xl">
                                        GRN Information
                                    </h2>

                                    <span
                                        class="hidden rounded-full
                                           bg-green-100
                                           px-2.5 py-1
                                           text-[10px] font-bold
                                           uppercase tracking-wide
                                           text-green-700 sm:inline-flex">
                                        Document Details
                                    </span>

                                </div>

                                <p class="mt-0.5 text-xs text-gray-500 sm:text-sm">
                                    Enter the receiving note and related purchase information.
                                </p>

                            </div>

                        </div>


                        <span class="hidden text-xs font-bold
                               text-gray-400 sm:block">
                            01
                        </span>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div
                            class="grid grid-cols-1 gap-6
                               md:grid-cols-2
                               lg:grid-cols-5">

                            {{-- GRN NO --}}

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


                                <input id="grn_no" type="text" name="grn_no"
                                    value="{{ old('grn_no', $goodsReceivedNote->grn_no) }}" readonly
                                    class="w-full cursor-not-allowed
                                       rounded-2xl
                                       border border-gray-200
                                       bg-gray-100
                                       px-4 py-3.5
                                       text-sm font-bold
                                       text-gray-600
                                       shadow-inner
                                       focus:outline-none">

                                <p class="mt-2 text-xs text-gray-400">
                                    Automatically generated.
                                </p>

                            </div>


                            {{-- GRN DATE --}}

                            <div>

                                <label for="grn_date"
                                    class="mb-2.5 flex items-center
                                       gap-1.5 text-sm font-semibold
                                       text-gray-700">

                                    GRN Date

                                    <span class="text-red-500">*</span>

                                </label>


                                <input id="grn_date" type="date" name="grn_date"
                                    value="{{ old('grn_date', $goodsReceivedNote->grn_date?->format('Y-m-d')) }}" required
                                    class="w-full rounded-2xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3.5
                                       text-sm text-gray-800
                                       transition-all
                                       hover:border-gray-300
                                       focus:border-green-500
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-green-500/10">

                                <p class="mt-2 text-xs text-gray-400">
                                    Date the goods or services were received.
                                </p>

                            </div>


                            {{-- PO --}}

                            <div>

                                <label for="po_no"
                                    class="mb-2.5 block
                                       text-sm font-semibold
                                       text-gray-700">

                                    PO / Contract No.

                                    <span class="ml-1 text-xs font-normal text-gray-400">
                                        Optional
                                    </span>

                                </label>


                                <input id="po_no" type="text" name="po_no"
                                    value="{{ old('po_no', $goodsReceivedNote->po_no) }}" placeholder="e.g. PO-2026-001"
                                    class="w-full rounded-2xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3.5
                                       text-sm text-gray-800
                                       placeholder:text-gray-400
                                       focus:border-green-500
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-green-500/10">

                                <p class="mt-2 text-xs text-gray-400">
                                    Related purchase order or contract.
                                </p>

                            </div>


                            {{-- INVOICE --}}

                            <div>

                                <label for="vendor_invoice_no"
                                    class="mb-2.5 block
                                       text-sm font-semibold
                                       text-gray-700">

                                    Vendor Invoice No.

                                    <span class="ml-1 text-xs font-normal text-gray-400">
                                        Optional
                                    </span>

                                </label>


                                <input id="vendor_invoice_no" type="text" name="vendor_invoice_no"
                                    value="{{ old('vendor_invoice_no', $goodsReceivedNote->vendor_invoice_no) }}"
                                    placeholder="e.g. INV-00125"
                                    class="w-full rounded-2xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3.5
                                       text-sm text-gray-800
                                       placeholder:text-gray-400
                                       focus:border-green-500
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-green-500/10">

                                <p class="mt-2 text-xs text-gray-400">
                                    Supplier invoice reference.
                                </p>

                            </div>


                            {{-- DELIVERY NOTE --}}

                            <div>

                                <label for="delivery_note_no"
                                    class="mb-2.5 block
                                       text-sm font-semibold
                                       text-gray-700">

                                    Delivery Note No.

                                    <span class="ml-1 text-xs font-normal text-gray-400">
                                        Optional
                                    </span>

                                </label>


                                <input id="delivery_note_no" type="text" name="delivery_note_no"
                                    value="{{ old('delivery_note_no', $goodsReceivedNote->delivery_note_no) }}"
                                    placeholder="e.g. DN-00025"
                                    class="w-full rounded-2xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3.5
                                       text-sm text-gray-800
                                       placeholder:text-gray-400
                                       focus:border-green-500
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-green-500/10">

                                <p class="mt-2 text-xs text-gray-400">
                                    Supplier delivery note reference.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- SUPPLIER --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-3xl
                       border border-gray-100
                       bg-white shadow-sm">

                    <div
                        class="flex items-center justify-between
                           border-b border-gray-100
                           bg-gradient-to-r
                           from-green-50/80 to-white
                           px-6 py-5 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0
                                   items-center justify-center
                                   rounded-xl
                                   bg-green-100
                                   text-green-700">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                    <circle cx="9" cy="7" r="4" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19a6 6 0 00-12 0" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 19a6 6 0 00-4-5.65" />

                                </svg>

                            </div>


                            <div>

                                <div class="flex items-center gap-2">

                                    <h2 class="text-lg font-bold text-gray-800 sm:text-xl">
                                        Supplier Information
                                    </h2>

                                    <span
                                        class="hidden rounded-full
                                           bg-green-100
                                           px-2.5 py-1
                                           text-[10px] font-bold
                                           uppercase tracking-wide
                                           text-green-700 sm:inline-flex">
                                        Required
                                    </span>

                                </div>

                                <p class="mt-0.5 text-xs text-gray-500 sm:text-sm">
                                    Enter the supplier details for this received order.
                                </p>

                            </div>

                        </div>


                        <span class="hidden text-xs font-bold
                               text-gray-400 sm:block">
                            02
                        </span>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            {{-- SUPPLIER NAME --}}

                            <div>

                                <label for="supplier_name"
                                    class="mb-2.5 flex items-center
                                       gap-1.5 text-sm font-semibold
                                       text-gray-700">

                                    Supplier Name

                                    <span class="text-red-500">*</span>

                                </label>


                                <input id="supplier_name" type="text" name="supplier_name"
                                    value="{{ old('supplier_name', $goodsReceivedNote->supplier_name) }}" required
                                    placeholder="Enter supplier name"
                                    class="w-full rounded-2xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3.5
                                       text-sm text-gray-800
                                       placeholder:text-gray-400
                                       focus:border-green-500
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-green-500/10">

                                <p class="mt-2 text-xs text-gray-400">
                                    Registered or official supplier name.
                                </p>

                            </div>


                            {{-- TELEPHONE --}}

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


                                <input id="supplier_tel" type="text" name="supplier_tel"
                                    value="{{ old('supplier_tel', $goodsReceivedNote->supplier_tel) }}"
                                    placeholder="e.g. +855 12 345 678"
                                    class="w-full rounded-2xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3.5
                                       text-sm text-gray-800
                                       placeholder:text-gray-400
                                       focus:border-green-500
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-green-500/10">

                                <p class="mt-2 text-xs text-gray-400">
                                    Supplier contact number.
                                </p>

                            </div>


                            {{-- ADDRESS --}}

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


                                <textarea id="supplier_address" name="supplier_address" rows="3" placeholder="Enter supplier address..."
                                    class="w-full resize-none
                                       rounded-2xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3.5
                                       text-sm text-gray-800
                                       placeholder:text-gray-400
                                       focus:border-green-500
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-green-500/10">{{ old('supplier_address', $goodsReceivedNote->supplier_address) }}</textarea>

                                <p class="mt-2 text-xs text-gray-400">
                                    Include street, district, city, or other delivery information.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- ITEMS --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-3xl
                       border border-gray-100
                       bg-white shadow-sm">

                    <div
                        class="flex flex-col gap-4
                           border-b border-gray-100
                           bg-gradient-to-r
                           from-green-50/80 to-white
                           px-6 py-5
                           sm:flex-row
                           sm:items-center
                           sm:justify-between
                           sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0
                                   items-center justify-center
                                   rounded-xl
                                   bg-green-100
                                   text-green-700">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 7.5L12 3l8.25 4.5M3.75 7.5L12 12m8.25-4.5L12 12m0 0v9" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 7.5V16.5L12 21l8.25-4.5V7.5" />

                                </svg>

                            </div>


                            <div>

                                <div class="flex items-center gap-2">

                                    <h2 class="text-lg font-bold text-gray-800 sm:text-xl">
                                        Goods / Service Items
                                    </h2>

                                    <span
                                        class="hidden rounded-full
                                           bg-green-100
                                           px-2.5 py-1
                                           text-[10px] font-bold
                                           uppercase tracking-wide
                                           text-green-700 sm:inline-flex">
                                        Receiving Details
                                    </span>

                                </div>

                                <p class="mt-0.5 text-xs text-gray-500 sm:text-sm">
                                    Record quantities received and inspection results for each item.
                                </p>

                            </div>

                        </div>


                        <span class="hidden text-xs font-bold
                               text-gray-400 sm:block">
                            03
                        </span>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div class="overflow-hidden rounded-2xl
                               border border-gray-200">

                            <div class="overflow-x-auto">

                                <table id="itemsTable" class="min-w-[1250px] w-full border-collapse">

                                    <thead>

                                        <tr
                                            class="bg-gray-50
                                               text-[11px]
                                               uppercase
                                               tracking-wider
                                               text-gray-600">

                                            <th rowspan="2"
                                                class="w-14 border-b border-r
                                                   border-gray-200
                                                   px-3 py-4 text-center
                                                   font-bold">
                                                #
                                            </th>


                                            <th rowspan="2"
                                                class="min-w-[250px]
                                                   border-b border-r
                                                   border-gray-200
                                                   px-4 py-4
                                                   text-left font-bold">
                                                Description
                                            </th>


                                            <th rowspan="2"
                                                class="min-w-[230px]
                                                   border-b border-r
                                                   border-gray-200
                                                   px-4 py-4
                                                   text-left font-bold">
                                                Inspection Criteria
                                            </th>


                                            <th colspan="5"
                                                class="border-b border-r
                                                   border-gray-200
                                                   bg-green-50
                                                   px-4 py-3
                                                   text-center
                                                   font-bold
                                                   text-green-700">
                                                Inspection & Acceptance Quantity
                                            </th>


                                            <th rowspan="2"
                                                class="w-28 border-b
                                                   border-gray-200
                                                   px-4 py-4
                                                   text-center font-bold">
                                                Action
                                            </th>

                                        </tr>


                                        <tr
                                            class="bg-green-50/60
                                               text-[10px]
                                               uppercase
                                               tracking-wide">

                                            <th
                                                class="w-28 border-b border-r
                                                   border-gray-200
                                                   px-4 py-4
                                                   text-center font-bold">
                                                Ordered
                                            </th>

                                            <th
                                                class="w-28 border-b border-r
                                                   border-gray-200
                                                   px-3 py-3
                                                   text-center font-bold">
                                                Received
                                            </th>

                                            <th
                                                class="w-28 border-b border-r
                                                   border-gray-200
                                                   px-3 py-3
                                                   text-center font-bold">
                                                Inspected
                                            </th>

                                            <th
                                                class="w-28 border-b border-r
                                                   border-gray-200
                                                   px-3 py-3
                                                   text-center font-bold
                                                   text-green-700">
                                                Accepted
                                            </th>

                                            <th
                                                class="w-28 border-b border-r
                                                   border-gray-200
                                                   px-3 py-3
                                                   text-center font-bold
                                                   text-red-600">
                                                Rejected
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @foreach ($goodsReceivedNote->items as $index => $item)
                                            @php

                                                $result = old(
                                                    "items.$index.result",
                                                    $item->accepted ? 'accepted' : ($item->rejected ? 'rejected' : ''),
                                                );

                                            @endphp


                                            <tr
                                                class="item-row bg-white
                                                   transition-colors
                                                   hover:bg-green-50/30">

                                                {{-- NUMBER --}}

                                                <td
                                                    class="border-b border-r
                                                       border-gray-200
                                                       p-3 text-center
                                                       align-middle">

                                                    <span
                                                        class="item-number
                                                           inline-flex h-8 w-8
                                                           items-center
                                                           justify-center
                                                           rounded-lg
                                                           bg-gray-100
                                                           text-xs font-bold
                                                           text-gray-600">
                                                        {{ $index + 1 }}
                                                    </span>

                                                </td>


                                                {{-- DESCRIPTION --}}

                                                <td
                                                    class="border-b border-r
                                                       border-gray-200
                                                       p-3 align-top">

                                                    <textarea name="items[{{ $index }}][description]" rows="2" required
                                                        placeholder="Describe the goods or service..."
                                                        class="w-full resize-none
                                                           rounded-xl
                                                           border border-gray-200
                                                           bg-gray-50
                                                           px-3.5 py-3
                                                           text-sm text-gray-800
                                                           placeholder:text-gray-400
                                                           focus:border-green-500
                                                           focus:bg-white
                                                           focus:ring-4
                                                           focus:ring-green-500/10">{{ old("items.$index.description", $item->description) }}</textarea>

                                                </td>


                                                {{-- INSPECTION CRITERIA --}}

                                                <td
                                                    class="border-b border-r
                                                       border-gray-200
                                                       p-3 align-top">

                                                    <textarea name="items[{{ $index }}][inspection_criteria]" rows="2"
                                                        placeholder="Quality, specification, condition..."
                                                        class="w-full resize-none
                                                           rounded-xl
                                                           border border-gray-200
                                                           bg-gray-50
                                                           px-3.5 py-3
                                                           text-sm text-gray-800
                                                           placeholder:text-gray-400
                                                           focus:border-green-500
                                                           focus:bg-white
                                                           focus:ring-4
                                                           focus:ring-green-500/10">{{ old("items.$index.inspection_criteria", $item->inspection_criteria) }}</textarea>

                                                </td>


                                                {{-- ORDERED --}}

                                                <td
                                                    class="border-b border-r
                                                       border-gray-200
                                                       p-3">

                                                    <input type="number"
                                                        name="items[{{ $index }}][ordered_quantity]"
                                                        min="0" step="0.01"
                                                        value="{{ old("items.$index.ordered_quantity", $item->ordered_quantity) }}"
                                                        placeholder="0"
                                                        class="w-full rounded-xl
                                                           border border-gray-200
                                                           bg-gray-50
                                                           px-3 py-3
                                                           text-center
                                                           text-sm font-semibold
                                                           text-gray-800
                                                           focus:border-green-500
                                                           focus:bg-white
                                                           focus:ring-4
                                                           focus:ring-green-500/10">

                                                </td>


                                                {{-- RECEIVED --}}

                                                <td
                                                    class="border-b border-r
                                                       border-gray-200
                                                       p-3 text-center
                                                       align-middle">

                                                    <label
                                                        class="group flex cursor-pointer
                                                           flex-col items-center
                                                           justify-center gap-2">

                                                        <input type="checkbox"
                                                            name="items[{{ $index }}][received]" value="1"
                                                            {{ old("items.$index.received", $item->received) ? 'checked' : '' }}
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


                                                {{-- INSPECTED --}}

                                                <td
                                                    class="border-b border-r
                                                       border-gray-200
                                                       p-3 text-center
                                                       align-middle">

                                                    <label
                                                        class="group flex cursor-pointer
                                                           flex-col items-center
                                                           justify-center gap-2">

                                                        <input type="checkbox"
                                                            name="items[{{ $index }}][inspected]" value="1"
                                                            {{ old("items.$index.inspected", $item->inspected) ? 'checked' : '' }}
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


                                                {{-- ACCEPTED --}}

                                                <td
                                                    class="border-b border-r
                                                       border-gray-200
                                                       bg-green-50/20
                                                       p-3 text-center
                                                       align-middle">

                                                    <label
                                                        class="group flex cursor-pointer
                                                           flex-col items-center
                                                           justify-center gap-2">

                                                        <input type="radio" name="items[{{ $index }}][result]"
                                                            value="accepted" {{ $result === 'accepted' ? 'checked' : '' }}
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


                                                {{-- REJECTED --}}

                                                <td
                                                    class="border-b border-r
                                                       border-gray-200
                                                       bg-red-50/20
                                                       p-3 text-center
                                                       align-middle">

                                                    <label
                                                        class="group flex cursor-pointer
                                                           flex-col items-center
                                                           justify-center gap-2">

                                                        <input type="radio" name="items[{{ $index }}][result]"
                                                            value="rejected" {{ $result === 'rejected' ? 'checked' : '' }}
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


                                                {{-- REMOVE --}}

                                                <td
                                                    class="border-b
                                                       border-gray-200
                                                       p-3 text-center
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
                                                           hover:bg-red-100">

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
                                        @endforeach


                                        {{-- FALLBACK IF NO ITEMS --}}

                                        @if ($goodsReceivedNote->items->count() === 0)
                                            <tr class="item-row bg-white">

                                                <td class="p-4 text-center" colspan="9">
                                                    No items found.
                                                </td>

                                            </tr>
                                        @endif

                                    </tbody>

                                </table>

                            </div>

                        </div>


                        {{-- BOTTOM --}}

                        <div
                            class="mt-4 flex flex-col gap-4
                               sm:flex-row
                               sm:items-center
                               sm:justify-between">

                            <div class="flex items-start gap-2
                                   text-xs text-gray-500">

                                <svg class="mt-0.5 h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z" />

                                </svg>

                                <span>
                                    Mark each item according to the actual receiving
                                    and inspection result.
                                </span>

                            </div>


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
                                   transition-all
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
                                       rounded-md bg-white/15">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 transition-transform
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


                {{-- ========================================================= --}}
                {{-- FURTHER COMMENTS --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-3xl
                       border border-gray-100
                       bg-white shadow-sm">

                    <div
                        class="flex items-center justify-between
                           border-b border-gray-100
                           bg-gradient-to-r
                           from-green-50/80 to-white
                           px-6 py-5 sm:px-8">

                        <div class="flex items-center gap-4">

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


                            <div>

                                <div class="flex items-center gap-2">

                                    <h2
                                        class="text-lg font-bold
                                           text-gray-800 sm:text-xl">
                                        Further Comments
                                    </h2>

                                    <span
                                        class="hidden rounded-full
                                           bg-gray-100
                                           px-2.5 py-1
                                           text-[10px] font-bold
                                           uppercase tracking-wide
                                           text-gray-500 sm:inline-flex">
                                        Optional
                                    </span>

                                </div>

                                <p class="mt-0.5 text-xs text-gray-500 sm:text-sm">
                                    Add any additional information, observations,
                                    or remarks about the received goods or services.
                                </p>

                            </div>

                        </div>


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

                            <span class="text-xs font-normal text-gray-400">
                                Optional
                            </span>

                        </label>


                        <textarea id="comments" name="comments" rows="5" maxlength="2000"
                            placeholder="Enter any additional comments, observations, delivery issues, quality concerns, or other relevant information..."
                            class="w-full resize-y
                               rounded-2xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-4
                               text-sm
                               leading-6
                               text-gray-800
                               placeholder:text-gray-400
                               focus:border-green-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-green-500/10">{{ old('comments', $goodsReceivedNote->comments) }}</textarea>


                        <div
                            class="mt-2.5 flex flex-col gap-1
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


                {{-- ========================================================= --}}
                {{-- ACTION --}}
                {{-- ========================================================= --}}

                <div
                    class="flex flex-col gap-3
                       border-t border-gray-100
                       bg-gray-50/70
                       px-6 py-5
                       sm:flex-row
                       sm:items-center
                       sm:justify-end
                       sm:px-8">

                    {{-- CANCEL --}}

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
                           transition-all
                           hover:-translate-y-0.5
                           hover:border-orange-200
                           hover:bg-orange-50
                           hover:text-orange-700
                           hover:shadow-md
                           focus:outline-none
                           focus:ring-2
                           focus:ring-orange-400
                           focus:ring-offset-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />

                        </svg>

                        Cancel

                    </a>


                    {{-- UPDATE --}}

                    <button type="submit"
                        class="inline-flex items-center
                           justify-center gap-2
                           rounded-xl
                           bg-green-600
                           px-7 py-3
                           text-sm font-semibold
                           text-white
                           shadow-sm
                           transition-all
                           hover:-translate-y-0.5
                           hover:bg-green-700
                           hover:shadow-md
                           active:translate-y-0
                           focus:outline-none
                           focus:ring-2
                           focus:ring-green-500
                           focus:ring-offset-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3h11l3 3v15H5V3z" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 3v6h8V3M8 21v-6h8v6" />

                        </svg>

                        Update

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        /*
        |--------------------------------------------------------------------------
        | Existing Item Count
        |--------------------------------------------------------------------------
        */

        let itemIndex = {{ $goodsReceivedNote->items->count() }};


        /*
        |--------------------------------------------------------------------------
        | ADD ITEM
        |--------------------------------------------------------------------------
        */

        function addItem() {

            const tbody =
                document.querySelector('#itemsTable tbody');

            const index = itemIndex;


            const row =
                document.createElement('tr');


            row.className =
                'item-row bg-white transition-colors hover:bg-green-50/30';


            row.innerHTML = `

            <td class="border-b border-r border-gray-200 p-3 text-center align-middle">

                <span
                    class="item-number inline-flex h-8 w-8
                           items-center justify-center
                           rounded-lg bg-gray-100
                           text-xs font-bold text-gray-600"
                >
                    ${index + 1}
                </span>

            </td>


            <td class="border-b border-r border-gray-200 p-3 align-top">

                <textarea
                    name="items[${index}][description]"
                    rows="2"
                    required
                    placeholder="Describe the goods or service..."
                    class="w-full resize-none rounded-xl
                           border border-gray-200
                           bg-gray-50
                           px-3.5 py-3
                           text-sm text-gray-800
                           placeholder:text-gray-400
                           focus:border-green-500
                           focus:bg-white
                           focus:ring-4
                           focus:ring-green-500/10"
                ></textarea>

            </td>


            <td class="border-b border-r border-gray-200 p-3 align-top">

                <textarea
                    name="items[${index}][inspection_criteria]"
                    rows="2"
                    placeholder="Quality, specification, condition..."
                    class="w-full resize-none rounded-xl
                           border border-gray-200
                           bg-gray-50
                           px-3.5 py-3
                           text-sm text-gray-800
                           placeholder:text-gray-400
                           focus:border-green-500
                           focus:bg-white
                           focus:ring-4
                           focus:ring-green-500/10"
                ></textarea>

            </td>


            <td class="border-b border-r border-gray-200 p-3">

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
                           focus:border-green-500
                           focus:bg-white
                           focus:ring-4
                           focus:ring-green-500/10"
                >

            </td>


            {{-- RECEIVED --}}

            <td class="border-b border-r border-gray-200 p-3 text-center">

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
                               rounded-md border-gray-300
                               text-green-600
                               focus:ring-green-500"
                    >

                    <span
                        class="text-[10px] font-medium
                               text-gray-400
                               group-hover:text-green-600"
                    >
                        Received
                    </span>

                </label>

            </td>


            {{-- INSPECTED --}}

            <td class="border-b border-r border-gray-200 p-3 text-center">

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
                               rounded-md border-gray-300
                               text-green-600
                               focus:ring-green-500"
                    >

                    <span
                        class="text-[10px] font-medium
                               text-gray-400
                               group-hover:text-green-600"
                    >
                        Inspected
                    </span>

                </label>

            </td>


            {{-- ACCEPTED --}}

            <td
                class="border-b border-r border-gray-200
                       bg-green-50/20
                       p-3 text-center"
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
                        class="inline-flex items-center gap-1
                               text-[10px] font-semibold
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


            {{-- REJECTED --}}

            <td
                class="border-b border-r border-gray-200
                       bg-red-50/20
                       p-3 text-center"
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
                        class="inline-flex items-center gap-1
                               text-[10px] font-semibold
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


            {{-- ACTION --}}

            <td
                class="border-b border-gray-200
                       p-3 text-center"
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
                           hover:bg-red-100"
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


        /*
        |--------------------------------------------------------------------------
        | REMOVE ITEM
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | UPDATE NUMBERS
        |--------------------------------------------------------------------------
        */

        function updateItemNumbers() {

            const rows =
                document.querySelectorAll(
                    '#itemsTable tbody tr.item-row'
                );


            rows.forEach((row, index) => {

                const number =
                    row.querySelector('.item-number');


                if (number) {

                    number.textContent =
                        index + 1;

                }

            });

        }


        /*
        |--------------------------------------------------------------------------
        | COMMENTS COUNTER
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'DOMContentLoaded',
            function() {

                const comments =
                    document.getElementById('comments');

                const counter =
                    document.getElementById('commentsCounter');


                if (!comments || !counter) {

                    return;

                }


                function updateCommentsCounter() {

                    const length =
                        comments.value.length;


                    counter.textContent =
                        `${length} / 2000`;


                    counter.classList.remove(
                        'text-gray-400',
                        'text-green-600',
                        'text-orange-600'
                    );


                    if (length >= 1900) {

                        counter.classList.add(
                            'text-orange-600'
                        );

                    } else if (length > 0) {

                        counter.classList.add(
                            'text-green-600'
                        );

                    } else {

                        counter.classList.add(
                            'text-gray-400'
                        );

                    }

                }


                comments.addEventListener(
                    'input',
                    updateCommentsCounter
                );


                updateCommentsCounter();

            }
        );
    </script>

@endsection
