<div class="rounded-xl border border-gray-200 bg-white shadow-sm">

    <div class="bg-green-600 p-6 rounded-t-xl">

        <h2 class="text-lg font-bold text-white">
            General Information
        </h2>

        <p class="mt-1 text-sm text-gray-200">
            Enter the basic information for this transaction.
        </p>

    </div>


    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4 p-6">

        {{-- Voucher No --}}
        <div>

            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                Voucher No.
            </label>

            <input type="text" name="voucher_no" value="{{ old('voucher_no') }}" placeholder="Optional"
                class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

        </div>


        {{-- Voucher Date --}}
        <div>

            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                Voucher Date
                <span class="text-red-500">*</span>
            </label>

            <input type="date" name="voucher_date" value="{{ old('voucher_date', now()->format('Y-m-d')) }}" required
                class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

        </div>


        {{-- Received From / Pay To --}}
        <div class="lg:col-span-2">

            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                Received From / Pay To
            </label>

            <input type="text" name="received_from" value="{{ old('received_from') }}"
                placeholder="Person, supplier, donor or organization"
                class="w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

        </div>


        {{-- Amount --}}
        <div>

            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                The Amount
            </label>

            <div class="relative">

                <input id="mainAmount" type="number" name="amount" value="{{ old('amount', '0.00') }}" min="0"
                    step="0.01" readonly
                    class="w-full rounded-xl border-gray-300 bg-gray-50 text-sm font-bold text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            </div>

            <p class="mt-1 text-xs text-gray-500">
                Automatically calculated from the accounting entries.
            </p>

        </div>


        {{-- Amount In Words --}}
        <div class="lg:col-span-3">

            <label class="mb-1.5 block text-sm font-semibold text-gray-700">
                In Word
            </label>

            <input id="amountInWords" type="text" name="amount_in_words" value="{{ old('amount_in_words') }}"
                readonly placeholder="Automatically generated"
                class="w-full rounded-xl border-gray-300 bg-gray-50 text-sm font-medium shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

        </div>

    </div>

</div>
