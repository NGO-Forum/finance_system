@extends('layout.app')

@section('content')
    {{-- PRINT ACTION BAR --}}
    <div class="max-w-full mx-auto mb-4 flex justify-end print:hidden">
        <button onclick="window.print()"
            class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-md shadow flex items-center gap-2">
            <i class="fa-solid fa-print"></i>
            Print Receipt
        </button>
    </div>

    {{-- PRINTABLE RECEIPTS (Renders 2 Side-by-Side per A4 Page) --}}
    <div
        class="max-w-full mx-auto grid grid-cols-1 gap-6 bg-white p-4 shadow-sm print:shadow-none print:border-none print:p-0 print:w-full print:gap-9">

        @for ($i = 0; $i < 2; $i++)
            <div class="receipt-card relative overflow-hidden border border-black bg-white text-black font-sans">

                {{-- WATERMARK --}}
                <div class="watermark">
                    <img src="{{ asset('images/logo.png') }}" alt="Watermark">
                </div>

                {{-- RECEIPT CONTENT --}}
                <div class="receipt-content">

                    {{-- HEADER --}}
                    <div class="grid grid-cols-12 border-b border-black">
                        {{-- ORGANIZATION & BRANDING --}}
                        <div class="col-span-8 border-r border-black flex flex-col justify-between">
                            {{-- LOGOS CONTAINER --}}
                            <div class="p-3 flex items-center gap-4 h-16">
                                <div class="w-1/3 flex justify-start">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                                        class="h-14 max-w-full object-contain">
                                </div>
                                <div class="w-3/3 flex justify-center">
                                    <img src="{{ asset('images/exp.jpg') }}" alt="Expansion Logo"
                                        class="h-16 max-w-full object-contain">
                                </div>
                            </div>

                            {{-- ADDRESS --}}
                            <div
                                class="border-t border-black bg-gray-50/50 px-3 py-1.5 text-[12px] leading-relaxed text-gray-800">
                                <p class="font-medium">#9-11, St. 476, Sangkat Toul Tompoung I, Khan Chamkarmon, Phnom Penh.
                                </p>
                                <p class="text-gray-600">Tel: (+855) 78 550 449 &nbsp;|&nbsp; Fax: (+855) 78 550 449</p>
                            </div>
                        </div>

                        {{-- RECEIPT TITLE & NUMBER --}}
                        <div class="col-span-4 flex flex-col justify-between relative bg-gray-50/30">
                            {{-- FORM CODE --}}
                            <span
                                class="absolute top-1.5 right-2 text-[9px] text-emerald-700 font-mono font-semibold tracking-wider">
                                FM02-13
                            </span>

                            {{-- TITLE --}}
                            <div class="pt-6 px-3">
                                <span
                                    class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest leading-none mb-1">
                                    Official
                                </span>
                                <h1 class="text-2xl font-black text-black tracking-wider leading-none mt-3">
                                    RECEIPT
                                </h1>
                            </div>

                            {{-- RECEIPT NO. BOX --}}
                            <div class="border-t border-black grid grid-cols-12 bg-white">
                                <div
                                    class="col-span-5 border-r border-black px-2 py-2 text-[14px] font-bold text-gray-700 uppercase flex items-center">
                                    Receipt No:
                                </div>
                                <div
                                    class="col-span-7 px-2 py-2 text-[11px] font-bold text-black font-mono flex items-center truncate">
                                    {{ $receipt->receipt_no ?? ' ' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RECEIVED FROM --}}
                    <div class="grid grid-cols-12">
                        <div class="col-span-8 border-r border-black px-2 py-1.5 text-[14px] bg-green-100">
                            <span class="font-bold">RECEIVED FROM</span>
                            <span class="mx-2">:</span>
                        </div>
                        <div class="col-span-2 px-2 py-1.5 text-[14px]">
                            DATE
                            <span class="mx-1">:</span>
                        </div>
                    </div>

                    {{-- ADDRESS + DATE --}}
                    <div class="grid grid-cols-12 border-t border-black">
                        <div class="col-span-12 px-2 py-1.5 text-[14px]">
                            <span class="font-bold">ADDRESS</span>
                            <span class="mx-5">:</span>
                            {{ $receipt->address ?? '' }}
                        </div>
                        
                    </div>

                    {{-- PAYMENT FOR + AMOUNT --}}
                    <div class="grid grid-cols-12 border-t border-black">
                        {{-- PAYMENT FOR --}}
                        <div class="col-span-8 border-r border-black bg-green-100 min-h-[90px]">
                            <div class="px-2 py-2 text-[14px] font-bold">
                                PAYMENT FOR
                                <span class="mx-2">:</span>
                                <span class="font-normal">
                                    {{ $receipt->payment_for ?? '' }}
                                </span>
                            </div>
                        </div>

                        {{-- AMOUNT --}}
                        <div class="col-span-4 bg-green-100 min-h-[90px]">
                            <div class="px-2 pt-2 text-[14px] font-bold">AMOUNT</div>
                            <div class="px-2 pt-1 text-[16px] font-bold">
                                
                            </div>
                            <div class="px-2 pt-1 text-[12px]">In word:</div>
                            <div class="px-2 text-[10px] leading-[13px]">
                            </div>
                        </div>
                    </div>

                    {{-- REFERENCE + METHOD --}}
                    <div class="grid grid-cols-12 border-t border-black">
                        {{-- REFERENCE DOCUMENT --}}
                        <div class="col-span-8 border-r border-black">
                            <div class="px-2 py-1 text-[14px] text-green-800">
                                REFERENCE DOCUMENT
                            </div>
                            <div class="grid grid-cols-12 border-t border-black">
                                <div class="col-span-3 border-r border-black px-2 py-1 text-[14px] text-green-800">
                                    Invoice No.
                                </div>
                                <div class="col-span-9 px-2 py-1 text-[14px]">
                                    {{ $receipt->invoice_no ?? '' }}
                                </div>
                            </div>
                            <div class="grid grid-cols-12 border-t border-black">
                                <div class="col-span-3 border-r border-black px-2 py-1 text-[14px] text-green-800">
                                    Voucher No.
                                </div>
                                <div class="col-span-9 px-2 py-1 text-[14px]">
                                    {{ $receipt->voucher_no ?? '' }}
                                </div>
                            </div>
                            <div class="grid grid-cols-12 border-t border-black">
                                <div class="col-span-3 border-r border-black px-2 py-1 text-[14px] text-green-800">
                                    Agreement No.
                                </div>
                                <div class="col-span-9 px-2 py-1 text-[10px]">
                                    {{ $receipt->agreement_no ?? '' }}
                                </div>
                            </div>
                            <div class="px-2 py-2 text-[10px] leading-1.5 border-t border-black">
                                The official receipt is considered official only it bears the genuine authorized signature
                                of NGOF Staff.
                            </div>
                        </div>

                        {{-- METHOD OF RECEIPT --}}
                        <div class="col-span-4 relative">
                            <div class="px-2 py-1 text-[14px]">
                                METHOD OF RECEIPT
                            </div>
                            <div class="px-3 text-[14px] leading-1.5">
                                <div>
                                    <span
                                        class="text-[17px]">{{ ($receipt->method_of_receipt ?? '') === 'Cash' ? '◉' : '○' }}</span>
                                    Cash
                                </div>
                                <div>
                                    <span
                                        class="text-[17px]">{{ ($receipt->method_of_receipt ?? '') === 'Bank Transfer' ? '◉' : '○' }}</span>
                                    Bank Transfer
                                </div>
                                <div>
                                    <span
                                        class="text-[17px]">{{ ($receipt->method_of_receipt ?? '') === 'Direct Debit/QR' ? '◉' : '○' }}</span>
                                    Direct Debit/QR
                                </div>
                                <div>
                                    <span
                                        class="text-[17px]">{{ ($receipt->method_of_receipt ?? '') === 'Check' ? '◉' : '○' }}</span>
                                    Check (please check no. below)
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SIGNATURES --}}
                    <div class="grid grid-cols-12 border-t border-black">
                        {{-- ON BEHALF --}}
                        <div class="col-span-8 border-r border-black h-[90px] flex items-center">
                            <div class="w-full grid grid-cols-12 items-end px-2 py-3">
                                <div class="col-span-4 font-bold text-[14px]">
                                    On behalf of NGOF
                                </div>
                                <div class="col-span-8 border-b border-gray-300 h-[25px]"></div>
                            </div>
                        </div>

                        {{-- PAID BY --}}
                        <div class="col-span-4 h-[90px] flex items-center">
                            <div class="w-full grid grid-cols-12 items-end px-2 py-3">
                                <div class="col-span-4 font-bold text-[14px]">
                                    Paid By
                                </div>
                                <div class="col-span-8 border-b border-gray-300 h-[25px]"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endfor

    </div>

    {{-- PRINT STYLES --}}
    <style>
        .receipt-card {
            min-height: 520px;
            position: relative;
            overflow: hidden;
        }

        .receipt-content {
            position: relative;
            z-index: 2;
        }

        .watermark {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 0;
            pointer-events: none;
        }

        .watermark img {
            width: auto;
            height: 250px;
            opacity: 0.06;
        }

        @media print {
            @page {
                size: A4 Portrait;
                margin: 6mm;
            }

            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                background: #ffffff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            header,
            nav,
            .navbar,
            footer,
            .no-print,
            .print\:hidden {
                display: none !important;
            }

            main {
                margin: 0 !important;
                padding: 0 !important;
            }
        }
    </style>
@endsection
