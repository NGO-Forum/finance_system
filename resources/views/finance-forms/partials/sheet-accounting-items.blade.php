<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

    <div class="border-b border-gray-200 bg-green-600 px-6 py-5">

        <div>

            <h2 class="text-base font-bold text-white">
                Accounting Entries
            </h2>

            <p class="mt-1 text-sm text-gray-200">
                Enter positive amounts for Debit and negative amounts for Credit.
            </p>

        </div>

    </div>


    <div id="itemsBody" class="space-y-4 p-6">

        @foreach ($initialRows as $index => $initialRow)
            @php
                $oldItem = old("items.$index", []);

                $lineType = old("items.$index.line_type", $initialRow['line_type'] ?? '');

                $description = old("items.$index.description", $initialRow['description'] ?? '');

                $date = old("items.$index.date", $initialRow['date'] ?? now()->format('Y-m-d'));
                
                $accountCode = old("items.$index.account_code", $initialRow['account_code'] ?? '');

                $donor = old("items.$index.donor", $initialRow['donor'] ?? '');

                $amount = old("items.$index.amount", $initialRow['amount'] ?? '');
            @endphp


            <div class="item-row rounded-2xl border border-gray-200 bg-gray-50 p-5" data-index="{{ $index }}">

                <div class="mb-5 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <span
                            class="row-number flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-sm font-bold text-emerald-700">
                            {{ $index + 1 }}
                        </span>

                        <div>

                            <p class="text-sm font-bold text-green-700 mb-1">
                                Accounting Entry
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $description ?: 'Transaction line' }}
                            </p>

                        </div>

                    </div>


                    {{-- REMOVE --}}
                    <button type="button"
                        class="remove-row rounded-lg p-2 text-red-500 transition hover:bg-red-50 hover:text-red-600"
                        title="Remove entry">

                        <i class="fas fa-trash"></i>

                    </button>

                </div>


                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-9">

                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                            Date
                        </label>

                        <input type="date" name="items[{{ $index }}][date]" value="{{ $date }}"
                            required
                            class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                    </div>


                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                            Line Type
                        </label>

                        <select name="items[{{ $index }}][line_type]"
                            class="item-line-type w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                            @foreach ($lineTypes as $value => $label)
                                <option value="{{ $value }}" @selected($lineType === $value)>
                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <div class="lg:col-span-2">

                        <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                            Description
                        </label>

                        <input type="text" name="items[{{ $index }}][description]" value="{{ $description }}"
                            placeholder="Description"
                            class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                    </div>


                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                            Account Code
                        </label>

                        <input type="text" name="items[{{ $index }}][account_code]"
                            value="{{ $accountCode }}" placeholder="Account Code"
                            class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                    </div>


                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                            Donor
                        </label>

                        <input type="text" name="items[{{ $index }}][donor]" value="{{ $donor }}"
                            placeholder="Donor"
                            class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                    </div>


                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                            Amount
                        </label>

                        <input type="number" step="0.01" name="items[{{ $index }}][amount]"
                            value="{{ $amount }}" placeholder="Amount" required
                            class="item-amount w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                    </div>


                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                            Debit
                        </label>

                        <div
                            class="item-debit-preview flex min-h-[42px] items-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-semibold text-emerald-700">
                            0.00
                        </div>

                    </div>


                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                            Credit
                        </label>

                        <div
                            class="item-credit-preview flex min-h-[42px] items-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-semibold text-blue-700">
                            0.00
                        </div>

                    </div>

                </div>

            </div>
        @endforeach

    </div>


    <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">

        <button type="button" id="addItem"
            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 sm:w-auto">

            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

            </svg>

            Add Accounting Entry

        </button>

    </div>



    <div class="border-t border-gray-200 bg-white p-6">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            <div class="rounded-2xl bg-gray-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-bold uppercase tracking-wide text-gray-500">
                        Total Amount
                    </p>

                    <span class="rounded-lg bg-white px-2 py-1 text-xs font-semibold text-gray-500">
                        Amount
                    </span>

                </div>

                <p id="totalAmount" class="mt-2 text-2xl font-bold text-gray-900">
                    0.00
                </p>

            </div>


            <div class="rounded-2xl bg-emerald-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-bold uppercase tracking-wide text-emerald-600">
                        Total Debit
                    </p>

                    <span class="rounded-lg bg-white px-2 py-1 text-xs font-semibold text-emerald-600">
                        Debit
                    </span>

                </div>

                <p id="totalDebit" class="mt-2 text-2xl font-bold text-emerald-700">
                    0.00
                </p>

            </div>


            <div class="rounded-2xl bg-blue-50 p-5">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-bold uppercase tracking-wide text-blue-600">
                        Total Credit
                    </p>

                    <span class="rounded-lg bg-white px-2 py-1 text-xs font-semibold text-blue-600">
                        Credit
                    </span>

                </div>

                <p id="totalCredit" class="mt-2 text-2xl font-bold text-blue-700">
                    0.00
                </p>

            </div>

        </div>


        <div id="balanceStatus" class="mt-4 rounded-xl bg-gray-100 px-4 py-3 text-sm font-semibold text-gray-500">
            Add accounting entries.
        </div>

    </div>

