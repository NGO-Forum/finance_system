@extends('layout.app')

@section('content')

    <div class="min-h-screen">

        <div class="mx-auto max-w-full">

            @include('finance-forms.partials.form-header')


            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

                    <p class="font-bold text-red-800">
                        Please correct the following errors:
                    </p>

                    <ul class="mt-2 list-disc pl-5 text-sm text-red-700">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif


            <form id="financeForm" action="{{ route('finance-forms.store') }}" method="POST"
                data-calculation-type="{{ $calculationType }}" class="space-y-6">

                @csrf

                <input type="hidden" name="transaction_type" value="{{ $transactionType }}">


                @include('finance-forms.partials.common-fields')


                {{-- Disbursement Summary --}}
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

                    <div class="mb-6">

                        <h2 class="text-base font-bold text-gray-900">
                            Disbursement Calculation
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Compare the cash advance with the actual expense.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">

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


                    <div class="mt-4 rounded-xl bg-gray-100 px-4 py-3">

                        <span class="text-sm font-semibold text-gray-600">
                            Difference:
                        </span>

                        <span id="differenceDisplay" class="ml-2 text-sm font-bold text-gray-900">
                            0.00
                        </span>

                    </div>

                </div>


                @include('finance-forms.partials.sheet-accounting-items')


                @include('finance-forms.partials.form-actions')

            </form>

        </div>

    </div>


    @include('finance-forms.partials.sheet-accounting-script')

@endsection
