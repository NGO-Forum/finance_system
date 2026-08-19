@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-gray-50">

        {{-- ========================================================= --}}
        {{-- WEB ACTION BAR --}}
        {{-- ========================================================= --}}

        <div class="mx-auto max-w-full print:hidden mb-5">

            <div
                class="flex flex-col gap-4
                   rounded-2xl border border-gray-100
                   bg-white p-4 shadow-sm
                   sm:flex-row sm:items-center
                   sm:justify-between">

                {{-- LEFT --}}

                <div>

                    <div
                        class="flex items-center gap-2
                           text-xs font-semibold uppercase
                           tracking-wider text-green-600">

                        <span>Finance Management</span>

                        <span class="h-1 w-1 rounded-full bg-gray-300"></span>

                        <span>FM02-12</span>

                    </div>

                    <h1 class="mt-1 text-lg font-bold text-gray-800">
                        Goods / Service Received Note
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        {{ $goodsReceivedNote->grn_no }}
                    </p>

                </div>


                {{-- ACTIONS --}}

                <div class="flex flex-wrap gap-2">

                    {{-- Back --}}

                    <a href="{{ route('goods-received-notes.index') }}"
                        class="inline-flex items-center
                           justify-center gap-2
                           rounded-xl
                           border border-gray-200
                           bg-white
                           px-4 py-2.5
                           text-sm font-semibold
                           text-gray-700
                           shadow-sm
                           transition
                           hover:border-gray-300
                           hover:bg-gray-50">

                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                        </svg>

                        Back

                    </a>


                    {{-- Edit --}}

                    <a href="{{ route('goods-received-notes.edit', $goodsReceivedNote) }}"
                        class="inline-flex items-center
                           justify-center gap-2
                           rounded-xl
                           bg-amber-500
                           px-4 py-2.5
                           text-sm font-semibold
                           text-white
                           shadow-sm
                           transition
                           hover:bg-amber-600
                           hover:shadow-md">

                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" />

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 3.5a2.121 2.121 0 013 3L8 18l-4 1 1-4L16.5 3.5z" />

                        </svg>

                        Edit

                    </a>


                    {{-- Print --}}

                    <a href="{{ route('goods-received-notes.pdf', $goodsReceivedNote) }}" target="_blank"
                        class="inline-flex items-center justify-center gap-2
                            rounded-xl
                            bg-green-600
                            px-5 py-2.5
                            text-sm font-semibold
                            text-white
                            shadow-sm
                            transition-all duration-200
                            hover:bg-green-700
                            hover:shadow-md
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500
                            focus:ring-offset-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V4h12v5" />

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 14h12v6H6v-6z" />

                        </svg>

                        PDF

                    </a>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- DOCUMENT --}}
        {{-- ========================================================= --}}

        <div class="mx-auto max-w-full print:p-0">

            <div id="grnDocument"
                class="overflow-hidden
                   rounded-2xl
                   border border-gray-200
                   bg-white
                   shadow-xl
                   print:rounded-none
                   print:border-0
                   print:shadow-none">


                {{-- ========================================================= --}}
                {{-- DOCUMENT HEADER --}}
                {{-- ========================================================= --}}

                <div class="border-b-4 border-green-700">

                    <table class="w-full border-collapse">

                        <tr>

                            {{-- ORGANIZATION --}}

                            <td
                                class="w-[47%]
                                   border-r border-gray-300
                                   p-5 align-middle">

                                <div class="flex items-center gap-4">

                                    <div
                                        class="flex h-16 w-16 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           border border-green-200
                                           bg-green-50">

                                        <span
                                            class="text-2xl font-black
                                               text-green-700">
                                            NGO
                                        </span>

                                    </div>


                                    <div>

                                        <div
                                            class="text-base font-black
                                               tracking-wide
                                               text-green-800">
                                            NGO FORUM ON CAMBODIA
                                        </div>

                                        <div
                                            class="mt-0.5 text-xs
                                               font-medium
                                               text-gray-500">
                                            The NGO Forum on Cambodia
                                        </div>

                                    </div>

                                </div>


                                <div
                                    class="mt-4
                                       border-t border-gray-200
                                       pt-3
                                       text-[10px]
                                       leading-5
                                       text-gray-600">

                                    <div>
                                        #9-11, St. 476, Sangkat Toul Tompoung I,
                                        Khan Chamkarmon, Phnom Penh.
                                    </div>

                                    <div class="mt-0.5">

                                        <span class="font-semibold text-gray-700">
                                            Tel:
                                        </span>

                                        (+855) 78 550 449

                                        <span class="mx-2 text-gray-300">
                                            |
                                        </span>

                                        <span class="font-semibold text-gray-700">
                                            Fax:
                                        </span>

                                        (+855) 78 550 449

                                    </div>

                                </div>

                            </td>


                            {{-- TITLE --}}

                            <td
                                class="w-[43%]
                                   border-r border-gray-300
                                   p-5 text-center
                                   align-middle">

                                <div
                                    class="mx-auto
                                       rounded-xl
                                       border-2 border-green-700
                                       bg-green-50/40
                                       px-5 py-6">

                                    <div
                                        class="text-xl font-black
                                           tracking-wide
                                           text-green-800">
                                        GOODS / SERVICE RECEIVED NOTE
                                    </div>

                                    <div
                                        class="mt-2 text-[10px]
                                           font-semibold
                                           uppercase
                                           tracking-widest
                                           text-gray-500">
                                        Goods Receiving & Inspection
                                    </div>

                                </div>

                            </td>


                            {{-- FM CODE --}}

                            <td
                                class="w-[10%]
                                   p-4 text-center
                                   align-top">

                                <div
                                    class="rounded-xl
                                       bg-green-700
                                       px-3 py-3
                                       text-center
                                       text-xs font-black
                                       text-white">
                                    FM02-12
                                </div>

                            </td>

                        </tr>

                    </table>

                </div>


                {{-- ========================================================= --}}
                {{-- SUPPLIER / REFERENCE --}}
                {{-- ========================================================= --}}

                <div class="p-5 sm:p-6">

                    <table class="w-full border-collapse text-sm">

                        <tr>

                            {{-- SUPPLIER --}}

                            <td rowspan="5"
                                class="w-[55%]
                                   border border-gray-300
                                   bg-gray-50
                                   p-4 align-top">

                                <div
                                    class="mb-3 flex items-center gap-2
                                       border-b border-gray-200
                                       pb-2">

                                    <div
                                        class="h-2 w-2
                                           rounded-full
                                           bg-green-600">
                                    </div>

                                    <span
                                        class="font-bold uppercase
                                           tracking-wide
                                           text-gray-700">
                                        Supplier Information
                                    </span>

                                </div>


                                <div class="space-y-3">

                                    <div>

                                        <div
                                            class="text-[12px]
                                               font-bold uppercase
                                               tracking-wider
                                               text-gray-400">
                                            Supplier Name
                                        </div>

                                        <div
                                            class="mt-0.5 text-sm
                                               font-bold
                                               text-gray-800">
                                            {{ $goodsReceivedNote->supplier_name }}
                                        </div>

                                    </div>


                                    <div>

                                        <div
                                            class="text-[12px]
                                               font-bold uppercase
                                               tracking-wider
                                               text-gray-400">
                                            Address
                                        </div>

                                        <div
                                            class="mt-0.5 leading-5
                                               text-gray-700">
                                            {{ $goodsReceivedNote->supplier_address ?? '-' }}
                                        </div>

                                    </div>


                                    @if ($goodsReceivedNote->supplier_tel)
                                        <div>

                                            <div
                                                class="text-[12px]
                                                   font-bold uppercase
                                                   tracking-wider
                                                   text-gray-400">
                                                Telephone
                                            </div>

                                            <div
                                                class="mt-0.5
                                                   font-medium
                                                   text-gray-700">
                                                {{ $goodsReceivedNote->supplier_tel }}
                                            </div>

                                        </div>
                                    @endif

                                </div>

                            </td>


                            {{-- GRN --}}

                            <td
                                class="w-[22%]
                                   border border-gray-300
                                   bg-gray-50
                                   px-3 py-3
                                   font-bold text-gray-600">
                                GRN No.
                            </td>

                            <td
                                class="w-[23%]
                                   border border-gray-300
                                   px-3 py-3
                                   font-bold
                                   text-green-700">
                                {{ $goodsReceivedNote->grn_no }}
                            </td>

                        </tr>


                        <tr>

                            <td
                                class="border border-gray-300
                                   bg-gray-50
                                   px-3 py-3
                                   font-bold text-gray-600">
                                GRN Date
                            </td>

                            <td
                                class="border border-gray-300
                                   px-3 py-3
                                   font-medium text-gray-800">
                                {{ $goodsReceivedNote->grn_date?->format('d-M-Y') ?? ' ' }}
                            </td>

                        </tr>


                        <tr>

                            <td
                                class="border border-gray-300
                                   bg-gray-50
                                   px-3 py-3
                                   font-bold text-gray-600">
                                PO / Contract No.
                            </td>

                            <td
                                class="border border-gray-300
                                   px-3 py-3
                                   font-medium text-gray-800">
                                {{ $goodsReceivedNote->po_no ?? ' ' }}
                            </td>

                        </tr>


                        <tr>

                            <td
                                class="border border-gray-300
                                   bg-gray-50
                                   px-3 py-3
                                   font-bold text-gray-600">
                                Vendor Invoice No.
                            </td>

                            <td
                                class="border border-gray-300
                                   px-3 py-3
                                   font-medium text-gray-800">
                                {{ $goodsReceivedNote->vendor_invoice_no ?? ' ' }}
                            </td>

                        </tr>


                        <tr>

                            <td
                                class="border border-gray-300
                                   bg-gray-50
                                   px-3 py-3
                                   font-bold text-gray-600">
                                Delivery Note No.
                            </td>

                            <td
                                class="border border-gray-300
                                   px-3 py-3
                                   font-medium text-gray-800">
                                {{ $goodsReceivedNote->delivery_note_no ?? ' ' }}
                            </td>

                        </tr>

                    </table>


                    {{-- ========================================================= --}}
                    {{-- ITEMS --}}
                    {{-- ========================================================= --}}

                    <div class="mt-6">

                        <div class="mb-3 flex items-center
                               justify-between">

                            <div>

                                <h2
                                    class="text-sm font-bold
                                       uppercase
                                       tracking-wide
                                       text-gray-800">
                                    Goods / Service Items
                                </h2>

                                <p class="mt-0.5 text-[10px] text-gray-400">
                                    Quantity, receiving and inspection results
                                </p>

                            </div>


                            <div
                                class="rounded-full
                                   bg-green-50
                                   px-3 py-1
                                   text-[10px]
                                   font-bold
                                   text-green-700">
                                {{ $goodsReceivedNote->items->count() }} Items
                            </div>

                        </div>


                        <table class="w-full border-collapse
                               text-base">

                            <thead>

                                <tr>

                                    <th rowspan="2"
                                        class="w-[27%]
                                           border border-gray-300
                                           bg-green-50
                                           px-3 py-3
                                           text-left
                                           font-bold
                                           text-gray-700">
                                        DESCRIPTION
                                    </th>

                                    <th rowspan="2"
                                        class="w-[22%]
                                           border border-gray-300
                                           bg-green-50
                                           px-3 py-3
                                           text-left
                                           font-bold
                                           text-gray-700">
                                        INSPECTION CRITERIA
                                    </th>

                                    <th colspan="5"
                                        class="border border-gray-300
                                           bg-green-50
                                           px-2 py-3
                                           text-center
                                           font-bold
                                           text-gray-700">
                                        QUANTITY / RESULT
                                    </th>

                                </tr>


                                <tr>

                                    <th
                                        class="w-[9%]
                                           border border-gray-300
                                           bg-green-700
                                           px-2 py-2
                                           text-center
                                           font-bold
                                           text-white">
                                        ORDERED
                                    </th>

                                    <th
                                        class="w-[9%]
                                           border border-gray-300
                                           bg-green-700
                                           px-2 py-2
                                           text-center
                                           font-bold
                                           text-white">
                                        RECEIVED
                                    </th>

                                    <th
                                        class="w-[9%]
                                           border border-gray-300
                                           bg-green-700
                                           px-2 py-2
                                           text-center
                                           font-bold
                                           text-white">
                                        INSPECTED
                                    </th>

                                    <th
                                        class="w-[9%]
                                           border border-gray-300
                                           bg-green-700
                                           px-2 py-2
                                           text-center
                                           font-bold
                                           text-white">
                                        ACCEPTED
                                    </th>

                                    <th
                                        class="w-[9%]
                                           border border-gray-300
                                           bg-green-700
                                           px-2 py-2
                                           text-center
                                           font-bold
                                           text-white">
                                        REJECTED
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($goodsReceivedNote->items as $item)
                                    <tr class="even:bg-gray-50 text-base">

                                        <td
                                            class="border border-gray-300
                                               p-3 align-top
                                               leading-5
                                               text-gray-800">
                                            {!! nl2br(e($item->description)) !!}
                                        </td>


                                        <td
                                            class="border border-gray-300
                                               p-3 align-top
                                               leading-5
                                               text-gray-700">
                                            {!! nl2br(e($item->inspection_criteria ?? '-')) !!}
                                        </td>


                                        <td
                                            class="border border-gray-300
                                               p-3 text-center
                                               align-middle
                                               font-semibold">
                                            {{ rtrim(rtrim(number_format($item->ordered_quantity, 2), '0'), '.') }}
                                        </td>


                                        <td
                                            class="border border-gray-300
                                               p-3 text-center
                                               align-middle">

                                            @if ($item->received)
                                                <span
                                                    class="inline-flex
                                                       h-7 w-7
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-green-100
                                                       text-green-700">
                                                    Yes
                                                </span>
                                            @else
                                                <span class="text-gray-300">
                                                    —
                                                </span>
                                            @endif

                                        </td>


                                        <td
                                            class="border border-gray-300
                                               p-3 text-center
                                               align-middle">

                                            @if ($item->inspected)
                                                <span
                                                    class="inline-flex
                                                       h-7 w-7
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-green-100
                                                       text-green-700">
                                                    Yes
                                                </span>
                                            @else
                                                <span class="text-gray-300">
                                                    —
                                                </span>
                                            @endif

                                        </td>


                                        <td
                                            class="border border-gray-300
                                               bg-green-50/40
                                               p-3 text-center
                                               align-middle">

                                            @if ($item->accepted)
                                                <span
                                                    class="inline-flex
                                                       h-7 w-7
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-green-600
                                                       text-white
                                                       font-bold">
                                                    Yes
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex
                                                       h-7 w-7
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-red-600
                                                       text-white
                                                       font-bold">

                                                    No
                                                </span>
                                            @endif

                                        </td>


                                        <td
                                            class="border border-gray-300
                                               bg-red-50/30
                                               p-3 text-center
                                               align-middle">

                                            @if ($item->rejected)
                                                <span
                                                    class="inline-flex
                                                       h-7 w-7
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-red-600
                                                       text-white
                                                       font-bold">
                                                    Yes
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex
                                                       h-7 w-7
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-red-600
                                                       text-white
                                                       font-bold">

                                                    No
                                                </span>
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="7"
                                            class="border border-gray-300
                                               p-8 text-center
                                               text-gray-400">
                                            No items recorded.
                                        </td>

                                    </tr>
                                @endforelse


                                {{-- Empty rows --}}

                                @for ($i = $goodsReceivedNote->items->count(); $i < 5; $i++)
                                    <tr>

                                        <td class="h-16 border border-gray-300"></td>

                                        <td class="border border-gray-300"></td>

                                        <td class="border border-gray-300"></td>

                                        <td class="border border-gray-300"></td>

                                        <td class="border border-gray-300"></td>

                                        <td class="border border-gray-300"></td>

                                        <td class="border border-gray-300"></td>

                                    </tr>
                                @endfor

                            </tbody>

                        </table>

                    </div>


                    {{-- ========================================================= --}}
                    {{-- NOTICE --}}
                    {{-- ========================================================= --}}

                    <div
                        class="mt-4
                           rounded-lg
                           border border-green-800
                           bg-green-800
                           px-4 py-3
                           text-center
                           text-sm
                           font-semibold
                           leading-4
                           text-white">

                        Goods / Materials received are delivered correctly
                        in terms of quantity, quality and other specifications
                        according to the specified PO.

                    </div>


                    {{-- ========================================================= --}}
                    {{-- SIGNATURE / RESPONSIBILITY --}}
                    {{-- ========================================================= --}}

                    <div class="mt-4">

                        <table class="w-full border-collapse
                               text-base">

                            <tr>

                                <td
                                    class="w-[20%]
                                       border border-gray-300
                                       bg-gray-50
                                       px-3 py-3
                                       font-bold text-gray-600">
                                    Delivered By
                                </td>

                                <td
                                    class="w-[30%]
                                       border border-gray-300
                                       px-3 py-3
                                       font-medium text-gray-800">
                                    {{ $goodsReceivedNote->delivered_by ?? ' ' }}
                                </td>

                                <td
                                    class="w-[15%]
                                       border border-gray-300
                                       bg-gray-50
                                       px-3 py-3
                                       font-bold text-gray-600">
                                    Date / Time
                                </td>

                                <td
                                    class="w-[35%]
                                       border border-gray-300
                                       px-3 py-3
                                       text-gray-800">

                                    {{ $goodsReceivedNote->delivered_date?->format('d-M-Y') ?? ' ' }}

                                    @if ($goodsReceivedNote->delivered_time)
                                        <span class="mx-2 text-gray-300">
                                            |
                                        </span>

                                        {{ substr($goodsReceivedNote->delivered_time, 0, 5) }}
                                    @endif

                                </td>

                            </tr>


                            <tr>

                                <td
                                    class="border border-gray-300
                                       bg-gray-50
                                       px-3 py-3
                                       font-bold text-gray-600">
                                    Received By
                                </td>

                                <td
                                    class="border border-gray-300
                                       px-3 py-3
                                       font-medium text-gray-800">
                                    {{ $goodsReceivedNote->received_by ?? ' ' }}
                                </td>

                                <td
                                    class="border border-gray-300
                                       bg-gray-50
                                       px-3 py-3
                                       font-bold text-gray-600">
                                    Date / Time
                                </td>

                                <td
                                    class="border border-gray-300
                                       px-3 py-3
                                       text-gray-800">

                                    {{ $goodsReceivedNote->received_date?->format('d-M-Y') ?? ' ' }}

                                    @if ($goodsReceivedNote->received_time)
                                        <span class="mx-2 text-gray-300">
                                            |
                                        </span>

                                        {{ substr($goodsReceivedNote->received_time, 0, 5) }}
                                    @endif

                                </td>

                            </tr>


                            <tr>

                                <td
                                    class="border border-gray-300
                                       bg-gray-50
                                       px-3 py-3
                                       font-bold text-gray-600">
                                    Inspected By
                                </td>

                                <td
                                    class="border border-gray-300
                                       px-3 py-3
                                       font-medium text-gray-800">
                                    {{ $goodsReceivedNote->inspected_by ?? ' ' }}
                                </td>

                                <td
                                    class="border border-gray-300
                                       bg-gray-50
                                       px-3 py-3
                                       font-bold text-gray-600">
                                    Date / Time
                                </td>

                                <td
                                    class="border border-gray-300
                                       px-3 py-3
                                       text-gray-800">

                                    {{ $goodsReceivedNote->inspected_date?->format('d-M-Y') ?? ' ' }}

                                    @if ($goodsReceivedNote->inspected_time)
                                        <span class="mx-2 text-gray-300">
                                            |
                                        </span>

                                        {{ substr($goodsReceivedNote->inspected_time, 0, 5) }}
                                    @endif

                                </td>

                            </tr>

                        </table>

                    </div>


                    {{-- ========================================================= --}}
                    {{-- COMMENTS --}}
                    {{-- ========================================================= --}}

                    <div class="mt-5">

                        <div
                            class="mb-2
                               font-bold
                               text-base
                               uppercase
                               tracking-wide
                               text-gray-700">
                            Further Comments
                        </div>


                        <div
                            class="min-h-[130px]
                               rounded-xl
                               border border-gray-300
                               bg-gray-50
                               p-4
                               text-sm
                               leading-5
                               text-gray-700">

                            @if ($goodsReceivedNote->comments)
                                {!! nl2br(e($goodsReceivedNote->comments)) !!}
                            @else
                                <span class="text-gray-400">
                                    No additional comments.
                                </span>
                            @endif

                        </div>

                    </div>


                    {{-- ========================================================= --}}
                    {{-- DOCUMENT FOOTER --}}
                    {{-- ========================================================= --}}

                    <div
                        class="mt-5 flex items-center
                           justify-between
                           border-t border-gray-200
                           pt-3
                           text-[9px]
                           text-gray-400">

                        <span>
                            Goods / Service Received Note — FM02-12
                        </span>

                        <span>
                            GRN: {{ $goodsReceivedNote->grn_no }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
