@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-700 via-green-600 to-emerald-500 rounded-2xl shadow-lg p-6 mb-4">

            <div class="flex flex-col md:flex-row justify-between items-center">

                <div>

                    <h1 class="text-3xl font-bold text-white">
                        Purchase Request Details
                    </h1>

                    <p class="text-green-100 mt-2">
                        View complete purchase request information.
                    </p>

                </div>

                <div class="flex gap-3 mt-4 md:mt-0">

                    @if (auth()->user()->role?->name === 'Admin' || auth()->id() == $purchaseRequest->prepared_by)
                        <a href="{{ route('purchase-requests.index') }}"
                            class="px-5 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-100 font-medium">

                            ← Back

                        </a>

                        <a href="{{ route('purchase-requests.edit', $purchaseRequest) }}"
                            class="px-5 py-2 rounded-lg bg-yellow-400 hover:bg-yellow-500 text-white font-medium">

                            ✏ Edit

                        </a>
                    @endif
                </div>

            </div>

        </div>

        {{-- Purchase Information --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-4">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-green-700 via-green-600 to-emerald-500 px-6 py-5">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-white">
                            Purchase Information
                        </h2>

                        <p class="text-green-100 text-sm mt-1">
                            Purchase Request Details
                        </p>

                    </div>

                    {{-- @php
                        $statusColor = match ($purchaseRequest->status) {
                            'Approved' => 'bg-green-100 text-green-700 border-green-300',
                            'Rejected' => 'bg-red-100 text-red-700 border-red-300',
                            'Pending' => 'bg-yellow-100 text-yellow-700 border-yellow-300',
                            default => 'bg-blue-100 text-blue-700 border-blue-300',
                        };
                    @endphp

                    <span class="px-5 py-2 rounded-full border font-semibold {{ $statusColor }}">
                        {{ $purchaseRequest->status }}
                    </span> --}}

                </div>

            </div>

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

                    {{-- Purchase No --}}
                    <div class="bg-gray-50 rounded-xl p-5 border">

                        <p class="text-xs uppercase tracking-wider text-gray-500">
                            Purchase No
                        </p>

                        <h3 class="text-xl font-bold text-gray-800 mt-2">
                            {{ $purchaseRequest->purchase_no }}
                        </h3>

                    </div>

                    {{-- Request Date --}}
                    <div class="bg-gray-50 rounded-xl p-5 border">

                        <p class="text-xs uppercase tracking-wider text-gray-500">
                            Request Date
                        </p>

                        <h3 class="text-lg font-semibold mt-2">

                            {{ \Carbon\Carbon::parse($purchaseRequest->request_date)->format('d F Y') }}

                        </h3>

                    </div>

                    {{-- Donor --}}
                    <div class="bg-gray-50 rounded-xl p-5 border">

                        <p class="text-xs uppercase tracking-wider text-gray-500">
                            Donor
                        </p>

                        <h3 class="text-lg font-semibold mt-2">

                            {{ $purchaseRequest->donor ?: '-' }}

                        </h3>

                    </div>

                    {{-- Budget --}}
                    <div class="bg-gray-50 rounded-xl p-5 border">

                        <p class="text-xs uppercase tracking-wider text-gray-500">
                            Budget Line
                        </p>

                        <h3 class="text-lg font-semibold mt-2">

                            {{ $purchaseRequest->budget_line ?: '-' }}

                        </h3>

                    </div>

                </div>

            </div>

        </div>

        {{-- Purpose --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-4">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-green-700 via-green-600 to-green-500 px-6 py-5">

                <div class="flex items-center space-x-4">

                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-white">
                            Purpose
                        </h2>

                        <p class="text-blue-100 text-sm">
                            Reason for this purchase request
                        </p>

                    </div>

                </div>
            </div>

            {{-- Content --}}
            <div class="p-6">

                <div class="bg-green-50 border-l-4 border-green-500 rounded-xl px-6 py-4 text-gray-700 leading-8 ">

                    {{ $purchaseRequest->purpose ?: 'No purpose provided.' }}

                </div>

            </div>

        </div>

        {{-- Purchase Items --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-6">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-emerald-700 via-green-600 to-lime-500 px-6 py-5">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-white">
                            Purchase Items
                        </h2>

                        <p class="text-green-100 text-sm mt-1">
                            List of requested purchase items
                        </p>

                    </div>

                    <div class="mt-4 md:mt-0">

                        <span
                            class="inline-flex items-center gap-2 px-5 py-2 bg-white/20 backdrop-blur rounded-full text-white font-semibold">

                            📦 {{ $purchaseRequest->items->count() }} Item(s)

                        </span>

                    </div>

                </div>

            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead>

                        <tr class="bg-gray-100 text-gray-700 uppercase text-sm">

                            <th class="px-5 py-4 text-center w-16">
                                #
                            </th>

                            <th class="px-5 py-4 text-left">
                                Item Name
                            </th>

                            <th class="px-5 py-4 text-left">
                                Specification
                            </th>

                            <th class="px-5 py-4 text-center">
                                Unit
                            </th>

                            <th class="px-5 py-4 text-right">
                                Unit Cost
                            </th>

                            <th class="px-5 py-4 text-center">
                                Qty
                            </th>

                            <th class="px-5 py-4 text-right">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($purchaseRequest->items as $item)
                            <tr class="hover:bg-green-50 transition duration-200 even:bg-gray-50">

                                <td class="px-5 py-4 text-center">

                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-700 font-bold">

                                        {{ $loop->iteration }}

                                    </span>

                                </td>

                                <td class="px-5 py-4 w-[300px]">

                                    <div class="font-semibold text-gray-800 line-clamp-1">

                                        {{ $item->item_name }}

                                    </div>

                                </td>

                                <td class="px-5 py-4  w-[450px] ">

                                    <span​ class="text-gray-600 line-clamp-1">

                                        {{ $item->specification ?: '-' }}
                                        </span>

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm font-medium">

                                        {{ $item->unit ?: '-' }}

                                    </span>

                                </td>

                                <td class="px-5 py-4 text-right font-medium">

                                    ${{ number_format($item->unit_cost, 2) }}

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">

                                        {{ $item->quantity }}

                                    </span>

                                </td>

                                <td class="px-5 py-4 text-right">

                                    <span class="font-bold text-green-700 text-base">

                                        ${{ number_format($item->total, 2) }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300 mb-4"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m16 0H4" />

                                        </svg>

                                        <p class="text-lg font-semibold text-gray-500">

                                            No purchase items found

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                    @if ($purchaseRequest->items->count())
                        <tfoot>

                            <tr class="bg-green-600 text-white">

                                <td colspan="5" class="px-6 py-5 text-right font-bold text-lg">

                                    Grand Total

                                </td>

                                <td class="px-6 py-5 text-center font-bold">

                                    {{ $purchaseRequest->items->sum('quantity') }}

                                </td>

                                <td class="px-6 py-5 text-right font-bold text-xl">

                                    ${{ number_format($purchaseRequest->grand_total, 2) }}

                                </td>

                            </tr>

                        </tfoot>
                    @endif

                </table>

            </div>

        </div>


        {{-- Footer Buttons --}}
        <div class="flex flex-wrap justify-end gap-3 no-print">
            @if (auth()->user()->role?->name === 'Admin' || auth()->id() == $purchaseRequest->prepared_by)
                <a href="{{ route('purchase-requests.index') }}"
                    class="px-6 py-3 rounded-xl bg-gray-500 hover:bg-gray-600 text-white">

                    ← Back

                </a>

                <a href="{{ route('purchase-requests.edit', $purchaseRequest) }}"
                    class="px-6 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white">

                    ✏ Edit

                </a>
            @endif

            @if (auth()->user()->role?->name === 'Manager' &&
                    (int) $purchaseRequest->reviewed_by === (int) auth()->id() &&
                    $purchaseRequest->status === 'Pending Manager Approval')
                <form method="POST" action="{{ route('purchase-requests.approve', $purchaseRequest) }}"
                    class="inline approve-form">

                    @csrf

                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white transition">

                        👁 Review

                    </button>

                </form>
            @endif



            {{-- ========================================================= --}}
            {{-- ED: APPROVE --}}
            {{-- ========================================================= --}}

            @if (auth()->user()->role?->name === 'ED' &&
                    (int) $purchaseRequest->approved_by === (int) auth()->id() &&
                    $purchaseRequest->status === 'Pending ED Approval')
                <form method="POST" action="{{ route('purchase-requests.approve', $purchaseRequest) }}"
                    class="inline approve-form">

                    @csrf

                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white transition">

                        ✓ Approve

                    </button>

                </form>
            @endif

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.approve-form').forEach(function(form) {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    const isManager = form.querySelector('button').textContent.includes('Review');
                    const title = isManager ?
                        'Review Purchase Request?' :
                        'Approve Purchase Request?';

                    const text = isManager ?
                        'Are you sure you want to approve this Purchase Request and send it to Finance?' :
                        'Are you sure you want to give final approval and send this request to Finance?';

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonText: 'Yes, Approve',
                        cancelButtonText: 'Cancel',

                        confirmButtonColor: '#16a34a',
                        cancelButtonColor: '#6b7280',

                        reverseButtons: true,

                        focusCancel: true
                    }).then((result) => {

                        if (result.isConfirmed) {

                            // Prevent double click
                            const button = form.querySelector('button');

                            button.disabled = true;
                            button.innerHTML = '⏳ Processing...';

                            form.submit();
                        }

                    });

                });

            });

        });
    </script>
@endsection
