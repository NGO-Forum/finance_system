@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto space-y-4">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-700 to-emerald-600 rounded-2xl shadow-xl p-6 text-white">

            <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">

                <div>

                    <h1 class="text-3xl font-bold">
                        DSA Claim Details
                    </h1>

                    <p class="text-green-100 mt-2">
                        Daily Subsistence Allowance Claim Form
                    </p>

                </div>

                <div class="flex flex-wrap gap-3">

                    <a href="{{ route('dsa-claims.index') }}"
                        class="px-5 py-3 rounded-xl bg-white text-green-700 font-semibold hover:bg-gray-100 transition">

                        <i class="fas fa-arrow-left mr-2"></i>

                        Back

                    </a>

                    <a href="{{ route('dsa-claims.edit', $dsaClaim) }}"
                        class="px-5 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-semibold transition">

                        <i class="fas fa-edit mr-2"></i>

                        Edit

                    </a>

                </div>

            </div>

        </div>

        {{-- Claim Information --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-green-600 to-emerald-500 px-6 py-5 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-file-invoice text-white text-xl"></i>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-white">
                            Claim Information
                        </h2>
                        <p class="text-green-100 text-sm">
                            Daily Subsistence Allowance Claim Details
                        </p>
                    </div>

                </div>

                @php
                    $statusColor = [
                        'Draft' => 'bg-gray-100 text-gray-700',
                        'Pending' => 'bg-yellow-100 text-yellow-700',
                        'Approved' => 'bg-green-100 text-green-700',
                        'Rejected' => 'bg-red-100 text-red-700',
                        'Paid' => 'bg-green-100 text-green-700',
                    ];
                @endphp

                <span
                    class="px-4 py-2 rounded-full text-sm font-semibold {{ $statusColor[$dsaClaim->status] ?? 'bg-gray-100 text-gray-700' }}">
                    {{ $dsaClaim->status }}
                </span>

            </div>

            <div class="p-4">

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6 text-sm ">

                    {{-- Request Date --}}
                    <div class="bg-gray-50 rounded-2xl p-5 border hover:shadow-md transition">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-green-600"></i>
                            </div>

                            <div>

                                <p class="text-sm text-gray-500">
                                    Request Date
                                </p>

                                <h4 class="font-bold text-gray-800">
                                    {{ \Carbon\Carbon::parse($dsaClaim->date_requested)->format('d M Y') }}
                                </h4>

                            </div>

                        </div>

                    </div>

                    {{-- Department --}}
                    <div class="bg-gray-50 rounded-2xl p-5 border hover:shadow-md transition">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                <i class="fas fa-building text-green-600"></i>
                            </div>

                            <div>

                                <p class="text-sm text-gray-500">
                                    Department
                                </p>

                                <h4 class="font-bold">
                                    {{ $dsaClaim->department?->name ?? '-' }}
                                </h4>

                            </div>

                        </div>

                    </div>

                    {{-- Prepared By --}}
                    <div class="bg-gray-50 rounded-2xl p-5 border hover:shadow-md transition">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-user text-purple-600"></i>
                            </div>

                            <div>

                                <p class="text-sm text-gray-500">
                                    Prepared By
                                </p>

                                <h4 class="font-bold">
                                    {{ $dsaClaim->user?->name ?? '-' }}
                                </h4>

                            </div>

                        </div>

                    </div>

                    {{-- Budget Code --}}
                    <div class="bg-gray-50 rounded-2xl p-5 border hover:shadow-md transition">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center">
                                <i class="fas fa-wallet text-orange-600"></i>
                            </div>

                            <div>

                                <p class="text-sm text-gray-500">
                                    Budget Code
                                </p>

                                <h4 class="font-bold">
                                    {{ $dsaClaim->budget_code ?: '-' }}
                                </h4>

                            </div>

                        </div>

                    </div>

                    {{-- Donor --}}
                    <div class="bg-gray-50 rounded-2xl p-5 border hover:shadow-md transition">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center">
                                <i class="fas fa-hand-holding-heart text-pink-600"></i>
                            </div>

                            <div>

                                <p class="text-sm text-gray-500">
                                    Donor
                                </p>

                                <h4 class="font-bold">
                                    {{ $dsaClaim->donor ?: '-' }}
                                </h4>

                            </div>

                        </div>

                    </div>

                    {{-- Claim Number --}}
                    <div class="bg-gray-50 rounded-2xl p-5 border hover:shadow-md transition">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-hashtag text-indigo-600"></i>
                            </div>

                            <div>

                                <p class="text-sm text-gray-500">
                                    Claim Number
                                </p>

                                <h4 class="font-bold text-green-700">
                                    {{ $dsaClaim->claim_no }}
                                </h4>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Purpose --}}
                <div class="mt-5">

                    <label class="block text-base font-semibold text-green-700 mb-2">
                        Purpose of Travel
                    </label>

                    <div class="bg-gray-50 border rounded-2xl p-4 leading-7  text-gray-700">

                        {{ $dsaClaim->purpose_of_travel }}

                    </div>

                </div>

            </div>

        </div>

        {{-- Travel Information --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

            {{-- Header --}}
            <div
                class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">

                        <i class="fas fa-route text-white text-xl"></i>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-white">
                            Travel Information
                        </h2>

                        <p class="text-green-100 text-sm">
                            Travel history for this DSA claim
                        </p>

                    </div>

                </div>

                <div class="mt-4 md:mt-0">

                    <span
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white text-green-700 font-semibold shadow">

                        <i class="fas fa-plane-departure"></i>

                        {{ $dsaClaim->travels->count() }} Trip(s)

                    </span>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead>

                        <tr class="bg-gray-50 border-b">

                            <th class="px-6 py-4 text-center text-xs uppercase tracking-wider text-gray-600">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-gray-600">
                                Travel Date
                            </th>

                            <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-gray-600">
                                From
                            </th>

                            <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-gray-600">
                                Destination
                            </th>

                            <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-gray-600">
                                Dist (km)
                            </th>

                            <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-gray-600">
                                Purpose
                            </th>

                            <th class="px-6 py-4 text-center text-xs uppercase tracking-wider text-gray-600">
                                Departure
                            </th>

                            <th class="px-6 py-4 text-center text-xs uppercase tracking-wider text-gray-600">
                                Arrival
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($dsaClaim->travels as $travel)
                            <tr class="border-b hover:bg-green-50 transition duration-200">

                                <td class="px-6 py-5 text-center">

                                    <div
                                        class="w-9 h-9 mx-auto rounded-full bg-green-100 text-green-700 font-bold flex items-center justify-center">

                                        {{ $loop->iteration }}

                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <div class="font-semibold text-gray-800">

                                        {{ \Carbon\Carbon::parse($travel->travel_date)->format('d M Y') }}

                                    </div>

                                    <div class="text-xs text-gray-400">

                                        {{ \Carbon\Carbon::parse($travel->travel_date)->format('l') }}

                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700">

                                        <i class="fas fa-map-marker-alt mr-2"></i>

                                        {{ $travel->from_location }}

                                    </span>

                                </td>

                                <td class="px-6 py-5">

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700">

                                        <i class="fas fa-location-arrow mr-2"></i>

                                        {{ $travel->to_location }}

                                    </span>

                                </td>

                                <td class="px-6 py-5">

                                    <span
                                        class="inline-flex items-center rounded-full
                                            bg-green-100 px-3 py-1 text-sm
                                            font-semibold text-green-700">

                                        <i class="fas fa-location-arrow mr-2"></i>

                                        {{ $travel->km ?? 0 }} km

                                    </span>

                                </td>

                                <td class="px-6 py-5 w-80">

                                    <div class="max-w-2xl">

                                        {{ $travel->purpose }}

                                    </div>

                                </td>

                                <td class="px-6 py-5 text-center">

                                    @if ($travel->departure_time)
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-medium">

                                            <i class="far fa-clock mr-1"></i>

                                            {{ \Carbon\Carbon::parse($travel->departure_time)->format('H:i') }}

                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif

                                </td>

                                <td class="px-6 py-5 text-center">

                                    @if ($travel->arrival_time)
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-medium">

                                            <i class="far fa-clock mr-1"></i>

                                            {{ \Carbon\Carbon::parse($travel->arrival_time)->format('H:i') }}

                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7">

                                    <div class="py-16 flex flex-col items-center">

                                        <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">

                                            <i class="fas fa-route text-4xl text-green-500"></i>

                                        </div>

                                        <h3 class="mt-6 text-xl font-bold text-gray-700">

                                            No Travel Information

                                        </h3>

                                        <p class="mt-2 text-gray-500">

                                            No travel records have been added to this DSA claim.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($dsaClaim->travels->count())
                <div
                    class="bg-gradient-to-r from-green-50 to-cyan-50 border-t px-8 py-5 flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm">

                            Total Travel Records

                        </p>

                        <h3 class="text-3xl font-bold text-green-700">

                            {{ $dsaClaim->travels->count() }}

                        </h3>

                    </div>

                    <div>

                        <span
                            class="inline-flex items-center px-5 py-3 rounded-xl bg-green-600 text-white font-semibold shadow">

                            <i class="fas fa-check-circle mr-2"></i>

                            Travel Information Complete

                        </span>

                    </div>

                </div>
            @endif

        </div>

        {{-- Expense Claim --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

            {{-- Header --}}
            <div
                class="bg-gradient-to-r from-green-700 via-green-600 to-emerald-500 px-6 py-5 flex flex-col md:flex-row md:justify-between md:items-center">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">

                        <i class="fas fa-receipt text-white text-xl"></i>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-white">
                            Expense Claim
                        </h2>

                        <p class="text-green-100 text-sm">
                            Daily Subsistence Allowance Expense Details
                        </p>

                    </div>

                </div>

                <div class="mt-4 md:mt-0">

                    <span
                        class="inline-flex items-center gap-2 bg-white text-green-700 px-5 py-2 rounded-full font-semibold shadow">

                        <i class="fas fa-wallet"></i>

                        {{ $dsaClaim->items->count() }} Item(s)

                    </span>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead>

                        <tr class="bg-green-50 border-b border-green-200">

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-green-700">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-700">
                                Expense Date
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-700">
                                Breakfast
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-700">
                                Lunch
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-700">
                                Dinner
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-700">
                                Accommodation
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-700">
                                Transport
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-700">
                                Incident
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-700">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @php

                            $breakfast = 0;
                            $lunch = 0;
                            $dinner = 0;
                            $accommodation = 0;
                            $transport = 0;
                            $incident = 0;

                        @endphp

                        @forelse($dsaClaim->items as $item)
                            @php

                                $breakfast += $item->breakfast;
                                $lunch += $item->lunch;
                                $dinner += $item->dinner;
                                $accommodation += $item->accommodation;
                                $transport += $item->transport;
                                $incident += $item->incident;

                            @endphp

                            <tr
                                class="odd:bg-white even:bg-green-50 hover:bg-green-100 transition-all duration-200 border-b">

                                <td class="px-6 py-5 text-center">

                                    <div
                                        class="w-9 h-9 mx-auto rounded-full bg-green-100 text-green-700 font-bold flex items-center justify-center">

                                        {{ $loop->iteration }}

                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <div class="font-semibold text-gray-800">

                                        {{ \Carbon\Carbon::parse($item->expense_date)->format('d M Y') }}

                                    </div>

                                    <div class="text-xs text-gray-400">

                                        {{ \Carbon\Carbon::parse($item->expense_date)->format('l') }}

                                    </div>

                                </td>

                                <td class="px-6 py-5 text-right">
                                    ${{ number_format($item->breakfast, 2) }}
                                </td>

                                <td class="px-6 py-5 text-right">
                                    ${{ number_format($item->lunch, 2) }}
                                </td>

                                <td class="px-6 py-5 text-right">
                                    ${{ number_format($item->dinner, 2) }}
                                </td>

                                <td class="px-6 py-5 text-right">
                                    ${{ number_format($item->accommodation, 2) }}
                                </td>

                                <td class="px-6 py-5 text-right">
                                    ${{ number_format($item->transport, 2) }}
                                </td>

                                <td class="px-6 py-5 text-right">
                                    ${{ number_format($item->incident, 2) }}
                                </td>

                                <td class="px-6 py-5 text-right">

                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 font-bold">

                                        ${{ number_format($item->total, 2) }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9">

                                    <div class="py-16 flex flex-col items-center">

                                        <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">

                                            <i class="fas fa-wallet text-4xl text-green-500"></i>

                                        </div>

                                        <h3 class="mt-5 text-xl font-bold text-gray-700">

                                            No Expense Items

                                        </h3>

                                        <p class="mt-2 text-gray-500">

                                            No expense items have been added.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                    @if ($dsaClaim->items->count())
                        <tfoot>

                            {{-- Category Totals --}}
                            <tr class="bg-green-50 border-t-2 border-green-200">

                                <td colspan="2" class="px-6 py-5 text-right font-bold text-green-700">

                                    Category Total

                                </td>

                                <td class="px-6 py-5 text-right font-semibold">

                                    ${{ number_format($breakfast, 2) }}

                                </td>

                                <td class="px-6 py-5 text-right font-semibold">

                                    ${{ number_format($lunch, 2) }}

                                </td>

                                <td class="px-6 py-5 text-right font-semibold">

                                    ${{ number_format($dinner, 2) }}

                                </td>

                                <td class="px-6 py-5 text-right font-semibold">

                                    ${{ number_format($accommodation, 2) }}

                                </td>

                                <td class="px-6 py-5 text-right font-semibold">

                                    ${{ number_format($transport, 2) }}

                                </td>

                                <td class="px-6 py-5 text-right font-semibold">

                                    ${{ number_format($incident, 2) }}

                                </td>

                                <td class="px-6 py-5 text-right">

                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 font-bold">

                                        ${{ number_format($dsaClaim->grand_total, 2) }}

                                    </span>

                                </td>

                            </tr>

                            {{-- Grand Total --}}
                            <tr class="bg-gradient-to-r from-green-700 to-emerald-600 text-white">

                                <td colspan="8" class="px-8 py-6">

                                    <div>

                                        <p class="text-green-100 text-sm">

                                            GRAND TOTAL CLAIM

                                        </p>

                                        <h2 class="text-3xl font-bold mt-1">

                                            Daily Subsistence Allowance

                                        </h2>

                                    </div>

                                </td>

                                <td class="px-8 py-6 text-right">

                                    <div class="text-4xl font-extrabold">

                                        ${{ number_format($dsaClaim->grand_total, 2) }}

                                    </div>

                                </td>

                            </tr>

                        </tfoot>
                    @endif

                </table>

            </div>

        </div>

        {{-- Notes & Remarks --}}
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="bg-green-600 px-6 py-4">

                <h2 class="text-xl font-semibold text-white">
                    Notes / Remarks
                </h2>

            </div>

            <div class="p-6">

                @if ($dsaClaim->note)
                    <div class="bg-gray-50 border rounded-xl p-6 leading-8">

                        {{ $dsaClaim->note }}

                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">

                        No remarks available.

                    </div>
                @endif

            </div>

        </div>

        {{-- Footer Buttons --}}
        <div class="flex flex-wrap justify-end gap-4">

            <a href="{{ route('dsa-claims.index') }}"
                class="px-6 py-3 rounded-xl bg-gray-600 hover:bg-gray-700 text-white font-semibold">

                <i class="fas fa-arrow-left mr-2"></i>

                Back

            </a>

            <a href="{{ route('dsa-claims.edit', $dsaClaim) }}"
                class="px-6 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-semibold">

                <i class="fas fa-edit mr-2"></i>

                Edit

            </a>

        </div>

    </div>
@endsection
