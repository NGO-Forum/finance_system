@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">


        {{-- PAGE HEADER --}}

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
                    lg:flex-row
                    lg:items-center
                    lg:justify-between
                    gap-5
                ">


                {{-- TITLE --}}


                <div class="flex items-center gap-4">

                    {{-- Icon --}}
                    <div
                        class="
                            w-12
                            h-12
                            flex
                            items-center
                            justify-center
                            rounded-xl
                            bg-green-100
                            text-green-700
                            shrink-0
                        ">

                        <i class="fa-solid fa-file-invoice-dollar text-xl"></i>

                    </div>


                    {{-- Text --}}
                    <div>

                        <div class="flex items-center gap-2">

                            <h1
                                class="
                                    text-2xl
                                    font-bold
                                    text-green-800
                                    tracking-tight
                                ">
                                Invoices
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
                                    text-xs
                                    font-bold
                                    border
                                    border-green-100
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
                            Create, manage, and track invoices and invoice items.
                        </p>

                    </div>

                </div>




                {{-- ACTIONS --}}


                <div
                    class="
                        flex
                        flex-col
                        sm:flex-row
                        items-stretch
                        sm:items-center
                        gap-6
                    ">


                    {{-- Total / Information --}}
                    <a href="{{ route('invoices.template') }}" target="_blank"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        PDF Template
                    </a>


                    {{-- Create Button --}}
                    <a href="{{ route('invoices.create') }}"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-5
                            py-2.5
                            bg-green-700
                            hover:bg-green-800
                            active:bg-green-900
                            text-white
                            rounded-lg
                            font-semibold
                            text-sm
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
                    flex
                    items-center
                    justify-center
                    rounded-md
                    bg-white/20
                ">

                            <i class="fa-solid fa-plus text-xs"></i>

                        </span>

                        Create Invoice

                    </a>

                </div>

            </div>

        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="
                    mb-5
                    px-4
                    py-3
                    rounded-lg
                    bg-green-50
                    border
                    border-green-200
                    text-green-700
                ">

                {{ session('success') }}

            </div>
        @endif


        {{-- SEARCH / FILTER --}}
        <div
            class="
                bg-white
                border
                border-gray-200
                rounded-2xl
                shadow-sm
                mb-5
                overflow-hidden
            ">


            {{-- FILTER HEADER --}}
            <div
                class="
                    flex
                    items-center
                    justify-between
                    px-5
                    py-4
                    border-b
                    border-gray-100
                    bg-gray-50/70
                ">

                <div class="flex items-center gap-3">

                    {{-- Icon --}}
                    <div
                        class="
                            w-9
                            h-9
                            rounded-lg
                            bg-green-100
                            text-green-700
                            flex
                            items-center
                            justify-center
                        ">

                        <i class="fa-solid fa-filter text-sm"></i>

                    </div>


                    <div>

                        <h2 class="text-sm font-bold text-gray-800">
                            Search & Filter
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Find invoices by number, customer, or date.
                        </p>

                    </div>

                </div>


                {{-- Active Filter Indicator --}}
                @if (request()->filled('invoice_no') || request()->filled('customer') || request()->filled('invoice_date'))
                    <span
                        class="
                                hidden
                                sm:inline-flex
                                items-center
                                gap-1.5
                                px-3
                                py-1.5
                                rounded-full
                                bg-green-50
                                text-green-700
                                border
                                border-green-100
                                text-xs
                                font-semibold
                            ">

                        <span
                            class="
                                w-1.5
                                h-1.5
                                rounded-full
                                bg-green-600
                            "></span>

                        Filters Applied

                    </span>
                @endif

            </div>




            {{-- FORM --}}


            <form method="GET" action="{{ route('invoices.index') }}" class="p-5">

                <div
                    class="
                        grid
                        grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-4
                        gap-4
                    ">


                    {{-- ================================================= --}}
                    {{-- INVOICE NUMBER --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="invoice_no"
                            class="
                                block
                                text-xs
                                font-bold
                                uppercase
                                tracking-wide
                                text-gray-600
                                mb-1.5
                            ">
                            Invoice No.
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

                                <i class="fa-solid fa-file-invoice text-sm"></i>

                            </div>


                            <input type="text" id="invoice_no" name="invoice_no" value="{{ request('invoice_no') }}"
                                placeholder="e.g. INV-0001" autocomplete="off"
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

                    </div>



                    {{-- ================================================= --}}
                    {{-- CUSTOMER --}}
                    {{-- ================================================= --}}

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

                                <i class="fa-solid fa-user text-sm"></i>

                            </div>


                            <input type="text" id="customer" name="customer" value="{{ request('customer') }}"
                                placeholder="Customer name" autocomplete="off"
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

                    </div>



                    {{-- ================================================= --}}
                    {{-- DATE --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="invoice_date"
                            class="
                                block
                                text-xs
                                font-bold
                                uppercase
                                tracking-wide
                                text-gray-600
                                mb-1.5
                            ">
                            Invoice Date
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

                                <i class="fa-solid fa-calendar-days text-sm"></i>

                            </div>


                            <input type="date" id="invoice_date" name="invoice_date"
                                value="{{ request('invoice_date') }}"
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

                    </div>



                    {{-- ================================================= --}}
                    {{-- ACTIONS --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            flex
                            items-end
                            gap-2
                        ">

                        {{-- Search --}}
                        <button type="submit"
                            class="
                                    flex-1
                                    h-11
                                    inline-flex
                                    items-center
                                    justify-center
                                    gap-2
                                    px-4
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
                                ">

                            <i class="fa-solid fa-magnifying-glass text-xs"></i>

                            Search

                        </button>


                        {{-- Reset --}}
                        <a href="{{ route('invoices.index') }}"
                            class="
                                    h-11
                                    inline-flex
                                    items-center
                                    justify-center
                                    gap-2
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
                                "
                            title="Clear filters">

                            <i class="fa-solid fa-rotate-left text-xs"></i>

                            <span class="hidden sm:inline">
                                Reset
                            </span>

                        </a>

                    </div>

                </div>

            </form>

        </div>


        {{-- INVOICE TABLE --}}
        <div
            class="
                bg-white
                border
                border-gray-200
                rounded-2xl
                shadow-sm
                overflow-hidden
            ">


            <div
                class="
                    px-5
                    py-4
                    border-b
                    border-gray-200
                    bg-green-600
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-3
                ">

                <div class="flex items-center gap-3">

                    <div
                        class="
                            w-9
                            h-9
                            rounded-lg
                            bg-white
                            text-green-700
                            flex
                            items-center
                            justify-center
                        ">

                        <i class="fa-solid fa-file-invoice-dollar text-sm"></i>

                    </div>


                    <div>

                        <h2 class="text-sm font-bold text-white">
                            Invoice List
                        </h2>

                        <p class="text-xs text-gray-200 mt-0.5">
                            View and manage your invoices.
                        </p>

                    </div>

                </div>


                {{-- Invoice Count --}}
                <div
                    class="
                            inline-flex
                            items-center
                            gap-2
                            self-start
                            sm:self-auto
                            px-3
                            py-1.5
                            rounded-full
                            bg-white
                            border
                            border-gray-200
                            text-xs
                            font-semibold
                            text-gray-600
                        ">

                    <i class="fa-solid fa-layer-group text-green-600"></i>

                    <span>
                        {{ $invoices->total() }}
                        {{ Str::plural('Invoice', $invoices->total()) }}
                    </span>

                </div>

            </div>




            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead>

                        <tr class="bg-green-50 border-b border-green-100">

                            <th
                                class="
                                    px-5
                                    py-3.5
                                    text-left
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-gray-600
                                    whitespace-nowrap
                                ">
                                #
                            </th>


                            <th
                                class="
                                    px-5
                                    py-3.5
                                    text-left
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-gray-600
                                    whitespace-nowrap
                                ">
                                Invoice no.
                            </th>


                            <th
                                class="
                                    px-5
                                    py-3.5
                                    text-left
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-gray-600
                                    whitespace-nowrap
                                ">
                                Date
                            </th>


                            <th
                                class="
                                    px-5
                                    py-3.5
                                    text-left
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-gray-600
                                    whitespace-nowrap
                                ">
                                Customer
                            </th>


                            <th
                                class="
                                    px-5
                                    py-3.5
                                    text-center
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-gray-600
                                    whitespace-nowrap
                                ">
                                ENTITY​/CUSTOMER
                            </th>


                            <th
                                class="
                                    px-5
                                    py-3.5
                                    text-right
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-gray-600
                                    whitespace-nowrap
                                ">
                                Grand Total
                            </th>


                            <th
                                class="
                                    px-5
                                    py-3.5
                                    text-center
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-gray-600
                                    whitespace-nowrap
                                ">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($invoices as $invoice)
                            <tr
                                class="
                                    group
                                    hover:bg-green-50/40
                                    transition-colors
                                    duration-150
                                ">

                                <td class="px-5 py-2">

                                    <span
                                        class="
                                            text-xs
                                            font-semibold
                                            text-gray-400
                                        ">
                                        {{ $invoices->firstItem() + $loop->index }}
                                    </span>

                                </td>


                                <td class="px-5 py-2">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="
                                                w-9
                                                h-9
                                                rounded-lg
                                                bg-green-50
                                                text-green-700
                                                flex
                                                items-center
                                                justify-center
                                                shrink-0
                                                group-hover:bg-green-100
                                                transition
                                            ">

                                            <i class="fa-solid fa-file-invoice text-sm"></i>

                                        </div>


                                        <div>

                                            <a href="{{ route('invoices.show', $invoice) }}"
                                                class="
                                                    text-sm
                                                    font-bold
                                                    text-gray-800
                                                    hover:text-green-700
                                                    transition
                                                ">

                                                {{ $invoice->invoice_no }}

                                            </a>


                                            <div
                                                class="
                                                    text-[11px]
                                                    text-gray-400
                                                    mt-0.5
                                                ">

                                                FM02-14

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td class="px-5 py-2 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="
                                                w-7
                                                h-7
                                                rounded-md
                                                bg-gray-100
                                                text-gray-500
                                                flex
                                                items-center
                                                justify-center
                                            ">

                                            <i class="fa-regular fa-calendar text-xs"></i>

                                        </div>


                                        <span class="text-sm text-gray-700">

                                            {{ $invoice->invoice_date?->format('d-M-Y') ?? '-' }}

                                        </span>

                                    </div>

                                </td>

                                <td class="px-5 py-2">

                                    @if ($invoice->customer)
                                        <div class="flex items-center gap-2">

                                            <div
                                                class="
                                                    w-7
                                                    h-7
                                                    rounded-full
                                                    bg-gray-100
                                                    text-gray-500
                                                    flex
                                                    items-center
                                                    justify-center
                                                    shrink-0
                                                ">

                                                <i class="fa-solid fa-user text-xs"></i>

                                            </div>


                                            <span
                                                class="
                                                    text-sm
                                                    font-medium
                                                    text-gray-700
                                                    max-w-[220px]
                                                    truncate
                                                "
                                                title="{{ $invoice->customer }}">

                                                {{ $invoice->customer }}

                                            </span>

                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">
                                            —
                                        </span>
                                    @endif

                                </td>


                                <td class="px-5 py-2 text-center">

                                    <span
                                        class="
                                            inline-flex
                                            items-center
                                            justify-center
                                            min-w-[34px]
                                            h-7
                                            px-2.5
                                            rounded-full
                                            bg-blue-50
                                            text-blue-700
                                            border
                                            border-blue-100
                                            text-xs
                                            font-bold
                                        ">

                                        {{ $invoice->company ?? ' ' }}

                                    </span>

                                </td>


                                <td class="px-5 py-2 text-right whitespace-nowrap">

                                    <div
                                        class="
                                            text-sm
                                            font-bold
                                            text-gray-800
                                        ">

                                        ${{ number_format($invoice->grand_total, 2) }} USD

                                    </div>


                                </td>


                                <td class="px-5 py-2">

                                    <div class="flex items-center justify-center">

                                        {{-- Three Dot Button --}}
                                        <div class="relative">

                                            <button type="button"
                                                class="
                                                    invoice-action-menu
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    w-9
                                                    h-9
                                                    rounded-lg
                                                    text-gray-500
                                                    hover:text-gray-700
                                                    hover:bg-gray-100
                                                    focus:outline-none
                                                    focus:ring-2
                                                    focus:ring-green-100
                                                    transition
                                                "
                                                data-menu="invoice-menu-{{ $invoice->id }}" title="Actions">

                                                <i class="fa-solid fa-ellipsis-vertical"></i>

                                            </button>


                                            {{-- ================================================= --}}
                                            {{-- DROPDOWN --}}
                                            {{-- ================================================= --}}

                                            <div id="invoice-menu-{{ $invoice->id }}"
                                                class="
                                                    invoice-action-dropdown
                                                    hidden
                                                    absolute
                                                    -right-3
                                                    top-full
                                                    -mt-3
                                                    w-14
                                                    bg-white
                                                    border
                                                    border-gray-200
                                                    rounded-xl
                                                    shadow-xl
                                                    overflow-hidden
                                                    z-50
                                                ">

                                                {{-- VIEW --}}
                                                <a href="{{ route('invoices.show', $invoice) }}"
                                                    class="
                                                        flex
                                                        items-center
                                                        gap-3
                                                        px-3
                                                        py-2
                                                        text-sm
                                                        text-gray-700
                                                        hover:bg-blue-50
                                                        hover:text-blue-700
                                                        transition
                                                    ">

                                                    <span
                                                        class="flex h-8 w-8 items-center justify-center
                                                        rounded-lg bg-blue-50 text-blue-600">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1.8">

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                                        </svg>

                                                    </span>

                                                </a>

                                                <a href="{{ route('invoices.pdf', $invoice) }}" target="_blank"
                                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-green-700 hover:bg-green-50 transition">

                                                    <i class="fa-solid fa-file-pdf w-5 text-center"></i>

                                                </a>


                                                {{-- EDIT --}}
                                                <a href="{{ route('invoices.edit', $invoice) }}"
                                                    class="
                                                        flex
                                                        items-center
                                                        gap-3
                                                        px-3
                                                        py-2
                                                        text-sm
                                                        text-gray-700
                                                        hover:bg-amber-50
                                                        hover:text-amber-700
                                                        transition
                                                    ">

                                                    <span
                                                        class="flex h-8 w-8 items-center justify-center
                                                        rounded-lg bg-amber-50 text-amber-600">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1.8">

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />

                                                        </svg>

                                                    </span>

                                                </a>


                                                {{-- DELETE --}}
                                                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                                                    class="delete-invoice-form"
                                                    data-invoice-number="{{ $invoice->invoice_no }}">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="
                                                            w-full
                                                            flex
                                                            items-center
                                                            gap-3
                                                            px-3
                                                            py-2
                                                            text-sm
                                                            text-red-600
                                                            hover:bg-red-50
                                                            hover:text-red-700
                                                            transition
                                                        ">

                                                        <span
                                                            class="flex h-8 w-8 items-center justify-center
                                                            rounded-lg bg-red-50 text-red-600">

                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                stroke-width="1.8">

                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7" />

                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />

                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M4 7h16" />

                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M10 11v6M14 11v6" />

                                                            </svg>

                                                        </span>

                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div
                                        class="
                                            flex
                                            flex-col
                                            items-center
                                            justify-center
                                        ">

                                        <div
                                            class="
                                                w-16
                                                h-16
                                                rounded-2xl
                                                bg-gray-100
                                                text-gray-400
                                                flex
                                                items-center
                                                justify-center
                                                mb-4
                                            ">

                                            <i
                                                class="
                                                    fa-solid
                                                    fa-file-circle-xmark
                                                    text-2xl
                                                "></i>

                                        </div>


                                        <h3
                                            class="
                                                text-sm
                                                font-bold
                                                text-gray-700
                                            ">

                                            No invoices found

                                        </h3>


                                        <p
                                            class="
                                                text-sm
                                                text-gray-400
                                                mt-1
                                                max-w-sm
                                            ">

                                            There are no invoices matching your
                                            current search criteria.

                                        </p>


                                        <a href="{{ route('invoices.create') }}"
                                            class="
                                                mt-5
                                                inline-flex
                                                items-center
                                                gap-2
                                                px-4
                                                py-2
                                                bg-green-700
                                                hover:bg-green-800
                                                text-white
                                                rounded-lg
                                                text-sm
                                                font-semibold
                                                transition
                                            ">

                                            <i class="fa-solid fa-plus text-xs"></i>

                                            Create Invoice

                                        </a>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($invoices->hasPages())
                <div
                    class="
                            px-5
                            py-4
                            border-t
                            border-gray-200
                            bg-gray-50/50
                            flex
                            flex-col
                            sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-3
                        ">

                    {{-- Result information --}}

                    <div class="text-xs text-gray-500">

                        Showing

                        <span class="font-semibold text-gray-700">
                            {{ $invoices->firstItem() }}
                        </span>

                        to

                        <span class="font-semibold text-gray-700">
                            {{ $invoices->lastItem() }}
                        </span>

                        of

                        <span class="font-semibold text-gray-700">
                            {{ $invoices->total() }}
                        </span>

                        invoices

                    </div>


                    {{-- Pagination --}}

                    <div>

                        {{ $invoices->onEachSide(1)->links() }}

                    </div>

                </div>
            @endif

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // =========================================================
            // THREE DOT ACTION MENU
            // =========================================================

            const menuButtons =
                document.querySelectorAll('.invoice-action-menu');


            const dropdowns =
                document.querySelectorAll('.invoice-action-dropdown');


            menuButtons.forEach(function(button) {

                button.addEventListener('click', function(event) {

                    event.stopPropagation();


                    const menuId =
                        button.dataset.menu;


                    const currentMenu =
                        document.getElementById(menuId);


                    // Close all other menus
                    dropdowns.forEach(function(menu) {

                        if (menu !== currentMenu) {

                            menu.classList.add('hidden');

                        }

                    });


                    // Toggle current menu
                    currentMenu.classList.toggle('hidden');

                });

            });


            // =========================================================
            // CLOSE MENU WHEN CLICKING OUTSIDE
            // =========================================================

            document.addEventListener('click', function() {

                dropdowns.forEach(function(menu) {

                    menu.classList.add('hidden');

                });

            });


            // =========================================================
            // PREVENT DROPDOWN CLICK FROM CLOSING IMMEDIATELY
            // =========================================================

            dropdowns.forEach(function(menu) {

                menu.addEventListener('click', function(event) {

                    event.stopPropagation();

                });

            });


            // =========================================================
            // SWEETALERT DELETE CONFIRMATION
            // =========================================================

            const deleteForms =
                document.querySelectorAll('.delete-invoice-form');


            deleteForms.forEach(function(form) {

                form.addEventListener('submit', function(event) {

                    event.preventDefault();


                    const invoiceNumber =
                        form.dataset.invoiceNumber;


                    Swal.fire({

                        title: 'Delete Invoice?',

                        html: `
                    <div class="text-sm text-gray-600">
                        Are you sure you want to delete
                        <strong class="text-gray-800">
                            ${invoiceNumber}
                        </strong>?
                    </div>

                    <div class="text-xs text-red-500 mt-2">
                        This action cannot be undone.
                    </div>
                `,

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonText: '<i class="fa-solid fa-trash mr-1"></i> Delete',

                        cancelButtonText: '<i class="fa-solid fa-xmark mr-1"></i> Cancel',

                        reverseButtons: true,

                        focusCancel: true,

                        buttonsStyling: false,

                        customClass: {

                            popup: 'rounded-2xl',

                            title: 'text-xl font-bold text-gray-800',

                            confirmButton: 'px-5 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold text-sm ml-2',

                            cancelButton: 'px-5 py-2.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm'

                        }

                    }).then(function(result) {

                        if (result.isConfirmed) {

                            // Submit the original Laravel form
                            form.submit();

                        }

                    });

                });

            });

        });
    </script>
@endsection
