@extends('layout.app')

@section('content')

    <div class="min-h-screen">

        <div class="mx-auto max-w-full">

            <div class="mb-5 p-6 bg-green-600 rounded-lg">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <div class="mb-2 flex items-center gap-2 text-sm text-gray-200">

                            <a href="{{ route('finance-forms.index') }}" class="transition hover:text-emerald-600">
                                Finance Forms
                            </a>

                            <span>/</span>

                            <span>
                                Edit
                            </span>

                        </div>


                        <h1 class="text-2xl font-bold tracking-tight text-white">
                            {{ $title }}
                        </h1>


                        <p class="mt-1 text-sm text-gray-200">
                            Update the finance form and its accounting entries.
                        </p>

                    </div>


                    <div class="flex items-center gap-2">

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


            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

                    <div class="flex items-start gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3.5m0 3h.01M10.5 3.75h3L21 18.25A1.5 1.5 0 0 1 19.7 20.5H4.3A1.5 1.5 0 0 1 3 18.25L10.5 3.75Z" />
                            </svg>

                        </div>


                        <div>

                            <p class="font-bold text-red-800">
                                Please correct the following errors.
                            </p>


                            <ul class="mt-2 list-disc pl-5 text-sm text-red-700">

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

            <form id="financeForm" action="{{ route('finance-forms.update', $financeForm) }}" method="POST"
                data-calculation-type="{{ $calculationType }}" class="space-y-6">

                @csrf

                @method('PUT')


                {{-- Transaction type --}}
                <input type="hidden" name="transaction_type" value="{{ $transactionType }}">

                @php
                    $currentVoucherNo = old('voucher_no', $financeForm->voucher_no);

                    $currentVoucherDate = old('voucher_date', $financeForm->voucher_date?->format('Y-m-d'));

                    $currentReceivedFrom = old('received_from', $financeForm->received_from);

                    $currentAmountWords = old('amount_in_words', $financeForm->amount_in_words);
                @endphp


                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

                    <div class="mb-6 bg-green-600 p-6 rounded-t-xl">

                        <h2 class="text-base font-bold text-white">
                            General Information
                        </h2>

                        <p class="mt-1 text-sm text-gray-200">
                            Update the basic information for this transaction.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4 p-6">


                        {{-- Voucher --}}
                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                                Voucher No.
                            </label>

                            <input type="text" name="voucher_no" value="{{ $currentVoucherNo }}"
                                class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                        </div>


                        {{-- Date --}}
                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                                Voucher Date
                                <span class="text-red-500">*</span>
                            </label>

                            <input type="date" name="voucher_date" value="{{ $currentVoucherDate }}" required
                                class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                        </div>


                        {{-- Received From --}}
                        <div class="lg:col-span-2">

                            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                                Received From / Pay To
                            </label>

                            <input type="text" name="received_from" value="{{ $currentReceivedFrom }}"
                                placeholder="Person, supplier, donor or organization"
                                class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                        </div>


                        {{-- Amount --}}
                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                                The Amount
                            </label>

                            <input id="mainAmount" type="number" name="amount"
                                value="{{ number_format((float) $financeForm->amount, 2, '.', '') }}" readonly
                                class="w-full rounded-xl border-gray-300 bg-gray-50 text-sm font-bold text-gray-900 shadow-sm">

                            <p class="mt-1 text-xs text-gray-400">
                                Automatically recalculated.
                            </p>

                        </div>


                        {{-- Words --}}
                        <div class="lg:col-span-3">

                            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                                In Word
                            </label>

                            <input id="amountInWords" type="text" name="amount_in_words"
                                value="{{ $currentAmountWords }}" readonly
                                class="w-full rounded-xl border-gray-300 bg-gray-50 text-sm shadow-sm">

                        </div>

                    </div>

                </div>


                @if ($calculationType === 'disbursement')
                    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

                        <div class="mb-5">

                            <h2 class="text-base font-bold text-gray-900">
                                Disbursement Calculation
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Advance and expense comparison.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                            <div class="rounded-2xl bg-gray-50 p-5">

                                <p class="text-xs font-bold uppercase tracking-wide text-gray-500">
                                    Cash Advance
                                </p>

                                <p id="advanceDisplay" class="mt-2 text-2xl font-bold text-gray-900">
                                    0.00
                                </p>

                            </div>


                            <div class="rounded-2xl bg-gray-50 p-5">

                                <p class="text-xs font-bold uppercase tracking-wide text-gray-500">
                                    Actual Expense
                                </p>

                                <p id="expenseDisplay" class="mt-2 text-2xl font-bold text-gray-900">
                                    0.00
                                </p>

                            </div>


                            <div class="rounded-2xl bg-emerald-50 p-5">

                                <p class="text-xs font-bold uppercase tracking-wide text-emerald-600">
                                    Refund
                                </p>

                                <p id="refundDisplay" class="mt-2 text-2xl font-bold text-emerald-700">
                                    0.00
                                </p>

                            </div>


                            <div class="rounded-2xl bg-blue-50 p-5">

                                <p class="text-xs font-bold uppercase tracking-wide text-blue-600">
                                    Additional Disbursement
                                </p>

                                <p id="disbursementDisplay" class="mt-2 text-2xl font-bold text-blue-700">
                                    0.00
                                </p>

                            </div>

                        </div>


                        <div class="mt-4 rounded-xl bg-gray-50 px-4 py-3">

                            <span class="text-sm font-medium text-gray-500">
                                Difference:
                            </span>

                            <span id="differenceDisplay" class="ml-2 text-sm font-bold text-gray-900">
                                0.00
                            </span>

                        </div>

                    </div>
                @endif


                @if ($calculationType === 'cash_advance_settlement')
                    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

                        <div class="mb-5">

                            <h2 class="text-base font-bold text-gray-900">
                                Cash Advance Settlement
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Review the advance, expense and resulting refund or additional payment.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                            <div class="rounded-2xl bg-gray-50 p-5">

                                <p class="text-xs font-bold uppercase tracking-wide text-gray-500">
                                    Total Advance
                                </p>

                                <p id="advanceDisplay" class="mt-2 text-2xl font-bold text-gray-900">
                                    0.00
                                </p>

                            </div>


                            <div class="rounded-2xl bg-gray-50 p-5">

                                <p class="text-xs font-bold uppercase tracking-wide text-gray-500">
                                    Actual Expense
                                </p>

                                <p id="expenseDisplay" class="mt-2 text-2xl font-bold text-gray-900">
                                    0.00
                                </p>

                            </div>


                            <div class="rounded-2xl bg-emerald-50 p-5">

                                <p class="text-xs font-bold uppercase tracking-wide text-emerald-600">
                                    Refund
                                </p>

                                <p id="refundDisplay" class="mt-2 text-2xl font-bold text-emerald-700">
                                    0.00
                                </p>

                            </div>


                            <div class="rounded-2xl bg-blue-50 p-5">

                                <p class="text-xs font-bold uppercase tracking-wide text-blue-600">
                                    Additional Disbursement
                                </p>

                                <p id="disbursementDisplay" class="mt-2 text-2xl font-bold text-blue-700">
                                    0.00
                                </p>

                            </div>

                        </div>


                        <div class="mt-4 rounded-xl bg-gray-50 px-4 py-3">

                            <span class="text-sm font-medium text-gray-500">
                                Difference:
                            </span>

                            <span id="differenceDisplay" class="ml-2 text-sm font-bold text-gray-900">
                                0.00
                            </span>

                        </div>

                    </div>
                @endif

                @include('finance-forms.partials.sheet-accounting-items')

                <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">

                    <a href="{{ route('finance-forms.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                        Cancel
                    </a>


                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6" />
                        </svg>

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

    @include('finance-forms.partials.sheet-accounting-script')

@endsection
