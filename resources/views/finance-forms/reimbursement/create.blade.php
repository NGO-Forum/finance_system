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


                @include('finance-forms.partials.sheet-accounting-items')


                @include('finance-forms.partials.form-actions')

            </form>

        </div>

    </div>


    @include('finance-forms.partials.sheet-accounting-script')

@endsection
