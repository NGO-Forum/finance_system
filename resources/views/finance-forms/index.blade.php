@extends('layout.app')

@section('content')
    <div class="min-h-screen">

        <div class="mx-auto max-w-full">

            <div class="mb-5">

                <div
                    class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between bg-gradient-to-r from-green-600 to-emerald-600 p-6 rounded-lg">

                    <div>

                        {{-- Breadcrumb --}}
                        <div class="mb-2.5 flex items-center gap-2 text-xs font-medium text-gray-200">

                            <a href="{{ route('dashboard') }}" class="transition hover:text-emerald-600">
                                Dashboard
                            </a>

                            <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m9 18 6-6-6-6" />
                            </svg>

                            <span>
                                Finance
                            </span>

                            <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m9 18 6-6-6-6" />
                            </svg>

                            <span class="text-gray-300">
                                Finance Forms
                            </span>

                        </div>


                        {{-- Title --}}
                        <div>

                            <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                                Finance Forms
                            </h1>

                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-200">
                                Create and manage financial transactions, accounting entries,
                                payments, reimbursements and settlements.
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-2.5">

                        {{-- Refresh --}}
                        <a href="{{ route('finance-forms.index') }}"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-3.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-300 hover:bg-gray-50"
                            title="Refresh">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M20 11a8.1 8.1 0 0 0-14.9-4M4 5v4h4M4 13a8.1 8.1 0 0 0 14.9 4M20 19v-4h-4" />
                            </svg>

                            <span class="hidden sm:inline">
                                Refresh
                            </span>

                        </a>


                        {{-- Create --}}
                        <button type="button" id="openCreateForm" aria-expanded="false" aria-controls="createFinanceMenu"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-white px-4 text-sm font-bold text-emerald-700 shadow-sm shadow-emerald-600/10 transition hover:text-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>

                            <span>
                                New Form
                            </span>

                            <svg id="createChevron" class="h-4 w-4 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m6 9 6 6 6-6" />
                            </svg>

                        </button>

                    </div>

                </div>


                <div id="createFinanceMenu"
                    class="mt-5 hidden overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-[0_15px_40px_rgba(15,23,42,0.10)]">

                    {{-- ====================================================== --}}
                    {{-- HEADER --}}
                    {{-- ====================================================== --}}

                    <div
                        class="relative overflow-hidden border-b border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-white px-6 py-6">

                        {{-- Decorative background --}}
                        <div
                            class="pointer-events-none absolute -right-12 -top-12 h-40 w-40 rounded-full bg-emerald-100/50 blur-2xl">
                        </div>

                        <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                            {{-- Left --}}
                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M12 5v14m-7-7h14" />
                                    </svg>

                                </div>


                                <div>

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h2 class="text-lg font-bold tracking-tight text-gray-900">
                                            Create Finance Form
                                        </h2>

                                        <span
                                            class="rounded-full border border-emerald-200 bg-white px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 shadow-sm">
                                            6 Forms
                                        </span>

                                    </div>


                                    <p class="mt-1.5 max-w-2xl text-sm leading-6 text-gray-500">
                                        Select the transaction type that matches the financial document you need to create.
                                    </p>

                                </div>

                            </div>


                            {{-- Right --}}
                            <div class="hidden items-center gap-2 sm:flex">

                                <span
                                    class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 text-xs font-semibold text-gray-500 shadow-sm">

                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                    Finance

                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- ====================================================== --}}
                    {{-- FORM GRID --}}
                    {{-- ====================================================== --}}

                    <div class="grid grid-cols-1 gap-4 bg-gray-50/70 p-5 sm:p-6 md:grid-cols-2 xl:grid-cols-3">


                        {{-- ================================================== --}}
                        {{-- JOURNAL ENTRY --}}
                        {{-- ================================================== --}}

                        <a href="{{ route('finance-forms.journal-entry.create') }}"
                            class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-lg">

                            {{-- Top accent --}}
                            <div class="absolute inset-x-0 top-0 h-1 bg-slate-500"></div>


                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 ring-1 ring-slate-200 transition group-hover:bg-slate-200">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M7.5 4.5h9A1.5 1.5 0 0 1 18 6v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 6 18V6a1.5 1.5 0 0 1 1.5-1.5ZM9 8h6M9 12h6M9 16h3" />
                                    </svg>

                                </div>


                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50 text-gray-300 transition group-hover:bg-slate-50 group-hover:text-slate-600">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m9 18 6-6-6-6" />
                                    </svg>

                                </div>

                            </div>


                            <div class="mt-5">

                                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                                    Accounting
                                </span>


                                <h3 class="mt-1.5 text-base font-bold text-gray-900 transition group-hover:text-slate-700">
                                    Journal Entry
                                </h3>


                                <p class="mt-1.5 text-sm leading-5 text-gray-500">
                                    Record accounting adjustments and journal transactions.
                                </p>

                            </div>

                        </a>


                        {{-- ================================================== --}}
                        {{-- INCOME --}}
                        {{-- ================================================== --}}

                        <a href="{{ route('finance-forms.income.create') }}"
                            class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-300 hover:shadow-lg">

                            <div class="absolute inset-x-0 top-0 h-1 bg-emerald-500"></div>


                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 ring-1 ring-emerald-200 transition group-hover:bg-emerald-200">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M12 4v16m4-12h-3.5a2 2 0 0 0 0 4h3a2 2 0 0 1 0 4H8" />
                                    </svg>

                                </div>


                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50 text-gray-300 transition group-hover:bg-emerald-50 group-hover:text-emerald-600">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m9 18 6-6-6-6" />
                                    </svg>

                                </div>

                            </div>


                            <div class="mt-5">

                                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-emerald-600">
                                    Revenue
                                </span>


                                <h3
                                    class="mt-1.5 text-base font-bold text-gray-900 transition group-hover:text-emerald-700">
                                    Income
                                </h3>


                                <p class="mt-1.5 text-sm leading-5 text-gray-500">
                                    Record grants, donor receipts and other income transactions.
                                </p>

                            </div>

                        </a>


                        {{-- ================================================== --}}
                        {{-- DIRECT PAY --}}
                        {{-- ================================================== --}}

                        <a href="{{ route('finance-forms.direct-pay.create') }}"
                            class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-blue-300 hover:shadow-lg">

                            <div class="absolute inset-x-0 top-0 h-1 bg-blue-500"></div>


                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-700 ring-1 ring-blue-200 transition group-hover:bg-blue-200">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M5.5 7.5h13M5.5 12h13M5.5 16.5h8M7 4.5h10A1.5 1.5 0 0 1 18.5 6v12A1.5 1.5 0 0 1 17 19.5H7A1.5 1.5 0 0 1 5.5 18V6A1.5 1.5 0 0 1 7 4.5Z" />
                                    </svg>

                                </div>


                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50 text-gray-300 transition group-hover:bg-blue-50 group-hover:text-blue-600">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m9 18 6-6-6-6" />
                                    </svg>

                                </div>

                            </div>


                            <div class="mt-5">

                                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-blue-600">
                                    Payment
                                </span>


                                <h3 class="mt-1.5 text-base font-bold text-gray-900 transition group-hover:text-blue-700">
                                    Direct Pay
                                </h3>


                                <p class="mt-1.5 text-sm leading-5 text-gray-500">
                                    Record consultant, supplier and direct payment transactions.
                                </p>

                            </div>

                        </a>


                        {{-- ================================================== --}}
                        {{-- REIMBURSEMENT --}}
                        {{-- ================================================== --}}

                        <a href="{{ route('finance-forms.reimbursement.create') }}"
                            class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-violet-300 hover:shadow-lg">

                            <div class="absolute inset-x-0 top-0 h-1 bg-violet-500"></div>


                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-100 text-violet-700 ring-1 ring-violet-200 transition group-hover:bg-violet-200">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M7.5 4.5h9A1.5 1.5 0 0 1 18 6v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 6 18V6a1.5 1.5 0 0 1 1.5-1.5ZM9 8h6M9 12h4M9 16h5" />
                                    </svg>

                                </div>


                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50 text-gray-300 transition group-hover:bg-violet-50 group-hover:text-violet-600">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m9 18 6-6-6-6" />
                                    </svg>

                                </div>

                            </div>


                            <div class="mt-5">

                                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-violet-600">
                                    Expense
                                </span>


                                <h3
                                    class="mt-1.5 text-base font-bold text-gray-900 transition group-hover:text-violet-700">
                                    Reimbursement
                                </h3>


                                <p class="mt-1.5 text-sm leading-5 text-gray-500">
                                    Record staff expense reimbursement transactions.
                                </p>

                            </div>

                        </a>


                        {{-- ================================================== --}}
                        {{-- DISBURSEMENT --}}
                        {{-- ================================================== --}}

                        <a href="{{ route('finance-forms.disbursement.create') }}"
                            class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-orange-300 hover:shadow-lg">

                            <div class="absolute inset-x-0 top-0 h-1 bg-orange-500"></div>


                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-100 text-orange-700 ring-1 ring-orange-200 transition group-hover:bg-orange-200">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M12 4.5v15m-4.5-4.5L12 19.5l4.5-4.5M5.5 7.5h13" />
                                    </svg>

                                </div>


                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50 text-gray-300 transition group-hover:bg-orange-50 group-hover:text-orange-600">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m9 18 6-6-6-6" />
                                    </svg>

                                </div>

                            </div>


                            <div class="mt-5">

                                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-orange-600">
                                    Advance
                                </span>


                                <h3
                                    class="mt-1.5 text-base font-bold text-gray-900 transition group-hover:text-orange-700">
                                    Disbursement
                                </h3>


                                <p class="mt-1.5 text-sm leading-5 text-gray-500">
                                    Create cash advances and disbursement records.
                                </p>

                            </div>

                        </a>


                        {{-- ================================================== --}}
                        {{-- CASH ADVANCE SETTLEMENT --}}
                        {{-- ================================================== --}}

                        <a href="{{ route('finance-forms.cash-advance-settlement.create') }}"
                            class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-pink-300 hover:shadow-lg">

                            <div class="absolute inset-x-0 top-0 h-1 bg-pink-500"></div>


                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-pink-100 text-pink-700 ring-1 ring-pink-200 transition group-hover:bg-pink-200">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M5 8.5A7.5 7.5 0 0 1 18.5 6m0 0V3.5m0 2.5H16M19 15.5A7.5 7.5 0 0 1 5.5 18m0 0v2.5m0-2.5H8" />
                                    </svg>

                                </div>


                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50 text-gray-300 transition group-hover:bg-pink-50 group-hover:text-pink-600">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m9 18 6-6-6-6" />
                                    </svg>

                                </div>

                            </div>


                            <div class="mt-5">

                                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-pink-600">
                                    Settlement
                                </span>


                                <h3 class="mt-1.5 text-base font-bold text-gray-900 transition group-hover:text-pink-700">
                                    Cash Advance Settlement
                                </h3>


                                <p class="mt-1.5 text-sm leading-5 text-gray-500">
                                    Settle advances and calculate refund or additional payment.
                                </p>

                            </div>

                        </a>

                    </div>


                    {{-- ====================================================== --}}
                    {{-- FOOTER --}}
                    {{-- ====================================================== --}}

                    <div
                        class="flex flex-col gap-2 border-t border-gray-200 bg-white px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-gray-400">
                            Select a finance form to continue.
                        </p>


                        <div class="flex items-center gap-2 text-[11px] text-gray-400">

                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                            Finance transaction workflow

                        </div>

                    </div>

                </div>

            </div>


            @if (session('success'))
                <div class="mb-6">

                    <div class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">

                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-emerald-600">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m5 12 4 4L19 6" />
                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-bold uppercase tracking-wide text-emerald-700">
                                Success
                            </p>

                            <p class="mt-0.5 text-sm text-emerald-800">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>
            @endif


            @php

                $totalForms = $financeForms->total();

                $draftCount = \App\Models\FinanceForm::where('status', 'draft')->count();

                $completedCount = \App\Models\FinanceForm::where('status', 'completed')->count();

                $cancelledCount = \App\Models\FinanceForm::where('status', 'cancelled')->count();

            @endphp


            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-200">

                    <div
                        class="flex flex-col gap-4 px-5 py-5 lg:flex-row lg:items-center lg:justify-between lg:px-6 bg-green-600">

                        {{-- Title --}}
                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-green-700">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M4.75 6.75h14.5M4.75 12h14.5M4.75 17.25h9" />
                                </svg>

                            </div>


                            <div>

                                <h2 class="text-sm font-bold text-white">
                                    Finance Transactions
                                </h2>

                                <p class="mt-0.5 text-xs text-gray-200">
                                    Search, filter and review financial records.
                                </p>

                            </div>

                        </div>
                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full table-fixed">

                        <thead>

                            <tr class="bg-emerald-50/90">

                                <th
                                    class="w-[17%] whitespace-nowrap border-b border-emerald-100 px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-700">
                                    Voucher
                                </th>


                                <th
                                    class="w-[13%] whitespace-nowrap border-b border-emerald-100 px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-700">
                                    Date
                                </th>


                                <th
                                    class="w-[20%] whitespace-nowrap border-b border-emerald-100 px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-700">
                                    Transaction Type
                                </th>


                                <th
                                    class="w-[24%] whitespace-nowrap border-b border-emerald-100 px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-700">
                                    Received From / Pay To
                                </th>


                                <th
                                    class="w-[12%] whitespace-nowrap border-b border-emerald-100 px-6 py-4 text-right text-xs font-bold uppercase tracking-wide text-slate-700">
                                    Amount
                                </th>


                                <th
                                    class="w-[14%] whitespace-nowrap border-b border-emerald-100 px-6 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-700">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody class="bg-white">

                            @forelse ($financeForms as $financeForm)
                                <tr class="border-b border-gray-100 transition-colors duration-150 hover:bg-emerald-50/30">

                                    <td class="px-6 py-2">

                                        {{ $financeForm->voucher_no ?: 'N/A' }}

                                    </td>


                                    <td class="px-6 py-2">

                                        <span class="text-sm text-slate-600">
                                            {{ $financeForm->voucher_date?->format('d M Y') ?? '—' }}
                                        </span>

                                    </td>


                                    <td class="px-6 py-2">

                                        @php

                                            $typeLabel = match ($financeForm->transaction_type) {
                                                'journal_entry' => 'Journal Entry',

                                                'income' => 'Income',

                                                'direct_payment' => 'Direct Pay',

                                                'reimbursement' => 'Reimbursement',

                                                'disbursement' => 'Disbursement',

                                                'cash_advance_settlement' => 'Cash Advance Settlement',

                                                default => $financeForm->transaction_type_label,
                                            };

                                        @endphp


                                        <span class="text-sm font-medium text-slate-700">
                                            {{ $typeLabel }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-2">

                                        <span class="block truncate text-sm text-slate-600">
                                            {{ $financeForm->received_from ?: '—' }}
                                        </span>

                                    </td>


                                    <td class="px-6 py-2 text-right">

                                        <span class="text-sm font-semibold tabular-nums text-slate-800">
                                            ${{ number_format((float) $financeForm->amount, 2) }}
                                        </span>

                                    </td>


                                    <td class="relative px-6 py-2 text-center">

                                        <div class="relative inline-block text-left">

                                            {{-- ===================================================== --}}
                                            {{-- MENU BUTTON --}}
                                            {{-- ===================================================== --}}

                                            <button type="button"
                                                class="finance-action-menu inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                                data-menu-target="finance-menu-{{ $financeForm->id }}"
                                                aria-label="Actions" aria-expanded="false">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                    fill="currentColor" viewBox="0 0 24 24">

                                                    <path
                                                        d="M12 8a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4z" />

                                                </svg>


                                            </button>


                                            {{-- ===================================================== --}}
                                            {{-- DROPDOWN --}}
                                            {{-- ===================================================== --}}

                                            <div id="finance-menu-{{ $financeForm->id }}"
                                                class="finance-action-dropdown absolute -right-3 z-50 -mt-2 hidden w-12 origin-top-right rounded-xl border border-gray-200 bg-white text-left shadow-xl shadow-gray-200/50">

                                                {{-- VIEW --}}
                                                <a href="{{ route('finance-forms.show', $financeForm) }}"
                                                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-50">

                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M2.75 12s3.25-6.25 9.25-6.25S21.25 12 21.25 12 18 18.25 12 18.25 2.75 12 2.75 12Z" />

                                                        <circle cx="12" cy="12" r="2.75"
                                                            stroke-width="1.8" />
                                                    </svg>

                                                </a>


                                                {{-- EDIT --}}
                                                <a href="{{ route('finance-forms.edit', $financeForm) }}"
                                                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-green-700 transition hover:bg-green-50">

                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M13.5 5.5 18.5 10.5M5 19l3.75-.75L19.25 7.75a1.768 1.768 0 0 0-2.5-2.5L6.25 15l-.75 4Z" />
                                                    </svg>

                                                </a>


                                                {{-- DELETE --}}
                                                <button type="button"
                                                    class="finance-delete-button flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                                    data-delete-url="{{ route('finance-forms.destroy', $financeForm) }}"
                                                    data-voucher="{{ $financeForm->voucher_no ?: 'this finance form' }}">

                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M6 7.5h12M9.5 7.5V5.75A1.75 1.75 0 0 1 11.25 4h1.5a1.75 1.75 0 0 1 1.75 1.75V7.5m-7.5 0 .75 12.25h8.5L17 7.5M10 11v5M14 11v5" />
                                                    </svg>

                                                </button>

                                            </div>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                {{-- ================================================= --}}
                                {{-- EMPTY STATE --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td colspan="6" class="h-[390px] px-6 py-10">

                                        <div class="flex h-full flex-col items-center justify-center text-center">

                                            {{-- Empty Icon --}}
                                            <div
                                                class="flex h-24 w-24 items-center justify-center rounded-full bg-emerald-50">

                                                <div
                                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100">

                                                    <svg class="h-9 w-9 text-emerald-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M7.5 4.5h9A1.5 1.5 0 0 1 18 6v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 6 18V6a1.5 1.5 0 0 1 1.5-1.5ZM9 8h6M9 11.5h6M9 15h3" />

                                                    </svg>

                                                </div>

                                            </div>


                                            {{-- Title --}}
                                            <h3 class="mt-7 text-xl font-semibold text-slate-800">
                                                No Finance Transactions Found
                                            </h3>


                                            {{-- Description --}}
                                            <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">
                                                There are no finance forms available at the moment.
                                                Create your first finance transaction to get started.
                                            </p>


                                            {{-- Button --}}
                                            <a href="#create-finance-form"
                                                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4" />

                                                </svg>

                                                Create Finance Form

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- ========================================================== --}}
                {{-- TABLE FOOTER --}}
                {{-- ========================================================== --}}

                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        {{-- Showing --}}
                        <p class="text-sm text-slate-500">

                            Showing

                            <span class="font-semibold text-slate-700">
                                {{ $financeForms->firstItem() ?? 0 }}
                            </span>

                            -

                            <span class="font-semibold text-slate-700">
                                {{ $financeForms->lastItem() ?? 0 }}
                            </span>

                            of

                            <span class="font-semibold text-slate-700">
                                {{ $financeForms->total() }}
                            </span>

                        </p>


                        {{-- Pagination --}}
                        @if ($financeForms->hasPages())
                            <div>
                                {{ $financeForms->links() }}
                            </div>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const button =
                document.getElementById('openCreateForm');

            const menu =
                document.getElementById('createFinanceMenu');

            const chevron =
                document.getElementById('createChevron');


            if (!button || !menu) {
                return;
            }


            button.addEventListener('click', function() {

                const isHidden =
                    menu.classList.contains('hidden');


                if (isHidden) {

                    menu.classList.remove('hidden');

                    button.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                    if (chevron) {

                        chevron.classList.add(
                            'rotate-180'
                        );

                    }

                } else {

                    menu.classList.add('hidden');

                    button.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                    if (chevron) {

                        chevron.classList.remove(
                            'rotate-180'
                        );

                    }

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Close when clicking outside
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'click',
                function(event) {

                    if (
                        !menu.contains(event.target) &&
                        !button.contains(event.target)
                    ) {

                        menu.classList.add('hidden');

                        button.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                        if (chevron) {

                            chevron.classList.remove(
                                'rotate-180'
                            );

                        }

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Close with Escape
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'keydown',
                function(event) {

                    if (event.key === 'Escape') {

                        menu.classList.add('hidden');

                        button.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                        if (chevron) {

                            chevron.classList.remove(
                                'rotate-180'
                            );

                        }

                    }

                }
            );

        });

        document.addEventListener('DOMContentLoaded', function() {

            /*
            |--------------------------------------------------------------------------
            | THREE-DOT MENUS
            |--------------------------------------------------------------------------
            */

            const menuButtons =
                document.querySelectorAll(
                    '.finance-action-menu'
                );

            const dropdowns =
                document.querySelectorAll(
                    '.finance-action-dropdown'
                );


            function closeAllMenus() {

                dropdowns.forEach(function(menu) {

                    menu.classList.add('hidden');

                });


                menuButtons.forEach(function(button) {

                    button.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                });

            }


            menuButtons.forEach(function(button) {

                button.addEventListener(
                    'click',
                    function(event) {

                        event.stopPropagation();

                        const targetId =
                            button.dataset.menuTarget;

                        const target =
                            document.getElementById(
                                targetId
                            );


                        if (!target) {
                            return;
                        }


                        const isHidden =
                            target.classList.contains(
                                'hidden'
                            );


                        closeAllMenus();


                        if (isHidden) {

                            target.classList.remove(
                                'hidden'
                            );

                            button.setAttribute(
                                'aria-expanded',
                                'true'
                            );

                        }

                    }
                );

            });


            /*
            |--------------------------------------------------------------------------
            | CLICK OUTSIDE
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'click',
                function() {

                    closeAllMenus();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | ESCAPE
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'keydown',
                function(event) {

                    if (event.key === 'Escape') {

                        closeAllMenus();

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | DELETE + SWEETALERT
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(
                    '.finance-delete-button'
                )
                .forEach(function(button) {

                    button.addEventListener(
                        'click',
                        function() {

                            const deleteUrl =
                                button.dataset.deleteUrl;

                            const voucher =
                                button.dataset.voucher;


                            closeAllMenus();


                            Swal.fire({

                                    title: 'Delete finance form?',

                                    html: `
                            <div class="text-sm text-gray-500">
                                You are about to delete
                                <span class="font-semibold text-gray-800">
                                    ${voucher}
                                </span>.
                                <br>
                                This action cannot be undone.
                            </div>
                            `,

                                    icon: 'warning',

                                    showCancelButton: true,

                                    confirmButtonText: 'Yes, delete it',

                                    cancelButtonText: 'Cancel',

                                    reverseButtons: true,

                                    focusCancel: true,

                                    buttonsStyling: false,

                                    customClass: {

                                        popup: 'rounded-2xl shadow-xl',

                                        title: 'text-lg font-bold text-gray-900',

                                        confirmButton: 'ml-2 rounded-xl bg-red-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-red-700',

                                        cancelButton: 'rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50',

                                    }

                                })
                                .then(function(result) {

                                    if (!result.isConfirmed) {
                                        return;
                                    }


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DELETE FORM
                                    |--------------------------------------------------------------------------
                                    */

                                    const form =
                                        document.createElement(
                                            'form'
                                        );

                                    form.method = 'POST';

                                    form.action =
                                        deleteUrl;

                                    form.style.display =
                                        'none';


                                    /*
                                    |--------------------------------------------------------------------------
                                    | CSRF
                                    |--------------------------------------------------------------------------
                                    */

                                    const csrf =
                                        document.querySelector(
                                            'meta[name="csrf-token"]'
                                        );


                                    if (csrf) {

                                        const token =
                                            document.createElement(
                                                'input'
                                            );

                                        token.type = 'hidden';

                                        token.name = '_token';

                                        token.value =
                                            csrf.getAttribute(
                                                'content'
                                            );

                                        form.appendChild(
                                            token
                                        );

                                    } else {

                                        const token =
                                            document.createElement(
                                                'input'
                                            );

                                        token.type = 'hidden';

                                        token.name = '_token';

                                        token.value =
                                            '{{ csrf_token() }}';

                                        form.appendChild(
                                            token
                                        );

                                    }


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DELETE METHOD
                                    |--------------------------------------------------------------------------
                                    */

                                    const method =
                                        document.createElement(
                                            'input'
                                        );

                                    method.type =
                                        'hidden';

                                    method.name =
                                        '_method';

                                    method.value =
                                        'DELETE';

                                    form.appendChild(
                                        method
                                    );


                                    document.body.appendChild(
                                        form
                                    );


                                    Swal.fire({

                                        title: 'Deleting...',

                                        text: 'Please wait.',

                                        allowOutsideClick: false,

                                        allowEscapeKey: false,

                                        showConfirmButton: false,

                                        didOpen: function() {

                                            Swal.showLoading();

                                        }

                                    });


                                    form.submit();

                                });

                        }

                    );

                });

        });
    </script>
@endsection
