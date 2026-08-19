@extends('layout.app')

@section('content')
    <div class="min-h-screen">

        <div class="mx-auto max-w-full">

            <div class="mb-5">

                <div
                    class="relative overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-[0_8px_30px_rgba(15,23,42,0.06)]">

                    <div
                        class="pointer-events-none absolute -right-16 -top-20 h-56 w-56 rounded-full bg-emerald-100/60 blur-3xl">
                    </div>

                    <div
                        class="pointer-events-none absolute -bottom-20 -left-16 h-48 w-48 rounded-full bg-emerald-50/80 blur-3xl">
                    </div>

                    <div class="relative px-5 py-6 sm:px-7 sm:py-7">

                        <div class="flex flex-col gap-6 xl:flex-row xl:items-center xl:justify-between">

                            <div class="min-w-0">

                                {{-- Breadcrumb --}}
                                <div class="mb-4 flex flex-wrap items-center gap-2 text-xs font-medium">

                                    <a href="{{ route('finance-forms.index') }}"
                                        class="text-gray-400 transition hover:text-emerald-600">
                                        Finance Forms
                                    </a>

                                    <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m9 18 6-6-6-6" />
                                    </svg>

                                    <span class="text-gray-500">
                                        View
                                    </span>

                                </div>


                                {{-- Title row --}}
                                <div class="flex items-start gap-4">

                                    {{-- Transaction icon --}}
                                    <div
                                        class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100 sm:flex">

                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                                d="M7.5 4.5h9A1.5 1.5 0 0 1 18 6v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 6 18V6a1.5 1.5 0 0 1 1.5-1.5ZM9 8h6M9 12h6M9 16h3" />
                                        </svg>

                                    </div>


                                    <div class="min-w-0">

                                        <div class="flex flex-wrap items-center gap-3">

                                            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                                {{ $financeForm->transaction_type_label }}
                                            </h1>


                                            {{-- Status --}}
                                            @php
                                                $statusConfig = match ($financeForm->status) {
                                                    'completed' => [
                                                        'bg' => 'bg-emerald-50',
                                                        'text' => 'text-emerald-700',
                                                        'border' => 'border-emerald-200',
                                                        'dot' => 'bg-emerald-500',
                                                    ],

                                                    'cancelled' => [
                                                        'bg' => 'bg-red-50',
                                                        'text' => 'text-red-700',
                                                        'border' => 'border-red-200',
                                                        'dot' => 'bg-red-500',
                                                    ],

                                                    default => [
                                                        'bg' => 'bg-amber-50',
                                                        'text' => 'text-amber-700',
                                                        'border' => 'border-amber-200',
                                                        'dot' => 'bg-amber-500',
                                                    ],
                                                };
                                            @endphp


                                            <span
                                                class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-[11px] font-bold uppercase tracking-wide
                                    {{ $statusConfig['bg'] }}
                                    {{ $statusConfig['text'] }}
                                    {{ $statusConfig['border'] }}">

                                                <span class="h-1.5 w-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>

                                                {{ ucfirst($financeForm->status) }}

                                            </span>

                                        </div>


                                        <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                                            Review the finance form, transaction details, and accounting entries.
                                        </p>


                                        {{-- Document identity --}}
                                        <div class="mt-4 flex flex-wrap items-center gap-2">

                                            {{-- Date --}}
                                            <div
                                                class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2">

                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                                        d="M7 3.5v3M17 3.5v3M4.5 9h15M6.5 5.5h11A1.5 1.5 0 0 1 19 7v11A1.5 1.5 0 0 1 17.5 19.5h-11A1.5 1.5 0 0 1 5 18V7a1.5 1.5 0 0 1 1.5-1.5Z" />
                                                </svg>

                                                <span
                                                    class="text-[11px] font-semibold uppercase tracking-wide text-gray-400">
                                                    Date
                                                </span>

                                                <span class="text-xs font-bold text-gray-700">
                                                    {{ optional($financeForm->voucher_date)->format('d M Y') }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="flex flex-wrap items-center gap-2 xl:justify-end">

                                {{-- Edit --}}
                                <a href="{{ route('finance-forms.edit', $financeForm) }}"
                                    class="group inline-flex items-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-sm font-semibold text-amber-700 shadow-sm transition hover:border-amber-300 hover:bg-amber-100 hover:shadow">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:-translate-y-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M13.5 5.5 18.5 10.5M5 19l3.75-.75L19.25 7.75a1.768 1.768 0 0 0-2.5-2.5L6.25 15l-.75 4Z" />
                                    </svg>

                                    Edit

                                </a>


                                {{-- PDF --}}
                                <a href="{{ route('finance-forms.pdf', $financeForm) }}" target="_blank"
                                    class="group inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:border-emerald-200 hover:bg-green-700 hover:shadow">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-y-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M12 16V4m0 12 4-4m-4 4-4-4M5 20h14" />
                                    </svg>

                                    PDF

                                </a>


                                {{-- Back --}}
                                <a href="{{ route('finance-forms.index') }}"
                                    class="group inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 hover:shadow">

                                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:-translate-x-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M15 18 9 12l6-6" />
                                    </svg>

                                    Back

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="mb-5 rounded-3xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-200 px-6 py-5 bg-green-600 rounded-t-3xl">

                    <h2 class="text-base font-bold text-white">
                        General Information
                    </h2>

                    <p class="mt-1 text-sm text-gray-200">
                        Basic information about this transaction.
                    </p>

                </div>

                <div class="overflow-hidden bg-white">

                    <div
                        class="grid grid-cols-1 divide-y divide-gray-100 md:grid-cols-2 md:divide-x md:divide-y-0 lg:grid-cols-4">

                        <div class="group relative px-6 py-5 transition hover:bg-emerald-50/30">

                            {{-- Accent --}}
                            <div
                                class="absolute inset-y-0 left-0 w-1 bg-emerald-500 opacity-0 transition group-hover:opacity-100">
                            </div>


                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M7 4.5h10A1.5 1.5 0 0 1 18.5 6v12A1.5 1.5 0 0 1 17 19.5H7A1.5 1.5 0 0 1 5.5 18V6A1.5 1.5 0 0 1 7 4.5ZM9 8h6M9 12h4M9 16h3" />
                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-gray-400">
                                        Voucher No.
                                    </p>


                                    <p class="mt-1.5 truncate text-sm font-bold text-gray-900"
                                        title="{{ $financeForm->voucher_no ?: '—' }}">
                                        {{ $financeForm->voucher_no ?: '—' }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="group relative px-6 py-5 transition hover:bg-blue-50/30">

                            <div
                                class="absolute inset-y-0 left-0 w-1 bg-blue-500 opacity-0 transition group-hover:opacity-100">
                            </div>


                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 ring-1 ring-blue-100">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M7 3.5v3M17 3.5v3M4.5 9h15M6.5 5.5h11A1.5 1.5 0 0 1 19 7v11A1.5 1.5 0 0 1 17.5 19.5h-11A1.5 1.5 0 0 1 5 18V7a1.5 1.5 0 0 1 1.5-1.5Z" />
                                    </svg>

                                </div>


                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-gray-400">
                                        Voucher Date
                                    </p>


                                    <p class="mt-1.5 text-sm font-bold text-gray-800">
                                        {{ $financeForm->voucher_date?->format('d M Y') ?? '—' }}
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="group relative px-6 py-5 transition hover:bg-violet-50/30">

                            <div
                                class="absolute inset-y-0 left-0 w-1 bg-violet-500 opacity-0 transition group-hover:opacity-100">
                            </div>


                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M16 19v-1.5a3.5 3.5 0 0 0-3.5-3.5h-3A3.5 3.5 0 0 0 6 17.5V19m5-7a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-2.5h3.5M18 7.5h3.5" />
                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-gray-400">
                                        Received From / Pay To
                                    </p>


                                    <p class="mt-1.5 truncate text-sm font-bold text-gray-800"
                                        title="{{ $financeForm->received_from ?: '—' }}">
                                        {{ $financeForm->received_from ?: '—' }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="relative overflow-hidden bg-emerald-50/50 px-6 py-5">

                            {{-- Decorative circle --}}
                            <div
                                class="pointer-events-none absolute -right-5 -top-8 h-24 w-24 rounded-full bg-emerald-100/70">
                            </div>


                            <div class="relative flex items-start gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm shadow-emerald-600/20">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M12 4v16m4-12h-3.5a2 2 0 0 0 0 4h3a2 2 0 0 1 0 4H8" />
                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-emerald-600">
                                        Total Amount
                                    </p>


                                    <p class="mt-1 text-2xl font-extrabold tracking-tight tabular-nums text-gray-900">
                                        ${{ number_format((float) $financeForm->amount, 2) }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                @if ($financeForm->amount_in_words)
                    <div class="border-t border-gray-100 bg-gray-50/50 px-6 py-5 sm:px-7">

                        <div class="flex items-start gap-4">

                            {{-- Icon --}}
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M5 6.5h14M5 10.5h14M5 14.5h8M5 18.5h5" />
                                </svg>

                            </div>


                            {{-- Content --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-center gap-2">

                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-emerald-600">
                                        Amount in Words
                                    </p>

                                    <span
                                        class="rounded-full bg-white px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-gray-400 ring-1 ring-gray-200">
                                        Written Amount
                                    </span>

                                </div>


                                <p class="mt-2 text-sm font-semibold leading-6 text-gray-800 sm:text-[15px]">
                                    {{ $financeForm->amount_in_words }}
                                </p>

                            </div>

                        </div>

                    </div>
                @endif

            </div>


            <div
                class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-[0_8px_30px_rgba(15,23,42,0.06)]">

                <div
                    class="border-b border-gray-200 bg-gradient-to-r from-white via-white to-emerald-50/40 px-6 py-5 sm:px-7">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        {{-- Left --}}
                        <div class="flex items-start gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M5 6.5h14M5 10.5h14M5 14.5h14M5 18.5h8" />
                                </svg>

                            </div>


                            <div>

                                <div class="flex flex-wrap items-center gap-2">

                                    <h2 class="text-base font-bold text-gray-900 sm:text-lg">
                                        Accounting Entries
                                    </h2>


                                    <span
                                        class="inline-flex items-center rounded-full border border-emerald-100 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700">
                                        Ledger
                                    </span>

                                </div>


                                <p class="mt-1 text-sm leading-5 text-gray-500">
                                    Accounting lines recorded for this transaction.
                                </p>

                            </div>

                        </div>


                        {{-- Entry count --}}
                        <div
                            class="inline-flex w-fit items-center gap-2 rounded-xl border border-gray-200 bg-white px-3.5 py-2 shadow-sm">

                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                            <span class="text-xs font-bold text-gray-900">
                                {{ $financeForm->items->count() }}
                            </span>

                            <span class="text-xs font-medium text-gray-500">
                                {{ $financeForm->items->count() === 1 ? 'Entry' : 'Entries' }}
                            </span>

                        </div>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-[1200px] w-full">

                        <thead>

                            <tr class="border-b border-emerald-100 bg-emerald-50/80">

                                <th
                                    class="w-14 px-5 py-4 text-left text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-600">
                                    #
                                </th>


                                <th
                                    class="whitespace-nowrap px-5 py-4 text-left text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-600">
                                    Date
                                </th>


                                <th
                                    class="whitespace-nowrap px-5 py-4 text-left text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-600">
                                    Line Type
                                </th>


                                <th
                                    class="min-w-[260px] px-5 py-4 text-left text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-600">
                                    Description
                                </th>


                                <th
                                    class="whitespace-nowrap px-5 py-4 text-left text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-600">
                                    Account Code
                                </th>


                                <th
                                    class="whitespace-nowrap px-5 py-4 text-left text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-600">
                                    Donor
                                </th>


                                <th
                                    class="whitespace-nowrap px-5 py-4 text-right text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-600">
                                    Amount
                                </th>


                                <th
                                    class="whitespace-nowrap px-5 py-4 text-right text-[10px] font-extrabold uppercase tracking-[0.14em] text-emerald-700">
                                    Debit
                                </th>


                                <th
                                    class="whitespace-nowrap px-5 py-4 text-right text-[10px] font-extrabold uppercase tracking-[0.14em] text-red-700">
                                    Credit
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100 bg-white">

                            @forelse ($financeForm->items as $item)
                                <tr class="group transition-colors duration-150 hover:bg-emerald-50/25">

                                    {{-- # --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-flex h-7 min-w-7 items-center justify-center rounded-lg bg-gray-100 px-2 text-xs font-bold tabular-nums text-gray-500 transition group-hover:bg-emerald-100 group-hover:text-emerald-700">
                                            {{ $loop->iteration }}
                                        </span>

                                    </td>


                                    {{-- Date --}}
                                    <td class="whitespace-nowrap px-5 py-4">

                                        <div class="flex items-center gap-2">

                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $item->date?->format('d M Y') ?? '—' }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- Line Type --}}
                                    <td class="px-5 py-4">

                                        @php
                                            $lineTypeConfig = match ($item->line_type) {
                                                'income' => [
                                                    'bg' => 'bg-emerald-50',
                                                    'text' => 'text-emerald-700',
                                                    'border' => 'border-emerald-100',
                                                ],

                                                'expense' => [
                                                    'bg' => 'bg-orange-50',
                                                    'text' => 'text-orange-700',
                                                    'border' => 'border-orange-100',
                                                ],

                                                'advance' => [
                                                    'bg' => 'bg-amber-50',
                                                    'text' => 'text-amber-700',
                                                    'border' => 'border-amber-100',
                                                ],

                                                'settlement' => [
                                                    'bg' => 'bg-violet-50',
                                                    'text' => 'text-violet-700',
                                                    'border' => 'border-violet-100',
                                                ],

                                                'payable' => [
                                                    'bg' => 'bg-blue-50',
                                                    'text' => 'text-blue-700',
                                                    'border' => 'border-blue-100',
                                                ],

                                                'bank' => [
                                                    'bg' => 'bg-cyan-50',
                                                    'text' => 'text-cyan-700',
                                                    'border' => 'border-cyan-100',
                                                ],

                                                'tax' => [
                                                    'bg' => 'bg-rose-50',
                                                    'text' => 'text-rose-700',
                                                    'border' => 'border-rose-100',
                                                ],

                                                default => [
                                                    'bg' => 'bg-gray-100',
                                                    'text' => 'text-gray-700',
                                                    'border' => 'border-gray-200',
                                                ],
                                            };
                                        @endphp


                                        <span
                                            class="inline-flex rounded-lg border px-2.5 py-1.5 text-[11px] font-bold
                                                {{ $lineTypeConfig['bg'] }}
                                                {{ $lineTypeConfig['text'] }}
                                                {{ $lineTypeConfig['border'] }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->line_type)) }}
                                        </span>

                                    </td>


                                    {{-- Description --}}
                                    <td class="px-5 py-4">

                                        <div class="max-w-[330px]">

                                            <p class="truncate text-sm font-semibold text-gray-800"
                                                title="{{ $item->description ?: '' }}">
                                                {{ $item->description ?: ' ' }}
                                            </p>

                                        </div>

                                    </td>


                                    {{-- Account Code --}}
                                    <td class="px-5 py-4">

                                        @if ($item->account_code)
                                            <span
                                                class="inline-flex rounded-lg border border-gray-200 bg-gray-50 px-2.5 py-1.5 font-mono text-xs font-semibold text-gray-700">
                                                {{ $item->account_code }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-300">

                                            </span>
                                        @endif

                                    </td>


                                    {{-- Donor --}}
                                    <td class="px-5 py-4">

                                        <span class="block max-w-[180px] truncate text-sm font-medium text-gray-700"
                                            title="{{ $item->donor ?: '' }}">
                                            {{ $item->donor ?: ' ' }}
                                        </span>

                                    </td>


                                    {{-- Amount --}}
                                    <td class="whitespace-nowrap px-5 py-4 text-right">

                                        @php
                                            $amount = (float) $item->amount;
                                        @endphp

                                        <span
                                            class="text-sm font-bold">
                                            @if ($amount < 0)
                                                ({{ number_format(abs($amount), 2) }})
                                            @else
                                                {{ number_format($amount, 2) }}
                                            @endif
                                        </span>

                                    </td>


                                    {{-- Debit --}}
                                    <td class="whitespace-nowrap px-5 py-4 text-right">

                                        @if ((float) $item->debit > 0)
                                            <span
                                                class="inline-flex min-w-[90px] justify-end rounded-lg px-2.5 py-1.5 text-sm font-extrabold tabular-nums text-emerald-700">
                                                {{ number_format((float) $item->debit, 2) }}
                                            </span>
                                        @else
                                            <span class="text-sm font-medium tabular-nums text-gray-300">

                                            </span>
                                        @endif

                                    </td>


                                    {{-- Credit --}}
                                    <td class="whitespace-nowrap px-5 py-4 text-right">

                                        @if ((float) $item->credit > 0)
                                            <span
                                                class="inline-flex min-w-[90px] justify-end rounded-lg px-2.5 py-1.5 text-sm font-extrabold tabular-nums text-red-700">
                                                {{ number_format((float) $item->credit, 2) }}
                                            </span>
                                        @else
                                            <span class="text-sm font-medium tabular-nums text-gray-300">

                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                {{-- ================================================== --}}
                                {{-- EMPTY STATE --}}
                                {{-- ================================================== --}}

                                <tr>

                                    <td colspan="9" class="px-6 py-20 text-center">

                                        <div class="flex flex-col items-center justify-center">

                                            <div
                                                class="flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50">

                                                <div
                                                    class="flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">

                                                    <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.6"
                                                            d="M7 4.5h10A1.5 1.5 0 0 1 18.5 6v12A1.5 1.5 0 0 1 17 19.5H7A1.5 1.5 0 0 1 5.5 18V6A1.5 1.5 0 0 1 7 4.5ZM9 8h6M9 12h6M9 16h3" />
                                                    </svg>

                                                </div>

                                            </div>


                                            <h3 class="mt-5 text-sm font-bold text-gray-800">
                                                No Accounting Entries
                                            </h3>


                                            <p class="mt-1 max-w-sm text-sm leading-6 text-gray-400">
                                                There are no accounting lines recorded for this finance transaction.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>


                        {{-- ================================================== --}}
                        {{-- TOTAL --}}
                        {{-- ================================================== --}}

                        @if ($financeForm->items->count())
                            <tfoot>

                                <tr class="border-t-2 border-gray-200 bg-gray-50/80">

                                    {{-- Label --}}
                                    <td colspan="6" class="px-5 py-5 text-right">

                                        <div class="flex items-center justify-end gap-3">

                                            <span class="text-xs font-bold uppercase tracking-[0.12em] text-gray-800">
                                                Total
                                            </span>

                                            <span class="h-px w-8 bg-gray-300"></span>

                                        </div>

                                    </td>


                                    {{-- Amount --}}
                                    <td class="px-5 py-5 text-right">

                                        <span class="text-sm font-extrabold tabular-nums text-gray-900">
                                            {{ number_format((float) $financeForm->amount, 2) }}
                                        </span>

                                    </td>


                                    {{-- Debit --}}
                                    <td class="px-5 py-5 text-right">

                                        <span
                                            class="inline-flex min-w-[100px] justify-end rounded-lg px-3 py-2 text-sm font-extrabold tabular-nums text-emerald-700">
                                            {{ number_format($financeForm->items->sum('debit'), 2) }}
                                        </span>

                                    </td>


                                    {{-- Credit --}}
                                    <td class="px-5 py-5 text-right">

                                        <span
                                            class="inline-flex min-w-[100px] justify-end rounded-lg px-3 py-2 text-sm font-extrabold tabular-nums text-red-700">
                                            {{ number_format($financeForm->items->sum('credit'), 2) }}
                                        </span>

                                    </td>

                                </tr>

                            </tfoot>
                        @endif

                    </table>

                </div>


                @if ($financeForm->items->count())
                    @php
                        $totalDebit = (float) $financeForm->items->sum('debit');
                        $totalCredit = (float) $financeForm->items->sum('credit');
                        $isBalanced = abs($totalDebit - $totalCredit) < 0.01;
                    @endphp

                    <div
                        class="flex flex-col gap-3 border-t border-gray-200 bg-white px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                        <div class="text-xs text-gray-400">
                            {{ $financeForm->items->count() }}
                            {{ $financeForm->items->count() === 1 ? 'accounting entry' : 'accounting entries' }}
                            recorded
                        </div>


                        <div
                            class="inline-flex w-fit items-center gap-2 rounded-xl border px-3 py-2
                                {{ $isBalanced
                                    ? 'border-emerald-200 bg-emerald-50 text-emerald-700'
                                    : 'border-amber-200 bg-amber-50 text-amber-700' }}">

                            <span
                                class="h-2 w-2 rounded-full
                                     {{ $isBalanced ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>


                            <span class="text-xs font-bold">
                                {{ $isBalanced ? 'Balanced Entry' : 'Review Debit / Credit Balance' }}
                            </span>

                        </div>

                    </div>
                @endif

            </div>

        </div>

    </div>
@endsection