</div>


<template id="itemTemplate">

    <div class="item-row rounded-2xl border border-gray-200 bg-gray-50 p-5" data-index="__INDEX__">

        <div class="mb-5 flex items-center justify-between">

            <div class="flex items-center gap-3">

                <span
                    class="row-number flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-sm font-bold text-emerald-700">
                    1
                </span>

                <div>

                    <p class="text-sm font-bold text-green-700">
                        Accounting Entry
                    </p>

                    <p class="text-xs text-gray-500">
                        Transaction line
                    </p>

                </div>

            </div>


            <button type="button"
                class="remove-row rounded-lg p-2 text-red-500 transition hover:bg-red-50 hover:text-red-600"
                title="Remove entry">

                <i class="fas fa-trash"></i>

            </button>

        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-9">


            {{-- DATE --}}
            <div>

                <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                    Date
                </label>

                <input type="date" name="items[__INDEX__][date]" value="{{ now()->format('Y-m-d') }}" required
                    class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            </div>


            {{-- LINE TYPE --}}
            <div>

                <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                    Line Type
                </label>

                <select name="items[__INDEX__][line_type]"
                    class="item-line-type w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                    @foreach ($lineTypes as $value => $label)
                        <option value="{{ $value }}">
                            {{ $label }}
                        </option>
                    @endforeach

                </select>

            </div>


            {{-- DESCRIPTION --}}
            <div class="col-span-2">

                <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                    Description
                </label>

                <input type="text" name="items[__INDEX__][description]" placeholder="Description"
                    class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            </div>


            {{-- ACCOUNT CODE --}}
            <div>

                <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                    Account Code
                </label>

                <input type="text" name="items[__INDEX__][account_code]" placeholder="Account Code"
                    class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            </div>


            {{-- DONOR --}}
            <div>

                <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                    Donor
                </label>

                <input type="text" name="items[__INDEX__][donor]" placeholder="Donor"
                    class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            </div>


            {{-- AMOUNT --}}
            <div>

                <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                    Amount
                </label>

                <input type="number" step="0.01" name="items[__INDEX__][amount]"
                    placeholder="Amount" required
                    class="item-amount w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            </div>


            {{-- DEBIT --}}
            <div>

                <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                    Debit
                </label>

                <div
                    class="item-debit-preview flex min-h-[42px] items-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-semibold text-emerald-700">
                    0.00
                </div>

            </div>


            {{-- CREDIT --}}
            <div>

                <label class="mb-1.5 block text-xs font-semibold text-gray-600">
                    Credit
                </label>

                <div
                    class="item-credit-preview flex min-h-[42px] items-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-semibold text-blue-700">
                    0.00
                </div>

            </div>

        </div>

    </div>

</template>
