@extends('layout.app')

@section('content')
    <!-- Print Action Bar -->
    <div class="max-w-full mx-auto mb-4 flex justify-end print:hidden">
        <button onclick="window.print()"
            class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-md shadow flex items-center gap-2">
            <i class="fa-solid fa-print"></i> Print Payment Slip
        </button>
    </div>

    <!-- Printable Slip Wrapper -->
    <div
        class="max-w-full mx-auto grid grid-cols-2 gap-10 bg-white p-4 shadow-sm print:shadow-none print:border-none print:p-1.5 print:w-full">

        @for ($i = 0; $i < 2; $i++)
            <!-- Voucher Card -->
            <div
                class="voucher-card border border-gray-700 flex flex-col justify-between text-xs font-sans text-black bg-white">

                <!-- Watermark -->
                <div class="watermark">
                    <img src="{{ asset('images/logo.png') }}" alt="Watermark">
                </div>

                <div>
                    <!-- Header Section -->
                    <div class="px-4 py-2 flex items-center justify-between mb-1">
                        <div class="w-1/4">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto object-contain">
                        </div>
                        <div class="w-3/4 text-center">
                            <img src="{{ asset('images/exp.jpg') }}" alt="Logo" class="h-16 w-auto object-contain">
                        </div>
                    </div>

                    <!-- Address & Title Box -->
                    <div class="grid grid-cols-12 border-t border-black text-[12px]">
                        <div class="col-span-7 border-r border-black p-1.5 leading-1.8">
                            #9-11, St. 476, Sangkat Toul <br>
                            Tompoung I, Khan Chamkarmon, <br>
                            Phnom Penh. Tel: (+855) 78 550 449,<br>
                            Fax(+855)78 550 449
                        </div>
                        <div class="col-span-5 text-center flex flex-col justify-center">
                            <div class="font-bold text-lg py-1 border-b border-black">ប័ណ្ណចំណាយ</div>
                            <div class="font-bold bg-gray-100 text-lg py-1 text-green-600">PAYMENT SLIP</div>
                        </div>
                    </div>

                    <!-- Meta Details Form Grid -->
                    <div class="border-t border-black text-[11px]">
                        <div class="grid grid-cols-12 border-b border-black">
                            <div class="col-span-5 p-1">កាលបរិច្ឆេទ Date:</div>
                            <div class="col-span-7 p-1"></div>
                        </div>
                        <div class="grid grid-cols-12 border-b border-black">
                            <div class="col-span-5 p-1">ឈ្មោះអ្នកផ្គត់ផ្គង់ To the order
                                of:</div>
                            <div class="col-span-7 p-1"></div>
                        </div>
                        <div class="grid grid-cols-12 border-b border-black">
                            <div class="col-span-5 p-1">ព័ត៌មានទំនាក់ទំនង Contact
                                Information:</div>
                            <div class="col-span-7 p-1"></div>
                        </div>
                        <div class="grid grid-cols-12">
                            <div class="col-span-6 p-1">គោលបំណងនៃចំណាយ Purpose of
                                payment:</div>
                            <div class="col-span-6 p-1"></div>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <table class="w-full border-collapse border-t border-black text-center text-[11px]">
                        <thead>
                            <tr class="bg-green-50 text-black font-bold border-b border-black">
                                <th class="border-r border-black p-1 w-8">ល.រ</th>
                                <th class="border-r border-black p-1">ពិពណ៌នា</th>
                                <th class="border-r border-black p-1 w-16">បរិមាណ</th>
                                <th class="border-r border-black p-1 w-20">ថ្លៃឯកតា</th>
                                <th class="border-t border-black p-1 w-20">ចំនួន</th>
                            </tr>
                            <tr class="bg-green-50 text-black font-bold border-b border-black">
                                <th class="border-r border-black p-1">No</th>
                                <th class="border-r border-black p-1">Description</th>
                                <th class="border-r border-black p-1">Qty</th>
                                <th class="border-r border-black p-1">Unit Price</th>
                                <th class="border-t border-black p-1">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table Body Rows -->
                            @for ($r = 0; $r < 8; $r++)
                                <tr class="h-8">
                                    <td class="border-t border-r border-black"></td>
                                    <td class="border-t border-r border-black"></td>
                                    <td class="border-t border-r border-black"></td>
                                    <td class="border-t border-r border-black"></td>
                                    <td class="border-t border-black"></td>
                                </tr>
                            @endfor
                            <!-- Total Row -->
                            <tr class="font-bold border-t border-black">
                                <td colspan="4" class="border-r border-black p-1 text-right pr-2">សរុប TOTAL</td>
                                <td class="border-t border-black p-1"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <!-- Signatures Section -->
                    <div class="border-r border-t border-b border-gray-700 text-[12px]">
                        <div class="grid grid-cols-12 border-b border-black">
                            <div class="col-span-9 border-r border-black p-1.5 font-semibold">ទូទាត់ដោយ Paid By:</div>
                            <div class="col-span-3 p-1.5 font-semibold">Date</div>
                        </div>
                        <div class="grid grid-cols-12 border-b border-black">
                            <div class="col-span-9 border-r border-black p-1.5 font-semibold">ទទួលបានដោយ Received By:</div>
                            <div class="col-span-3 p-1.5 font-semibold">Date</div>
                        </div>
                        <div class="grid grid-cols-12">
                            <div class="col-span-9 border-r border-black p-1.5 font-semibold">អនុម័ត Approved By:</div>
                            <div class="col-span-3 p-1.5 font-semibold">Date</div>
                        </div>
                    </div>

                    <!-- Footer Disclaimer -->
                    <div class="text-[12px] text-center font-semibold leading-1.8 p-1">
                        ប័ណ្ណចំណាយនេះត្រូវបានប្រើប្រាស់សម្រាប់ចំណាយដែលមិនមានឯកសារយោងច្បាស់លាស់ ឬជាចំណាយរួមទទួលខុសត្រូវ
                        និងបានធានាថា ការចាត់ចែងពិតជាគ្មានការកេងប្រវ័ញ្ចឡើយ
                    </div>
                </div>
            </div>
        @endfor

    </div>

    <!-- Print Styles override to fit A4 Landscape -->
    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 5mm;
            }

            body {
                background-color: white !important;
            }

            header,
            nav,
            .navbar,
            .no-print {
                display: none !important;
            }

            main {
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }
        }

        .voucher-card {
            position: relative;
            overflow: hidden;
            border: 1px solid #444;
            background: #fff;
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
            width: 320px;
            opacity: 0.06;
        }

        .voucher-content {
            position: relative;
            z-index: 1;
        }
    </style>
@endsection
