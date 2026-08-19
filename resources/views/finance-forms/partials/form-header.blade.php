<div class="mb-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between bg-green-600 p-6 rounded-xl">

        <div>

            <div class="mb-2 flex items-center gap-2 text-sm text-gray-200">

                <a href="{{ route('finance-forms.index') }}" class="transition hover:text-emerald-600">
                    Finance Forms
                </a>

                <span>/</span>

                <span>Create</span>

            </div>


            <h1 class="text-2xl font-bold tracking-tight text-white">
                {{ $title }}
            </h1>


            <p class="mt-1 text-sm text-gray-200">
                Enter the information and accounting entries for this transaction.
            </p>

        </div>


        <a href="{{ route('finance-forms.index') }}"
            class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-green-700 shadow-lg transition hover:bg-gray-50">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 18 9 12l6-6" />
            </svg>
            Back
        </a>

    </div>

</div>
