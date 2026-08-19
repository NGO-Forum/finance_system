@extends('layout.app')

@section('content')
    <div class="space-y-4">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-3xl p-8 shadow-xl">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4">

                <div>

                    <h1 class="text-4xl font-bold text-white">
                        Expenditure Summary
                    </h1>

                    <p class="text-green-100 mt-2">
                        Manage all expenditure summaries
                    </p>

                </div>

                <a href="{{ route('expenditure-summaries.create') }}"
                    class="bg-white text-green-600 px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition">

                    + New Summary

                </a>

            </div>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl">

                {{ session('success') }}

            </div>
        @endif

        {{-- Search --}}
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <form method="GET">

                <div class="flex gap-3">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search expenditure summary..."
                        class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700">

                        Search

                    </button>

                </div>

            </form>

        </div>

        {{-- Table --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="px-6 py-5 bg-green-600">

                <h2 class="text-xl font-semibold text-white">
                    Expenditure Summaries
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gradient-to-r from-green-50 to-indigo-50 border-b">

                        <tr>

                            <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                                No.
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                                Activity
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                                Transaction Type
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">
                                Date Request
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">
                                Total Expense
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                                Prepare by
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                                Reviewer by
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($summaries as $summary)
                            <tr class="hover:bg-green-50 transition duration-200">

                                <td class="px-4 py-2">
                                    {{ $summaries->firstItem() + $loop->index }}
                                </td>

                                {{-- Activity --}}
                                <td class="px-6 py-2">
                                    <div class="font-semibold text-gray-800 w-[350px] truncate">
                                        {{ $summary->activity }}
                                    </div>
                                </td>

                                {{-- Fund Request --}}
                                <td class="px-6 py-2">
                                    {{ $summary->transaction_type }}
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-2 text-center text-gray-600">

                                    {{ $summary->date?->format('d M Y') }}

                                </td>

                                {{-- Total Expense --}}
                                <td class="px-6 py-2 text-center">

                                    <span class="font-bold text-green-700">

                                        ${{ number_format($summary->total_actual_expense, 2) }}

                                    </span>

                                </td>

                                {{-- User --}}
                                <td class="px-6 py-2 text-left">

                                    {{ $summary->user?->name }}

                                </td>

                                {{-- Reviewer by --}}
                                <td class="px-6 py-2 text-left">

                                    {{ $summary->reviewer?->name ?? 'N/A' }}

                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-2 text-center">

                                    <div class="relative inline-block">

                                        <button type="button" onclick="toggleMenu({{ $summary->id }})"
                                            class="p-2 rounded-lg hover:bg-gray-100">

                                            <i class="fas fa-ellipsis-v"></i>

                                        </button>

                                        <div id="menu-{{ $summary->id }}"
                                            class="hidden absolute right-0 -mt-4 w-12 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50">


                                            @if ($summary->status === 'Approved')
                                                <a href="{{ route('expenditure-summaries.pdf', $summary) }}"
                                                    target="_blank"
                                                    class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50">

                                                    <i class="fas fa-file-pdf mr-2"></i>

                                                </a>
                                            @endif

                                            <a href="{{ route('expenditure-summaries.show', $summary) }}"
                                                class="flex items-center px-4 py-3 text-blue-600 hover:bg-blue-50">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            @if ($summary->status !== 'Approved')
                                                <a href="{{ route('expenditure-summaries.edit', $summary) }}"
                                                    class="flex items-center px-4 py-3 text-green-600 hover:bg-green-50">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form id="delete-summary-{{ $summary->id }}"
                                                    action="{{ route('expenditure-summaries.destroy', $summary) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button" onclick="deleteSummary({{ $summary->id }})"
                                                        class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>
                                            @endif

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="py-20 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center text-4xl mb-4">

                                            📊

                                        </div>

                                        <h3 class="text-lg font-semibold text-gray-700">

                                            No Expenditure Summaries Found

                                        </h3>

                                        <p class="text-gray-500 mt-1">

                                            Create your first expenditure summary.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t bg-gray-50 flex justify-between items-center">

                <p class="text-sm text-gray-600">

                    Showing
                    {{ $summaries->firstItem() ?? 0 }}
                    -
                    {{ $summaries->lastItem() ?? 0 }}

                    of

                    {{ $summaries->total() }}

                </p>

                {{ $summaries->links() }}

            </div>

        </div>

    </div>

    <script>
        function toggleMenu(id) {
            document.querySelectorAll('[id^="menu-"]').forEach(menu => {

                if (menu.id !== `menu-${id}`) {
                    menu.classList.add('hidden');
                }

            });

            document
                .getElementById(`menu-${id}`)
                .classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {

            if (!e.target.closest('.relative')) {
                document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }

        });

        function deleteSummary(id) {

            Swal.fire({
                title: 'Delete Expenditure Summary?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById(
                        'delete-summary-' + id
                    ).submit();
                }
            });
        }
    </script>
@endsection
