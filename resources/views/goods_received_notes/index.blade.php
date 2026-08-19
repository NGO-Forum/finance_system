@extends('layout.app')

@section('content')
    <div class="mx-auto max-w-full">

        <div class="mb-5">

            <div
                class="relative overflow-hidden rounded-3xl
                    border border-gray-100
                    bg-white
                    shadow-sm">

                {{-- Decorative background --}}
                <div
                    class="pointer-events-none absolute -right-20 -top-20
                   h-56 w-56 rounded-full
                   bg-green-50">
                </div>

                <div
                    class="pointer-events-none absolute -bottom-24 -left-20
                   h-48 w-48 rounded-full
                   bg-emerald-50/70">
                </div>


                <div class="relative flex flex-col gap-6 p-6 sm:p-7 lg:flex-row lg:items-center lg:justify-between">


                    <div class="flex items-start gap-4">

                        {{-- Icon --}}
                        <div
                            class="flex h-14 w-14 shrink-0
                           items-center justify-center
                           rounded-2xl
                           bg-green-100
                           text-green-700
                           shadow-sm">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 14.25l6-6m-6.75 9.75h7.5A2.25 2.25 0 0018 15.75V6.25A2.25 2.25 0 0015.75 4h-7.5A2.25 2.25 0 006 6.25v9.5A2.25 2.25 0 008.25 18z" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12M9 4v4m6-4v4" />

                            </svg>

                        </div>


                        {{-- Title --}}
                        <div>

                            <div class="flex flex-wrap items-center gap-3">

                                <h1
                                    class="text-2xl font-bold
                                   tracking-tight
                                   text-green-700
                                   sm:text-3xl">
                                    Goods / Service Received Notes
                                </h1>


                                {{-- FM Badge --}}
                                <span
                                    class="rounded-full
                                   border border-green-200
                                   bg-green-50
                                   px-3 py-1
                                   text-xs font-bold
                                   text-green-700">
                                    FM02-12
                                </span>

                            </div>


                            <p
                                class="mt-2 max-w-2xl
                               text-sm leading-6
                               text-gray-500">
                                Manage goods and services received,
                                inspected, accepted, or rejected from suppliers.
                            </p>


                            {{-- Small information --}}
                            <div
                                class="mt-4 flex flex-wrap
                               items-center gap-x-5 gap-y-2
                               text-xs text-gray-500">

                                <span class="inline-flex items-center gap-1.5">

                                    <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                    </svg>

                                    Receiving Records

                                </span>


                                <span class="hidden h-1 w-1 rounded-full bg-gray-300 sm:block"></span>


                                <span class="inline-flex items-center gap-1.5">

                                    <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />

                                    </svg>

                                    Inspection & Acceptance

                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="flex shrink-0 items-center gap-3">


                        {{-- Create button --}}
                        <a href="{{ route('goods-received-notes.create') }}"
                            class="group inline-flex
                           items-center justify-center
                           gap-2.5
                           rounded-2xl
                           bg-green-600
                           px-5 py-3.5
                           font-semibold text-white
                           shadow-sm
                           transition-all duration-200
                           hover:-translate-y-0.5
                           hover:bg-green-700
                           hover:shadow-lg
                           focus:outline-none
                           focus:ring-2
                           focus:ring-green-500
                           focus:ring-offset-2">

                            <span
                                class="flex h-6 w-6
                               items-center justify-center
                               rounded-lg
                               bg-white/15">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 transition-transform
                                   duration-200
                                   group-hover:rotate-90"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                                </svg>

                            </span>

                            Create

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200
                    bg-green-50 px-5 py-4 text-green-700">

                {{ session('success') }}

            </div>
        @endif


        {{-- SEARCH & FILTER --}}
        <div class="mb-5 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">
            {{-- Search Form --}}
            <div class="p-5 sm:p-6">

                <form method="GET" action="{{ route('goods-received-notes.index') }}">

                    <div class="flex flex-col gap-3
                       lg:flex-row lg:items-center">


                        {{-- SEARCH INPUT --}}


                        <div class="relative flex-1">

                            {{-- Icon --}}
                            <div
                                class="pointer-events-none
                               absolute inset-y-0 left-0
                               flex items-center pl-4
                               text-gray-400">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />

                                </svg>

                            </div>


                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search GRN number, supplier, PO number..." autocomplete="off"
                                class="w-full rounded-2xl
                               border border-gray-200
                               bg-gray-50
                               py-3.5 pl-11 pr-4
                               text-sm text-gray-800
                               placeholder:text-gray-400
                               transition-all
                               focus:border-green-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-green-500/10">

                        </div>



                        {{-- SEARCH BUTTON --}}


                        <button type="submit"
                            class="group inline-flex
                           items-center justify-center
                           gap-2
                           rounded-2xl
                           bg-green-600
                           px-6 py-3.5
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

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4.5 w-4.5
                               transition-transform duration-200
                               group-hover:scale-110"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />

                            </svg>

                            Search

                        </button>



                        {{-- CLEAR --}}


                        @if (request('search'))
                            <a href="{{ route('goods-received-notes.index') }}"
                                class="group inline-flex
                               items-center justify-center
                               gap-2
                               rounded-2xl
                               border border-gray-200
                               bg-white
                               px-6 py-3.5
                               text-sm font-semibold
                               text-gray-600
                               transition-all duration-200
                               hover:border-red-200
                               hover:bg-red-50
                               hover:text-red-600">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />

                                </svg>

                                Clear

                            </a>
                        @endif

                    </div>


                    {{-- Active Search --}}
                    @if (request('search'))
                        <div class="mt-4 flex flex-wrap
                           items-center gap-2">

                            <span class="text-xs font-medium text-gray-500">
                                Active search:
                            </span>


                            <span
                                class="inline-flex items-center gap-2
                               rounded-full
                               border border-green-200
                               bg-green-50
                               px-3 py-1.5
                               text-xs font-semibold
                               text-green-700">

                                <span
                                    class="h-1.5 w-1.5
                                   rounded-full
                                   bg-green-500"></span>

                                {{ request('search') }}

                            </span>

                        </div>
                    @endif

                </form>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-hidden rounded-3xl
           border border-gray-100
           bg-white shadow-sm">


            {{-- TABLE HEADER --}}

            <div
                class="flex flex-col gap-3
               border-b border-gray-100
               px-6 py-5
               sm:flex-row sm:items-center
               sm:justify-between">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10
                       items-center justify-center
                       rounded-xl
                       bg-green-50
                       text-green-600">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h18M5 6h14a2 2 0 012 2v12H3V8a2 2 0 012-2z" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 3v3m8-3v3" />

                        </svg>

                    </div>


                    <div>

                        <h2 class="text-base font-bold text-gray-800">
                            Received Notes
                        </h2>

                        <p class="text-xs text-gray-500">
                            Goods and service receiving records
                        </p>

                    </div>

                </div>


                {{-- Record count --}}
                <div
                    class="inline-flex w-fit
                   items-center gap-2
                   rounded-full
                   border border-green-100
                   bg-green-50
                   px-3 py-1.5
                   text-xs font-semibold
                   text-green-700">

                    <span class="h-2 w-2 rounded-full bg-green-500"></span>

                    {{ $goodsReceivedNotes->total() }}

                    {{ $goodsReceivedNotes->total() == 1 ? 'Record' : 'Records' }}

                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="min-w-[1000px] w-full">


                    {{-- HEADER --}}


                    <thead>

                        <tr class="border-b border-gray-200
                           bg-green-700 text-white">

                            <th
                                class="whitespace-nowrap
                               px-6 py-4
                               text-left text-[11px]
                               font-bold uppercase
                               tracking-wider
                              ">
                                #
                            </th>


                            <th
                                class="whitespace-nowrap
                               px-5 py-4
                               text-left text-[11px]
                               font-bold uppercase
                               tracking-wider
                              ">
                                GRN Information
                            </th>


                            <th
                                class="whitespace-nowrap
                               px-5 py-4
                               text-left text-[11px]
                               font-bold uppercase
                               tracking-wider
                              ">
                                Date
                            </th>


                            <th
                                class="whitespace-nowrap
                               px-5 py-4
                               text-left text-[11px]
                               font-bold uppercase
                               tracking-wider
                              ">
                                Supplier
                            </th>


                            <th
                                class="whitespace-nowrap
                               px-5 py-4
                               text-center text-[11px]
                               font-bold uppercase
                               tracking-wider
                              ">
                                Items
                            </th>


                            <th
                                class="whitespace-nowrap
                               px-5 py-4
                               text-left text-[11px]
                               font-bold uppercase
                               tracking-wider
                              ">
                                Created By
                            </th>


                            <th
                                class="whitespace-nowrap
                               px-6 py-4
                               text-center text-[11px]
                               font-bold uppercase
                               tracking-wider
                              ">
                                Actions
                            </th>

                        </tr>

                    </thead>



                    {{-- BODY --}}


                    <tbody class="divide-y divide-gray-100">

                        @forelse($goodsReceivedNotes as $index => $grn)
                            <tr
                                class="group
                               transition-all duration-150
                               hover:bg-green-50/40">


                                {{-- NUMBER --}}


                                <td class="px-6 py-2 align-middle">

                                    <span
                                        class="inline-flex h-8 w-8
                                       items-center justify-center
                                       rounded-lg
                                       bg-gray-100
                                       text-xs font-bold
                                       text-gray-500
                                       transition
                                       group-hover:bg-green-100
                                       group-hover:text-green-700">

                                        {{ $goodsReceivedNotes->firstItem() + $index }}

                                    </span>

                                </td>



                                {{-- GRN --}}


                                <td class="px-5 py-2">

                                    <div class="flex items-center gap-3">

                                        {{-- Document icon --}}
                                        <div
                                            class="flex h-10 w-10
                                           shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-green-50
                                           text-green-600
                                           transition
                                           group-hover:bg-green-100">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                            </svg>

                                        </div>


                                        <div>

                                            <a href="{{ route('goods-received-notes.show', $grn) }}"
                                                class="font-bold
                                               text-green-700
                                               transition
                                               hover:text-green-900
                                               hover:underline">

                                                {{ $grn->grn_no }}

                                            </a>


                                            @if ($grn->po_no)
                                                <div
                                                    class="mt-1 flex items-center
                                                   gap-1.5 text-xs
                                                   text-gray-500">

                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                                    </svg>

                                                    PO:
                                                    <span class="font-medium">
                                                        {{ $grn->po_no }}
                                                    </span>

                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </td>



                                {{-- DATE --}}


                                <td class="px-5 py-2">

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="flex h-8 w-8
                                           items-center justify-center
                                           rounded-lg
                                           bg-gray-100
                                           text-gray-500">

                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />

                                            </svg>

                                        </div>


                                        <span
                                            class="text-sm
                                           font-medium
                                           text-gray-700">

                                            {{ $grn->grn_date?->format('d-M-Y') }}

                                        </span>

                                    </div>

                                </td>



                                {{-- SUPPLIER --}}


                                <td class="px-5 py-2">

                                    <div>

                                        <div class="max-w-[220px]
                                           truncate
                                           text-sm font-semibold
                                           text-gray-800"
                                            title="{{ $grn->supplier_name }}">

                                            {{ $grn->supplier_name }}

                                        </div>


                                        @if ($grn->supplier_tel)
                                            <div
                                                class="mt-1 flex items-center
                                               gap-1.5 text-xs
                                               text-gray-500">

                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.02 3.06a1 1 0 01-.272 1.023L8.7 8.95a16 16 0 006.35 6.35l1.183-1.276a1 1 0 011.023-.272l3.06 1.02A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />

                                                </svg>

                                                {{ $grn->supplier_tel }}

                                            </div>
                                        @endif

                                    </div>

                                </td>



                                {{-- ITEMS --}}


                                <td class="px-5 py-2 text-center">

                                    <span
                                        class="inline-flex min-w-[42px]
                                       items-center justify-center
                                       rounded-xl
                                       border border-green-200
                                       bg-green-50
                                       px-3 py-2
                                       text-sm font-bold
                                       text-green-700">

                                        {{ $grn->items->count() }}

                                    </span>

                                </td>



                                {{-- CREATED BY --}}


                                <td class="px-5 py-2">

                                    <div class="flex items-center gap-3">

                                        {{-- Avatar --}}
                                        <div
                                            class="flex h-9 w-9
                                           shrink-0
                                           items-center justify-center
                                           rounded-full
                                           bg-gray-100
                                           text-xs font-bold
                                           text-gray-600">

                                            {{ strtoupper(substr($grn->creator?->name ?? 'U', 0, 1)) }}

                                        </div>


                                        <div>

                                            <div
                                                class="text-sm
                                               font-semibold
                                               text-gray-700">

                                                {{ $grn->creator?->name ?? '-' }}

                                            </div>


                                            <div class="text-xs text-gray-400">
                                                Creator
                                            </div>

                                        </div>

                                    </div>

                                </td>




                                {{-- ACTION MENU --}}
                                <td class="px-6 py-3">

                                    <div class="relative flex justify-center">

                                        {{-- Menu Button --}}
                                        <button type="button" onclick="toggleGrnMenu({{ $grn->id }})"
                                            title="Actions"
                                            class="inline-flex h-9 w-9
                                                    items-center justify-center
                                                    rounded-xl
                                                    border border-gray-200
                                                    bg-white
                                                    text-gray-500
                                                    shadow-sm
                                                    transition-all duration-200
                                                    hover:border-green-200
                                                    hover:bg-green-50
                                                    hover:text-green-700
                                                    hover:shadow-md
                                                    focus:outline-none
                                                    focus:ring-2
                                                    focus:ring-green-500/20">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <circle cx="12" cy="5" r="1.7" />
                                                <circle cx="12" cy="12" r="1.7" />
                                                <circle cx="12" cy="19" r="1.7" />
                                            </svg>

                                        </button>


        
                                        {{-- DROPDOWN --}}
        

                                        <div id="grn-menu-{{ $grn->id }}"
                                            class="absolute right-6 top-5 z-50 hidden w-14
                                                overflow-hidden
                                                rounded-2xl
                                                border border-gray-100
                                                bg-white
                                                shadow-xl
                                                ring-1 ring-black/5">

                                            {{-- View --}}
                                            <a href="{{ route('goods-received-notes.show', $grn) }}"
                                                class="flex items-center gap-3
                                                    px-3 py-2
                                                    text-sm font-medium
                                                    text-gray-700
                                                    transition
                                                    hover:bg-blue-50
                                                    hover:text-blue-700">

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


                                            {{-- Edit --}}
                                            <a href="{{ route('goods-received-notes.edit', $grn) }}"
                                                class="flex items-center gap-3
                                                        px-3 py-2
                                                        text-sm font-medium
                                                        text-gray-700
                                                        transition
                                                        hover:bg-amber-50
                                                        hover:text-amber-700">

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


                                            {{-- Export PDF --}}
                                            <a href="{{ route('goods-received-notes.pdf', $grn) }}" target="_blank"
                                                class="flex items-center gap-3
                                                        px-3 py-2
                                                        text-sm font-medium
                                                        text-gray-700
                                                        transition
                                                        hover:bg-green-50
                                                        hover:text-green-700">

                                                <span
                                                    class="flex h-8 w-8 items-center justify-center
                                                            rounded-lg bg-green-50 text-green-600">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.8">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 9V4h12v5" />

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 14h12v6H6v-6z" />

                                                    </svg>

                                                </span>

                                            </a>


                                            {{-- Delete --}}
                                            <form id="delete-grn-{{ $grn->id }}"
                                                action="{{ route('goods-received-notes.destroy', $grn) }}"
                                                method="POST">

                                                @csrf

                                                @method('DELETE')

                                                <button type="button" onclick="confirmDeleteGrn({{ $grn->id }})"
                                                    class="flex w-full items-center gap-3
                                                            px-3 py-2
                                                            text-left
                                                            text-sm font-medium
                                                            text-red-600
                                                            transition
                                                            hover:bg-red-50">

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

                                </td>

                            </tr>

                        @empty


                            {{-- EMPTY STATE --}}


                            <tr>

                                <td colspan="7" class="px-6 py-16">

                                    <div
                                        class="flex flex-col
                                       items-center
                                       justify-center
                                       text-center">

                                        <div
                                            class="mb-5 flex h-16 w-16
                                           items-center justify-center
                                           rounded-2xl
                                           bg-gray-100
                                           text-gray-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                            </svg>

                                        </div>


                                        <h3
                                            class="text-base font-bold
                                           text-gray-700">

                                            No Goods Received Notes Found

                                        </h3>


                                        <p
                                            class="mt-1 max-w-sm
                                           text-sm text-gray-500">

                                            There are currently no receiving
                                            records matching your search.

                                        </p>


                                        @if (request('search'))
                                            <a href="{{ route('goods-received-notes.index') }}"
                                                class="mt-5 inline-flex
                                               items-center gap-2
                                               rounded-xl
                                               bg-gray-100
                                               px-4 py-2.5
                                               text-sm font-semibold
                                               text-gray-700
                                               transition
                                               hover:bg-gray-200">

                                                Clear Search

                                            </a>
                                        @else
                                            <a href="{{ route('goods-received-notes.create') }}"
                                                class="mt-5 inline-flex
                                               items-center gap-2
                                               rounded-xl
                                               bg-green-600
                                               px-5 py-2.5
                                               text-sm font-semibold
                                               text-white
                                               transition
                                               hover:bg-green-700">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4v16m8-8H4" />

                                                </svg>

                                                Create First GRN

                                            </a>
                                        @endif

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>



            {{-- PAGINATION --}}
            @if ($goodsReceivedNotes->hasPages())
                <div
                    class="flex flex-col gap-3
                   border-t border-gray-100
                   bg-gray-50/50
                   px-6 py-4
                   sm:flex-row
                   sm:items-center
                   sm:justify-between">

                    <div class="text-xs text-gray-500">

                        Showing

                        <span class="font-semibold text-gray-700">
                            {{ $goodsReceivedNotes->firstItem() ?? 0 }}
                        </span>

                        to

                        <span class="font-semibold text-gray-700">
                            {{ $goodsReceivedNotes->lastItem() ?? 0 }}
                        </span>

                        of

                        <span class="font-semibold text-gray-700">
                            {{ $goodsReceivedNotes->total() }}
                        </span>

                        records

                    </div>


                    <div>

                        {{ $goodsReceivedNotes->links() }}

                    </div>

                </div>
            @endif

        </div>

    </div>

    <script>

        function toggleGrnMenu(id) {

            const menu = document.getElementById(
                `grn-menu-${id}`
            );

            if (!menu) {
                return;
            }


            // Close other menus
            document
                .querySelectorAll('[id^="grn-menu-"]')
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

        document.addEventListener(
            'click',
            function(event) {

                if (
                    !event.target.closest(
                        '[id^="grn-menu-"]'
                    ) &&
                    !event.target.closest(
                        'button[onclick^="toggleGrnMenu"]'
                    )
                ) {

                    document
                        .querySelectorAll(
                            '[id^="grn-menu-"]'
                        )
                        .forEach(function(menu) {

                            menu.classList.add('hidden');

                        });

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | SweetAlert Delete Confirmation
        |--------------------------------------------------------------------------
        */

        function confirmDeleteGrn(id) {

            Swal.fire({

                title: 'Delete GRN?',

                text: 'This Goods Received Note and its items will be permanently deleted.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc2626',

                cancelButtonColor: '#6b7280',

                confirmButtonText: 'Yes, delete it',

                cancelButtonText: 'Cancel',

                reverseButtons: true,

                focusCancel: true,

                customClass: {

                    popup: 'rounded-3xl',

                    confirmButton: 'rounded-xl px-5 py-2.5 font-semibold',

                    cancelButton: 'rounded-xl px-5 py-2.5 font-semibold',

                }

            }).then((result) => {

                if (result.isConfirmed) {

                    document
                        .getElementById(
                            `delete-grn-${id}`
                        )
                        .submit();

                }

            });

        }
    </script>
@endsection
