@extends('layout.app')

@section('content')
    <div class="max-w-full  mx-auto">

        <div class="print:hidden mb-5">

            <div
                class="
                    bg-white
                    border border-gray-200
                    shadow-sm
                    px-6 py-5
                    flex
                    flex-col
                    lg:flex-row
                    lg:items-center
                    lg:justify-between
                    gap-5
                ">

                {{-- LEFT --}}
                <div class="flex items-center gap-4">

                    <div
                        class="
                            w-12 h-12
                            bg-green-700
                            text-white
                            rounded-xl
                            flex
                            items-center
                            justify-center
                            shadow-sm
                        ">
                        <i class="fa-solid fa-file-invoice-dollar text-lg"></i>
                    </div>

                    <div>

                        <div class="flex items-center gap-3">

                            <h1 class="text-xl font-bold text-gray-900">
                                Invoice
                            </h1>

                            <span
                                class="
                                    px-3 py-1
                                    rounded-full
                                    bg-green-50
                                    text-green-700
                                    border border-green-100
                                    text-xs
                                    font-bold
                                ">
                                FM02-14
                            </span>

                        </div>

                        <p class="text-sm text-gray-500 mt-1">
                            INV {{ $invoice->invoice_no }}
                        </p>

                    </div>

                </div>


                {{-- ACTIONS --}}
                <div class="flex flex-wrap items-center gap-2">

                    <a href="{{ route('invoices.index') }}"
                        class="
                        inline-flex
                        items-center
                        gap-2
                        h-10
                        px-4
                        rounded-lg
                        bg-white
                        border border-gray-300
                        text-gray-600
                        hover:bg-gray-50
                        hover:text-gray-900
                        text-sm
                        font-semibold
                        transition
                    ">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Back
                    </a>


                    <a href="{{ route('invoices.edit', $invoice) }}"
                        class="
                        inline-flex
                        items-center
                        gap-2
                        h-10
                        px-4
                        rounded-lg
                        bg-amber-500
                        hover:bg-amber-600
                        text-white
                        text-sm
                        font-semibold
                        transition
                    ">
                        <i class="fa-solid fa-pen text-xs"></i>
                        Edit
                    </a>


                    <a href="{{ route('invoices.pdf', $invoice) }}" target="_blank"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            h-10
                            px-5
                            rounded-lg
                            bg-green-700
                            hover:bg-green-800
                            text-white
                            text-sm
                            font-semibold
                            shadow-sm
                            transition
                        ">

                        <i class="fa-solid fa-file-pdf text-xs"></i>

                        Export PDF

                    </a>

                </div>

            </div>

        </div>


        <div id="invoice"
            class="
                bg-white
                border border-gray-300
                shadow-[0_8px_35px_rgba(0,0,0,0.08)]
                overflow-hidden
                print:border-none
                print:shadow-none
            ">

            <div class="p-8 lg:p-10 print:p-0">

                <div
                    class="
                        grid
                        grid-cols-12
                        border-b-[3px]
                        border-green-700
                        pb-5
                    ">

                    {{-- COMPANY --}}
                    <div class="col-span-8 pr-6">

                        <div class="flex items-start justify-between gap-4">

                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto object-contain">

                            <div>

                                <h2
                                    class="
                                    text-lg
                                    font-extrabold
                                    text-gray-900
                                ">
                                    THT NGO FORUM ON CAMBODIA
                                </h2>

                                <div
                                    class="
                                    mt-2
                                    text-[11px]
                                    leading-5
                                    text-gray-600
                                ">

                                    <div>
                                        #9-11, St. 476, Sangkat Toul Tompoung I,
                                        Khan Chamkarmon, Phnom Penh
                                    </div>

                                    <div>
                                        Tel: (+855) 78 550 449
                                        &nbsp; | &nbsp;
                                        Fax: (+855) 78 550 449
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- TITLE --}}
                    <div
                        class="
                        col-span-4
                        flex
                        flex-col
                        justify-center
                        items-end
                        text-right
                    ">

                        <div
                            class="
                            text-[10px]
                            font-bold
                            uppercase
                            tracking-[0.2em]
                            text-gray-400
                        ">
                            Form Code
                        </div>

                        <div
                            class="
                            text-sm
                            font-bold
                            text-green-700
                            mt-1
                        ">
                            FM02-14
                        </div>

                        <h1
                            class="
                            mt-2
                            text-4xl
                            font-black
                            tracking-[0.15em]
                            text-gray-900
                        ">
                            INVOICE
                        </h1>

                    </div>

                </div>



                <div
                    class="
                    grid
                    grid-cols-12
                    mt-6
                    border border-gray-300
                ">

                    {{-- LEFT INFORMATION --}}
                    <div
                        class="
                        col-span-7
                        border-r border-gray-300
                    ">

                        <div
                            class="
                            px-4 py-2.5
                            bg-gray-50
                            border-b border-gray-300
                            text-[10px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-gray-500
                        ">
                            Customer Information
                        </div>


                        {{-- CUSTOMER --}}
                        <div
                            class="
                            grid
                            grid-cols-12
                            border-b border-gray-200
                        ">

                            <div
                                class="
                                col-span-4
                                px-4 py-3
                                text-[10px]
                                font-bold
                                uppercase
                                text-gray-500
                                bg-gray-50
                                border-r border-gray-200
                            ">
                                Customer
                            </div>

                            <div
                                class="
                                col-span-8
                                px-4 py-3
                                text-sm
                                font-semibold
                                text-gray-900
                            ">
                                {{ $invoice->customer ?? '-' }}
                            </div>

                        </div>


                        {{-- COMPANY --}}
                        <div
                            class="
                                grid
                                grid-cols-12
                                border-b border-gray-200
                            ">

                            <div
                                class="
                                col-span-4
                                px-4 py-3
                                text-[10px]
                                font-bold
                                uppercase
                                text-gray-500
                                bg-gray-50
                                border-r border-gray-200
                            ">
                                ENTITY​/CUSTOMER
                            </div>

                            <div
                                class="
                                col-span-8
                                px-4 py-3
                                text-sm
                                font-semibold
                                text-gray-900
                            ">
                                {{ $invoice->company ?? '-' }}
                            </div>

                        </div>


                        {{-- ADDRESS --}}
                        <div
                            class="
                            grid
                            grid-cols-12
                            border-b border-gray-200
                        ">

                            <div
                                class="
                                col-span-4
                                px-4 py-3
                                text-[10px]
                                font-bold
                                uppercase
                                text-gray-500
                                bg-gray-50
                                border-r border-gray-200
                            ">
                                Address
                            </div>

                            <div
                                class="
                                col-span-8
                                px-4 py-3
                                text-xs
                                leading-5
                                text-gray-700
                            ">
                                {{ $invoice->address ?? '-' }}
                            </div>

                        </div>


                        {{-- TELEPHONE --}}
                        <div
                            class="
                            grid
                            grid-cols-12
                        ">

                            <div
                                class="
                                col-span-4
                                px-4 py-3
                                text-[10px]
                                font-bold
                                uppercase
                                text-gray-500
                                bg-gray-50
                                border-r border-gray-200
                            ">
                                Telephone
                            </div>

                            <div
                                class="
                                col-span-8
                                px-4 py-3
                                text-xs
                                text-gray-700
                            ">
                                {{ $invoice->telephone ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- RIGHT INFORMATION --}}
                    <div class="col-span-5">

                        <div
                            class="
                            px-4 py-2.5
                            bg-gray-50
                            border-b border-gray-300
                            text-[10px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-gray-500
                        ">
                            Invoice Details
                        </div>


                        {{-- INVOICE NO --}}
                        <div
                            class="
                            flex
                            items-center
                            justify-between
                            px-4
                            py-4
                            border-b border-gray-200
                        ">

                            <span
                                class="
                                text-[10px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-gray-500
                            ">
                                Invoice No.
                            </span>

                            <span
                                class="
                                text-sm
                                font-extrabold
                                text-green-700
                            ">
                                {{ $invoice->invoice_no }}
                            </span>

                        </div>


                        {{-- DATE --}}
                        <div
                            class="
                            flex
                            items-center
                            justify-between
                            px-4
                            py-4
                            border-b border-gray-200
                        ">

                            <span
                                class="
                                text-[10px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-gray-500
                            ">
                                Invoice Date
                            </span>

                            <span
                                class="
                                text-xs
                                font-semibold
                                text-gray-800
                            ">
                                {{ $invoice->invoice_date?->format('d-M-Y') ?? '-' }}
                            </span>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- ITEMS --}}
                {{-- ================================================= --}}

                <div class="mt-7">

                    <div
                        class="
                        flex
                        items-center
                        justify-between
                        mb-2
                    ">

                        <h2
                            class="
                            text-sm
                            font-bold
                            uppercase
                            tracking-wider
                            text-gray-900
                        ">
                            Invoice Items
                        </h2>

                        <span
                            class="
                            text-[10px]
                            uppercase
                            tracking-wider
                            text-gray-400
                        ">
                            {{ $invoice->items->count() }}
                            {{ Str::plural('Item', $invoice->items->count()) }}
                        </span>

                    </div>


                    <div class="overflow-x-auto">

                        <table
                            class="
                            w-full
                            border-collapse
                            border border-gray-300
                            text-xs
                        ">

                            <thead>

                                <tr class="bg-gray-900 text-white">

                                    <th
                                        class="
                                        border border-gray-700
                                        px-3 py-3
                                        text-center
                                        w-12
                                    ">
                                        #
                                    </th>

                                    <th
                                        class="
                                        border border-gray-700
                                        px-4 py-3
                                        text-left
                                    ">
                                        Description of Goods or Service
                                    </th>

                                    <th
                                        class="
                                        border border-gray-700
                                        px-3 py-3
                                        text-center
                                        w-24
                                    ">
                                        Quantity
                                    </th>

                                    <th
                                        class="
                                        border border-gray-700
                                        px-3 py-3
                                        text-right
                                        w-32
                                    ">
                                        Unit Price
                                    </th>

                                    <th
                                        class="
                                        border border-gray-700
                                        px-3 py-3
                                        text-right
                                        w-36
                                    ">
                                        Amount
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($invoice->items as $item)
                                    <tr>

                                        <td
                                            class="
                                            border border-gray-300
                                            px-3 py-3
                                            text-center
                                            text-gray-500
                                        ">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td
                                            class="
                                            border border-gray-300
                                            px-4 py-3
                                            text-gray-800
                                        ">
                                            {{ $item->description }}
                                        </td>

                                        <td
                                            class="
                                            border border-gray-300
                                            px-3 py-3
                                            text-center
                                        ">
                                            {{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }}
                                        </td>

                                        <td
                                            class="
                                            border border-gray-300
                                            px-3 py-3
                                            text-right
                                        ">
                                            $ {{ number_format($item->unit_price, 2) }}
                                        </td>

                                        <td
                                            class="
                                            border border-gray-300
                                            px-3 py-3
                                            text-right
                                            font-semibold
                                        ">
                                            $ {{ number_format($item->amount, 2) }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5"
                                            class="
                                            border border-gray-300
                                            px-4 py-10
                                            text-center
                                            text-gray-400
                                        ">
                                            No invoice items found.
                                        </td>

                                    </tr>
                                @endforelse


                                {{-- EMPTY ROWS --}}
                                @for ($i = $invoice->items->count(); $i < 8; $i++)
                                    <tr>

                                        <td class="border border-gray-300 h-9"></td>
                                        <td class="border border-gray-300"></td>
                                        <td class="border border-gray-300"></td>
                                        <td class="border border-gray-300"></td>
                                        <td class="border border-gray-300"></td>

                                    </tr>
                                @endfor


                                {{-- GRAND TOTAL --}}
                                <tr>

                                    <td colspan="4"
                                        class="
                                        border border-gray-300
                                        px-4 py-4
                                        text-right
                                        bg-gray-50
                                        font-bold
                                        uppercase
                                        tracking-wider
                                    ">
                                        Grand Total
                                    </td>

                                    <td
                                        class="
                                        border border-gray-300
                                        px-4 py-4
                                        text-right
                                        bg-green-700
                                        text-white
                                        font-black
                                        text-base
                                    ">
                                        $ {{ number_format($invoice->grand_total, 2) }}
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- AMOUNT IN WORDS --}}
                {{-- ================================================= --}}

                <div
                    class="
                    border border-gray-300
                    bg-gray-50
                    px-4 py-4
                ">

                    <div class="flex flex-col sm:flex-row gap-2">

                        <span
                            class="
                            shrink-0
                            text-sm
                            font-bold
                            uppercase
                            tracking-wider
                            text-gray-500
                        ">
                            Amount in Words:
                        </span>

                        <span
                            class="
                            text-base
                            font-semibold
                            italic
                            text-gray-800
                        ">
                            {{ $invoice->amount_in_words ?? '-' }}
                        </span>

                    </div>

                </div>


                <div class="grid grid-cols-12 mt-6">

                    {{-- ================================================= --}}
                    {{-- PAYMENT TERMS --}}
                    {{-- ================================================= --}}
                    <div class="col-span-8 border border-gray-300">

                        <div
                            class="
                            px-4 py-2.5
                            bg-gray-900
                            text-white
                            text-base
                            font-bold
                            uppercase
                            tracking-wider
                        ">
                            Payment Terms
                        </div>

                        <div
                            class="
                            px-4 py-4
                            text-sm
                            leading-7
                            text-gray-700
                        ">
                            <p>1- By check address to NGO FORUM ON CAMBODIA</p>
                            <p>2- By bank transfer: Bank Name: ACLEDA BANK Plc.</p>
                            <p>Address: #61, Preah Monivong Blvd., Sankat Srah Chork , Khan Daun Penh</p>
                            <p>Bank Account Name: NGO FORUM ON CAMBODIA.</p>
                            <p>Bank Account #: 0900-10-166036-29, SWIFT: ACLBKHPP.</p>
                        </div>

                    </div>



                    {{-- ================================================= --}}
                    {{-- SIGNATURE / ISSUED BY --}}
                    {{-- ================================================= --}}


                    <div class="col-span-4">

                        <div
                            class="
                            border
                            border-gray-300
                            p-5
                        ">

                            <div
                                class="
                                text-center
                                text-base
                                font-bold
                                uppercase
                                tracking-wider
                                text-gray-500
                            ">
                                Issued By
                            </div>


                            <div
                                class="
                                h-20
                                mt-6
                                border-b
                                border-gray-700
                            ">
                            </div>


                            <div
                                class="
                                text-center
                                mt-2
                                text-sm
                                text-gray-500
                            ">
                                Signature & Name
                            </div>


                            <div
                                class="
                                text-center
                                mt-2
                                text-xs
                                font-bold
                                text-gray-900
                            ">
                                {{ $invoice->issued_by ?? '-' }}
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
