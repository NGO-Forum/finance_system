@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-slate-100 text-slate-800">
        <div class="max-w-full mx-auto bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">

            <!-- Header -->
            <div class="bg-green-700 px-6 py-4 flex justify-between items-center text-white">
                <div>
                    <h1 class="text-xl font-bold tracking-tight">
                        ALLOWANCE FOR PARTICIPANTS
                    </h1>
                    <p class="text-xs text-green-100 mt-1">
                        View Allowance Form
                    </p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('allowance-forms.edit', $allowanceForm) }}"
                        class="px-4 py-2 bg-amber-500 hover:bg-amber-600 rounded-lg text-sm font-semibold">
                        Edit
                    </a>

                    <a href="{{ route('allowance-forms.index') }}"
                        class="px-4 py-2 bg-slate-700 hover:bg-slate-800 rounded-lg text-sm font-semibold">
                        Back
                    </a>
                </div>
            </div>

            <!-- Activity Information -->
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 bg-slate-50 p-5 border-b">

                <div class="md:col-span-6">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">
                        Activity
                    </label>

                    <div class="border rounded-lg bg-white p-3">
                        {{ $allowanceForm->activity }}
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">
                        Start Date
                    </label>

                    <div class="border rounded-lg bg-white p-3">
                        {{ \Carbon\Carbon::parse($allowanceForm->start_date)->format('d M Y') }}
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">
                        End Date
                    </label>

                    <div class="border rounded-lg bg-white p-3">
                        {{ \Carbon\Carbon::parse($allowanceForm->end_date)->format('d M Y') }}
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">
                        Venue
                    </label>

                    <div class="border rounded-lg bg-white p-3">
                        {{ $allowanceForm->venue }}
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">
                        Donor
                    </label>

                    <div class="border rounded-lg bg-white p-3">
                        {{ $allowanceForm->donor }}
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">
                        Donor Code
                    </label>

                    <div class="border rounded-lg bg-white p-3">
                        {{ $allowanceForm->donor_code }}
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">
                        Budget Code
                    </label>

                    <div class="border rounded-lg bg-white p-3">
                        {{ $allowanceForm->budget_code }}
                    </div>
                </div>

                @if ($allowanceForm->donorLogos->count())
                    <div class="rounded-xl border border-gray-200 bg-white col-span-6">

                        <div class="border-b px-6 py-4">
                            <h2 class="text-lg font-semibold text-green-700">
                                Donor Logos
                            </h2>
                        </div>

                        <div class="p-4">

                            <div class="flex flex-wrap gap-6">

                                @foreach ($allowanceForm->donorLogos as $donor)
                                    <div class="flex items-center gap-3 rounded-lg border border-gray-200 px-4 py-3">

                                        <span class="font-medium text-gray-700">
                                            {{ $donor->name }}
                                        </span>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>
                @endif

            </div>

            <!-- Matrix -->
            <div class="overflow-x-auto">

                <table class="w-full border-collapse min-w-[1250px] text-sm">

                    <thead>

                        <tr class="bg-green-700 text-white">

                            <th class="border p-2 w-8">
                                No
                            </th>

                            <th class="border p-2 w-56">
                                Name (Position & Organization)
                            </th>

                            <th class="border p-2 w-16">
                                Sex
                            </th>

                            <th class="border p-2 w-64">
                                Village / Commune / District / Province
                            </th>

                            <th class="border p-2 w-32 bg-green-700">
                                Allowance Type
                            </th>

                            @foreach ($allowanceForm->dates ?? [] as $index => $date)
                                <th class="border p-2 w-28 text-center bg-green-700">

                                    <div class="text-[10px] uppercase text-white">
                                        Day {{ $index + 1 }}
                                    </div>

                                    <div class="font-bold mt-1">
                                        {{ $date }}
                                    </div>

                                </th>
                            @endforeach

                            <th class="border p-2 w-24">
                                Total
                            </th>

                            <th class="border p-2 w-24">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($allowanceForm->participants as $index => $participant)
                            @php
                                $costs = $participant->costs ?? [];

                                $categories = [
                                    'breakfast' => 'Breakfast',
                                    'lunch' => 'Lunch',
                                    'dinner' => 'Dinner',
                                    'accommodation' => 'Accommodation',
                                    'taxi' => 'Taxi / Bus',
                                    'local_transport' => 'Local Transport',
                                ];
                            @endphp

                            <tr class="hover:bg-slate-50 align-top">

                                <!-- No -->
                                <td class="border text-center align-middle font-bold">
                                    {{ $index + 1 }}
                                </td>

                                <!-- Name -->
                                <td class="border align-middle">
                                    <div class="text-center">
                                        <div class="font-semibold text-sm">
                                            {{ $participant->name }}
                                        </div>

                                        <div class="text-slate-600 text-sm mt-1">
                                            {{ $participant->position }}
                                        </div>

                                        <div class="text-slate-500 text-sm">
                                            {{ $participant->organization }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Gender -->
                                <td class="border text-center align-middle font-semibold">
                                    {{ $participant->gender }}
                                </td>

                                <!-- Province -->
                                <td class="border align-middle">
                                    <div class="text-center">

                                        <div class="text-lg text-slate-500 mt-1">
                                            {{ $participant->province }}
                                        </div>

                                        @if ($participant->distance)
                                            <div class="text-sm text-slate-500 mt-1">
                                                Distance: {{ number_format($participant->distance, 1) }} km
                                            </div>
                                        @endif

                                        @if ($participant->remarks)
                                            <div class="text-sm italic text-slate-400 mt-1">
                                                {{ $participant->remarks }}
                                            </div>
                                        @endif

                                    </div>
                                </td>

                                <!-- Allowance Labels -->
                                <td class="border p-0">

                                    @foreach ($categories as $label)
                                        <div class="border-b px-2 py-2 bg-slate-50 font-semibold text-[11px] uppercase">

                                            {{ $label }}

                                        </div>
                                    @endforeach

                                </td>

                                <!-- Daily Matrix -->
                                <td colspan="{{ count($allowanceForm->dates ?? []) }}" class="border p-0">

                                    <div class="grid grid-cols-1">

                                        @foreach ($categories as $key => $label)
                                            <div class="flex">

                                                @foreach ($allowanceForm->dates ?? [] as $dIndex => $date)
                                                    <div class="flex-1 border-r border-b text-center py-2 min-w-[110px]">

                                                        @php
                                                            $value = $costs[$dIndex][$key] ?? 0;
                                                        @endphp

                                                        @if ($value > 0)
                                                            ${{ number_format($value, 2) }}
                                                        @else
                                                            -
                                                        @endif

                                                    </div>
                                                @endforeach

                                            </div>
                                        @endforeach

                                    </div>

                                </td>

                                <!-- Totals -->
                                <td class="border p-0 bg-slate-50">

                                    <div class="border-b py-2 text-right pr-3 font-semibold">
                                        ${{ number_format($participant->breakfast, 2) }}
                                    </div>

                                    <div class="border-b py-2 text-right pr-3 font-semibold">
                                        ${{ number_format($participant->lunch, 2) }}
                                    </div>

                                    <div class="border-b py-2 text-right pr-3 font-semibold">
                                        ${{ number_format($participant->dinner, 2) }}
                                    </div>

                                    <div class="border-b py-2 text-right pr-3 font-semibold">
                                        ${{ number_format($participant->accommodation, 2) }}
                                    </div>

                                    <div class="border-b py-2 text-right pr-3 font-semibold">
                                        ${{ number_format($participant->taxi, 2) }}
                                    </div>

                                    <div class="py-2 text-right pr-3 font-semibold">
                                        ${{ number_format($participant->local_transport, 2) }}
                                    </div>

                                </td>

                                <td class="border align-middle text-center bg-green-50">
                                    <div class="flex items-center justify-center h-full min-h-[200px]">
                                        <div>
                                            <div class="text-lg font-bold text-green-700">
                                                ${{ number_format($participant->total, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                    @php
                        $foodTotal =
                            $allowanceForm->participants->sum('breakfast') +
                            $allowanceForm->participants->sum('lunch') +
                            $allowanceForm->participants->sum('dinner');

                        $accommodationTotal = $allowanceForm->participants->sum('accommodation');

                        $transportTotal =
                            $allowanceForm->participants->sum('taxi') +
                            $allowanceForm->participants->sum('local_transport');

                        $grandTotal = $allowanceForm->participants->sum('total');
                    @endphp

                    <tfoot>

                        <tr class="bg-slate-100 font-bold">

                            <td colspan="{{ 6 + count($allowanceForm->dates ?? []) }}" class="border text-right px-4 py-3">

                                GRAND TOTAL

                            </td>

                            <td class="border text-center text-green-700 text-lg">

                                ${{ number_format($grandTotal, 2) }}

                            </td>

                        </tr>

                    </tfoot>

                </table>

            </div>

            <!-- Summary -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-6 bg-slate-50 border-t">

                <div class="bg-white rounded-lg border p-4 shadow-sm">

                    <div class="text-xs uppercase text-slate-500 font-bold">
                        Food Expenses
                    </div>

                    <div class="text-2xl font-black text-slate-800 mt-2">
                        ${{ number_format($foodTotal, 2) }}
                    </div>

                </div>

                <div class="bg-white rounded-lg border p-4 shadow-sm">

                    <div class="text-xs uppercase text-slate-500 font-bold">
                        Accommodation
                    </div>

                    <div class="text-2xl font-black text-slate-800 mt-2">
                        ${{ number_format($accommodationTotal, 2) }}
                    </div>

                </div>

                <div class="bg-white rounded-lg border p-4 shadow-sm">

                    <div class="text-xs uppercase text-slate-500 font-bold">
                        Transport
                    </div>

                    <div class="text-2xl font-black text-slate-800 mt-2">
                        ${{ number_format($transportTotal, 2) }}
                    </div>

                </div>

                <div class="bg-green-700 rounded-lg p-4 text-white shadow">

                    <div class="text-xs uppercase tracking-wider">
                        Grand Total
                    </div>

                    <div class="text-3xl font-black mt-2">
                        ${{ number_format($grandTotal, 2) }}
                    </div>

                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="flex justify-end gap-3 p-6 border-t bg-white">


                <a href="{{ route('allowance-forms.edit', $allowanceForm) }}"
                    class="px-5 py-2.5 rounded-lg bg-amber-500 hover:bg-amber-600 text-white font-semibold">

                    Edit

                </a>

                <a href="{{ route('allowance-forms.index') }}"
                    class="px-5 py-2.5 rounded-lg bg-slate-700 hover:bg-slate-800 text-white font-semibold">

                    Back

                </a>

            </div>

        </div>
    </div>
@endsection
