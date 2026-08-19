<div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">

    <a href="{{ route('finance-forms.index') }}"
        class="inline-flex items-center justify-center rounded-xl border text-white border-gray-300 bg-amber-400 px-6 py-3 text-sm font-semibold shadow-sm transition hover:bg-amber-500">
        Cancel
    </a>


    <button type="submit"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">

        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>

        Save {{ $title }}

    </button>

</div>
