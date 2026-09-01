@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- ========================================================= --}}
        {{-- Purchase Order Header --}}
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
                    class="flex flex-col lg:flex-row
                   lg:items-center lg:justify-between
                   gap-5
                   px-6 py-5 pl-7">


                    {{-- ================================================= --}}
                    {{-- Left: Title --}}
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

                            {{-- Title Row --}}
                            <div class="flex flex-wrap items-center gap-2.5">

                                <h1
                                    class="text-xl sm:text-3xl
                                   font-bold
                                   tracking-tight
                                   text-green-700">

                                    Purchase Orders

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


                            {{-- Description --}}
                            <p class="mt-1 text-sm text-gray-500">

                                Create, manage and review purchase orders

                            </p>


                            {{-- Small Metadata --}}
                            <div
                                class="flex flex-wrap items-center
                               gap-x-4 gap-y-1
                               mt-2.5
                               text-xs text-gray-400">

                                <span class="inline-flex items-center gap-1.5">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 3c-2.755 0-5.29.925-7.318 2.484A11.95 11.95 0 002 12c0 2.21.6 4.28 1.64 6.016A11.95 11.95 0 0012 21c2.755 0 5.29-.925 7.318-2.484A11.95 11.95 0 0022 12c0-2.21-.6-4.28-1.64-6.016z" />

                                    </svg>

                                    Procurement Management

                                </span>


                                <span class="hidden sm:inline text-gray-300">
                                    |
                                </span>


                                <span>
                                    Finance Management Form
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- Right: Action --}}
                    {{-- ================================================= --}}

                    <div class="flex items-center gap-6">

                        <a href="{{ route('purchase-orders.template.pdf') }}" target="_blank"
                            class="inline-flex items-center gap-2
                                px-4 py-2
                                bg-red-600
                                hover:bg-red-700
                                text-white
                                rounded-lg
                                font-medium">
                            PDF Template
                        </a>

                        <a href="{{ route('purchase-orders.create') }}"
                            class="group
                           inline-flex items-center
                           justify-center
                           gap-2
                           w-full lg:w-auto
                           px-5 py-2.5
                           rounded-xl
                           bg-green-600
                           hover:bg-green-700
                           active:bg-green-800
                           text-white
                           text-sm
                           font-semibold
                           shadow-sm
                           hover:shadow-lg
                           transition-all
                           duration-200
                           focus:outline-none
                           focus:ring-2
                           focus:ring-green-500
                           focus:ring-offset-2">

                            {{-- Plus Icon --}}
                            <span
                                class="flex items-center justify-center
                               w-5 h-5
                               rounded-md
                               bg-white/15
                               group-hover:bg-white/20
                               transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4
                                   transition-transform
                                   duration-200
                                   group-hover:rotate-90"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />

                                </svg>

                            </span>


                            <span>
                                Create Purchase Order
                            </span>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        {{-- Success --}}
        @if (session('success'))
            <div
                class="mb-5
                    bg-green-50
                    border border-green-200
                    text-green-700
                    rounded-lg
                    px-4 py-3">

                {{ session('success') }}

            </div>
        @endif

        {{-- ========================================================= --}}
        {{-- Search / Filter --}}
        {{-- ========================================================= --}}

        <div class="mb-5">

            <div
                class="bg-white
               border border-gray-200
               rounded-2xl
               shadow-sm
               overflow-hidden">

                {{-- Search Header --}}
                <div
                    class="flex items-center gap-3
                   px-6 py-4
                   border-b border-gray-100
                   bg-gray-50/70">

                    <div
                        class="flex items-center justify-center
                       w-9 h-9
                       rounded-lg
                       bg-green-100
                       text-green-700">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />

                        </svg>

                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-green-700">
                            Search Purchase Orders
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Search by PO number, PR number, or supplier
                        </p>
                    </div>

                </div>


                {{-- Search Form --}}
                <form method="GET" action="{{ route('purchase-orders.index') }}" class="p-5">

                    <div
                        class="grid grid-cols-1
                       md:grid-cols-[1fr_auto_auto]
                       gap-3">


                        {{-- Search Input --}}
                        <div class="relative">

                            <div
                                class="absolute inset-y-0 left-0
                               flex items-center pl-3
                               pointer-events-none">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />

                                </svg>

                            </div>


                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search PO / PR / Supplier..."
                                class="w-full
                               pl-10 pr-4
                               py-2.5
                               rounded-xl
                               border border-gray-300
                               bg-white
                               text-sm text-gray-700
                               placeholder-gray-400
                               focus:border-green-500
                               focus:ring-2
                               focus:ring-green-100
                               focus:outline-none
                               transition">

                        </div>


                        {{-- Search Button --}}
                        <button type="submit"
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
                           transition-all
                           duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />

                            </svg>

                            Search

                        </button>


                        {{-- Reset Button --}}
                        <a href="{{ route('purchase-orders.index') }}"
                            class="inline-flex items-center
                           justify-center
                           gap-2
                           px-5 py-2.5
                           rounded-xl
                           border border-gray-300
                           bg-white
                           hover:bg-gray-50
                           hover:border-gray-400
                           text-gray-700
                           text-sm
                           font-semibold
                           transition-all
                           duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h5M20 20v-5h-5M5.5 9A7 7 0 0117 5.5L20 9M18.5 15A7 7 0 017 18.5L4 15" />

                            </svg>

                            Reset

                        </a>

                    </div>


                    {{-- Active Search --}}
                    @if (request('search'))
                        <div class="mt-3 flex items-center gap-2 text-xs text-gray-500">

                            <span>
                                Search results for:
                            </span>

                            <span
                                class="inline-flex items-center
                               px-2.5 py-1
                               rounded-lg
                               bg-green-50
                               text-green-700
                               font-medium">

                                "{{ request('search') }}"

                            </span>

                        </div>
                    @endif

                </form>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- Purchase Orders Table --}}
        {{-- ========================================================= --}}

        <div
            class="bg-white
                border border-gray-200
                rounded-2xl
                shadow-sm
                overflow-hidden">

            {{-- Table Header --}}
            <div
                class="px-6 py-4
                    border-b border-gray-100
                    bg-gradient-to-r from-green-600 to-green-700">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-lg font-bold text-white">
                            Purchase Order List
                        </h2>

                        <p class="text-xs text-gray-200 mt-1">
                            Manage and review all purchase orders
                        </p>

                    </div>

                    <div
                        class="hidden sm:flex items-center gap-2
                       px-3 py-1.5
                       rounded-lg
                       bg-green-50
                       text-green-700
                       text-xs font-semibold">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                        </svg>

                        Purchase Orders

                    </div>

                </div>

            </div>


            {{-- Responsive Table --}}
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    {{-- ================================================= --}}
                    {{-- Table Head --}}
                    {{-- ================================================= --}}

                    <thead>

                        <tr class="bg-green-50
                           border-b border-gray-200">

                            <th
                                class="px-6 py-4
                               text-left
                               text-sm
                               uppercase
                               tracking-wider
                               font-bold
                               text-gray-500
                               whitespace-nowrap">
                                #
                            </th>

                            <th
                                class="px-6 py-4
                               text-left
                               text-sm
                               uppercase
                               tracking-wider
                               font-bold
                               text-gray-500
                               whitespace-nowrap">
                                Purchase Orders NO.
                            </th>

                            <th
                                class="px-6 py-4
                               text-left
                               text-sm
                               uppercase
                               tracking-wider
                               font-bold
                               text-gray-500
                               whitespace-nowrap">
                                Purchase Request No.
                            </th>

                            <th
                                class="px-6 py-4
                               text-left
                               text-sm
                               uppercase
                               tracking-wider
                               font-bold
                               text-gray-500
                               whitespace-nowrap">
                                Date
                            </th>

                            <th
                                class="px-6 py-4
                               text-left
                               text-sm
                               uppercase
                               tracking-wider
                               font-bold
                               text-gray-500
                               min-w-[220px]">
                                Supplier
                            </th>

                            <th
                                class="px-6 py-4
                               text-right
                               text-sm
                               uppercase
                               tracking-wider
                               font-bold
                               text-gray-500
                               whitespace-nowrap">
                                Total
                            </th>

                            <th
                                class="px-6 py-4
                               text-center
                               text-sm
                               uppercase
                               tracking-wider
                               font-bold
                               text-gray-500
                               whitespace-nowrap">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    {{-- ================================================= --}}
                    {{-- Table Body --}}
                    {{-- ================================================= --}}

                    <tbody class="divide-y divide-gray-100">

                        @forelse($purchaseOrders as $purchaseOrder)
                            <tr
                                class="group
                               hover:bg-green-50/30
                               transition-colors
                               duration-150">


                                {{-- Number --}}
                                <td
                                    class="px-6 py-2
                                   text-gray-400
                                   font-medium
                                   whitespace-nowrap">

                                    {{ $purchaseOrders->firstItem() + $loop->index }}

                                </td>


                                {{-- PO Number --}}
                                <td class="px-6 py-2">

                                    <a href="{{ route('purchase-orders.show', $purchaseOrder) }}"
                                        class="inline-flex items-center gap-2
                                            font-bold
                                            text-green-700
                                            hover:text-green-800
                                            transition">

                                        <span
                                            class="flex items-center justify-center
                                           w-8 h-8
                                           rounded-lg
                                           bg-green-50
                                           text-green-600
                                           group-hover:bg-green-100">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                            </svg>

                                        </span>

                                        {{ $purchaseOrder->po_no }}

                                    </a>

                                </td>


                                {{-- PR Number --}}
                                <td
                                    class="px-6 py-2
                                   text-gray-600
                                   whitespace-nowrap">

                                    @if ($purchaseOrder->pr_no)
                                        <span
                                            class="inline-flex items-center
                                           px-2.5 py-1
                                           rounded-lg
                                           bg-gray-50
                                           border border-gray-200
                                           text-xs
                                           font-medium
                                           text-gray-600">

                                            {{ $purchaseOrder->pr_no }}

                                        </span>
                                    @else
                                        <span class="text-gray-400">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- Date --}}
                                <td
                                    class="px-6 py-2
                                   text-gray-600
                                   whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />

                                        </svg>

                                        {{ $purchaseOrder->po_date ? $purchaseOrder->po_date->format('d-M-Y') : '—' }}

                                    </div>

                                </td>


                                {{-- Supplier --}}
                                <td class="px-6 py-2">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex-shrink-0
                                           w-8 h-8
                                           flex items-center justify-center
                                           rounded-lg
                                           bg-gray-100
                                           text-green-600
                                           font-bold
                                           text-xs
                                           uppercase">

                                            {{ strtoupper(substr($purchaseOrder->supplier_name, 0, 2)) }}

                                        </div>


                                        <div class="min-w-0">

                                            <div
                                                class="font-semibold
                                               text-gray-800
                                               truncate">

                                                {{ $purchaseOrder->supplier_name }}

                                            </div>


                                            @if ($purchaseOrder->supplier_phone)
                                                <div
                                                    class="flex items-center gap-1
                                                   mt-0.5
                                                   text-xs
                                                   text-gray-400">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.2 3.598a1 1 0 01-.502 1.21l-2.1 1.05a11.04 11.04 0 005.832 5.832l1.05-2.1a1 1 0 011.21-.502l3.598 1.2A1 1 0 0121 14.72V18a2 2 0 01-2 2h-1C9.611 20 4 14.389 4 7V6a2 2 0 01-1-1z" />

                                                    </svg>

                                                    {{ $purchaseOrder->supplier_phone }}

                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Total --}}
                                <td
                                    class="px-6 py-2
                                   text-right
                                   whitespace-nowrap">

                                    <div class="font-bold
                                       text-gray-800">

                                        {{ $purchaseOrder->currency }}
                                        {{ number_format($purchaseOrder->grand_total, 2) }}

                                    </div>

                                </td>


                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center">

                                    <div class="relative inline-block text-left">

                                        {{-- 3-Dot Button --}}
                                        <button type="button" onclick="toggleActionMenu({{ $purchaseOrder->id }})"
                                            class="inline-flex items-center justify-center
                                                w-9 h-9
                                                rounded-lg
                                                text-gray-500
                                                hover:text-gray-700
                                                hover:bg-gray-100
                                                transition
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-green-500
                                                focus:ring-offset-1"
                                            title="Actions">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 24 24">

                                                <path
                                                    d="M12 8a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4z" />

                                            </svg>

                                        </button>


                                        {{-- Dropdown Menu --}}
                                        <div id="actionMenu-{{ $purchaseOrder->id }}"
                                            class="hidden absolute -right-2 -mt-4 w-12
                                                bg-white
                                                border border-gray-200
                                                rounded-xl
                                                shadow-xl
                                                z-50
                                                overflow-hidden">

                                            {{-- View --}}
                                            <a href="{{ route('purchase-orders.show', $purchaseOrder) }}"
                                                class="flex items-center gap-3
                                                    px-4 py-2.5
                                                    text-sm text-blue-700
                                                    hover:bg-blue-50
                                                    hover:text-blue-700
                                                    transition">

                                                <i class="fas fa-eye"></i>
                                            </a>


                                            <a href="{{ route('purchase-orders.pdf', $purchaseOrder) }}" target="_blank"
                                                class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50">

                                                <i class="fas fa-file-pdf"></i>

                                            </a>


                                            {{-- Edit --}}
                                            <a href="{{ route('purchase-orders.edit', $purchaseOrder) }}"
                                                class="flex items-center gap-3
                                                    px-4 py-2.5
                                                    text-sm text-green-700
                                                    hover:bg-green-50
                                                    hover:text-green-700
                                                    transition">

                                                <i class="fas fa-edit"></i>

                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('purchase-orders.destroy', $purchaseOrder) }}"
                                                method="POST" class="delete-form">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button" onclick="confirmDelete(this)"
                                                    class="w-full
                                                        flex items-center gap-3
                                                        px-4 py-2.5
                                                        text-sm text-red-600
                                                        hover:bg-red-50
                                                        hover:text-red-700
                                                        transition">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            {{-- Empty State --}}
                            <tr>

                                <td colspan="8" class="px-6 py-16">

                                    <div class="flex flex-col items-center justify-center">

                                        <div
                                            class="w-14 h-14
                                           flex items-center justify-center
                                           rounded-2xl
                                           bg-gray-100
                                           text-gray-400
                                           mb-4">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                            </svg>

                                        </div>


                                        <h3 class="text-sm font-semibold text-gray-700">

                                            No Purchase Orders Found

                                        </h3>


                                        <p class="text-xs text-gray-400 mt-1">

                                            There are currently no purchase orders to display.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ========================================================= --}}
            {{-- Pagination --}}
            {{-- ========================================================= --}}

            @if ($purchaseOrders->hasPages())
                <div class="px-6 py-4
                   border-t border-gray-100
                   bg-gray-50/50">

                    {{ $purchaseOrders->links() }}

                </div>
            @endif

        </div>

    </div>

    <script>
        /*
                    |--------------------------------------------------------------------------
                    | Toggle Action Menu
                    |--------------------------------------------------------------------------
                    */

        function toggleActionMenu(id) {

            const menu = document.getElementById(
                'actionMenu-' + id
            );

            // Close all other menus
            document
                .querySelectorAll('[id^="actionMenu-"]')
                .forEach(function(item) {

                    if (item !== menu) {
                        item.classList.add('hidden');
                    }

                });

            // Toggle current menu
            menu.classList.toggle('hidden');
        }


        /*
        |--------------------------------------------------------------------------
        | Close Menu When Clicking Outside
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', function(event) {

            if (
                !event.target.closest('.relative')
            ) {

                document
                    .querySelectorAll('[id^="actionMenu-"]')
                    .forEach(function(menu) {

                        menu.classList.add('hidden');

                    });

            }

        });

        function confirmDelete(button) {

            const form = button.closest('.delete-form');

            Swal.fire({

                title: 'Delete Purchase Order?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc2626',

                cancelButtonColor: '#6b7280',

                confirmButtonText: 'Yes, Delete',

                cancelButtonText: 'Cancel',

                reverseButtons: true,

                focusCancel: true,

                customClass: {

                    popup: 'rounded-2xl',

                    confirmButton: 'rounded-lg px-5 py-2.5 font-semibold',

                    cancelButton: 'rounded-lg px-5 py-2.5 font-semibold'

                }

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        }
    </script>
@endsection
