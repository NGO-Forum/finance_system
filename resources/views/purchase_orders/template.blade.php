<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purchase Order</title>
    <style>
        @page {
            margin: 5mm;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            /* Recommended font for Unicode/Khmer support in PDF drivers */
            font-size: 13px;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 6px 8px;
            vertical-align: top;
        }

        .border-all {
            border: 1px solid #d1d5db;
        }

        .h-12 {
            height: 30px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        /* Table base borders */
        .table-bordered {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #d1d5db;
            padding: 6px 8px;
            vertical-align: middle;
        }

        /* Header section specifics */
        .header-box {
            padding: 6px 16px;
            display: inline-block;
        }

        .header-title {
            color: #008234;
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        /* Section styling */
        .bg-light-green {
            background-color: #e6f4ea;
            font-weight: bold;
            font-size: 12px;
            letter-spacing: 0.3px;
            padding: 8px;
        }


        /* Totals styling */
        .totals-table td {
            padding: 5px 8px;
            border: 1px solid #d1d5db;
        }

        /* Signatures styling */
        .signature-box {
            height: 120px;
            position: relative;
        }

        .signature-details {
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="border-all">

        {{-- TOP HEADER & LOGOS --}}
        <table>
            <tr>
                <td style="width: 20%;" class="text-center">
                    <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 65px; width: auto;">
                </td>
                <td style="width: 70%;" class="text-center">
                    <img src="{{ public_path('images/exp.jpg') }}" alt="NGO Forum" style="height: 65px; width: auto;">
                </td>
                <td style="width: 10%;" class="text-right">
                    <span style="font-weight: 500; color: #4b5563;">FM02-11</span>
                </td>
            </tr>
        </table>

        {{-- TOP ADDRESS & TITLE HEADER --}}
        <table class="table-bordered">
            <tr>
                <td colspan="8" class="text-center">
                    <div class="header-box">
                        <span class="header-title">ប័ណ្ណបញ្ជាទិញ Purchase Order</span>
                    </div>
                </td>
                <td colspan="4" style="padding: 0;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 55%;" class="font-bold">កាលបរិច្ឆេទ
                                Date:</td>
                            <td style="width: 45%;" class="font-bold text-left">

                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">លេខបញ្ជាទិញ PO No.</td>
                            <td class="font-bold text-center">
                                {{-- {{ $purchaseOrder->po_no }} --}}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">លេខសំណើទិញ PR No.</td>
                            <td class="font-bold text-center">
                                {{-- {{ $purchaseOrder->pr_no }} --}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="12" style="font-size: 11px; line-height: 1.7;">
                    #9-11, St. 476, Sangkat Toul Tompoung I, Khan
                    Chamkarmon, Phnom Penh.
                    Tel: (+855) 78 550 449,
                    Fax: (+855) 78 550 449
                </td>
            </tr>
        </table>

        {{-- SUPPLIER & DELIVERY DETAILS TABLE --}}
        <table class="table-bordered" style="border-top: none;">
            <!-- Row 1: Headers -->
            <tr>
                <td style="width: 50%;" class="bg-light-green">ព័ត៌មានអ្នកផ្គត់ផ្គង់ SUPPLIER INFORMATION</td>
                <td style="width: 50%;" class="bg-light-green">អាស័យដ្ឋានដឹកជញ្ជូន DELIVERED TO ADDRESS</td>
            </tr>
            <!-- Row 1: Content -->
            <tr>
                <td class="font-bold" style="height: 80px; vertical-align: top;">

                </td>
                <td style="vertical-align: top;"></td>
            </tr>

            <!-- Row 2: Headers -->
            <tr>
                <td class="bg-light-green">ល័ក្ខខ័ណ្ឌទូទាត់ TERM OF PAYMENT</td>
                <td class="bg-light-green">កាលបរិច្ឆេទប្រគល់ DELIVERY DATE</td>
            </tr>
            <!-- Row 2: Content -->
            <tr>
                <td style="height: 50px;"></td>
                <td>

                </td>
            </tr>

            <!-- Row 3: Headers -->
            <tr>
                <td class="bg-light-green">មធ្យោបាយទទូទាត់ MODE OF PAYMENT</td>
                <td class="bg-light-green">ល័ក្ខខ័ណ្ឌដឹកជញ្ជូន TERM OF DELIVERY</td>
            </tr>
            <!-- Row 3: Content -->
            <tr>
                <td style="height: 50px;"></td>
                <td></td>
            </tr>
        </table>

        {{-- ITEMS & TOTALS TABLE --}}
        <table class="table-bordered" style="border-top: none; font-size: 12px;">
            <thead>
                <tr class="bg-light-green">
                    <th style="width: 6%;" class="text-center">លេខ</th>
                    <th style="width: 40%;" class="text-left">ពិព៍ណនា​</th>
                    <th style="width: 14%;" class="text-center">កាលបរិច្ឆេទ</th>
                    <th style="width: 8%;" class="text-center">ឯកតា</th>
                    <th style="width: 8%;" class="text-center">បរិមាណ</th>
                    <th style="width: 10%;" class="text-center">តម្លៃឯកតា</th>
                    <th style="width: 9%;" class="text-center">ទឹកប្រាក់</th>
                </tr>
                <tr class="bg-light-green">
                    <th class="text-center">Item</th>
                    <th class="text-left">Description</th>
                    <th class="text-center">Required Date</th>
                    <th class="text-center">Unit</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- Fill empty rows up to 5 --}}
                @for ($i = 1; $i <= 7; $i++)
                    <tr>
                        <td class="text-center h-12">{{ $i }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endfor
            </tbody>
        </table>

        {{-- NOTES & SUMMARY TOTALS --}}
        <table class="table-bordered" style="border-top: none;">
            <tr>
                {{-- Notes Column --}}
                <td style="width: 60%; padding: 8px; font-size: 11px; line-height: 1.5;" class="align-top">
                    <strong>Note:</strong>
                    <p style="margin: 6px 0 0 0;  color: #4b5563;">
                        1. Please notify us immediately if you are unable to deliver as specified.<br>
                        2. Check will be used to settle this order if the settled amount is equal to or greater than
                        USD150.<br>
                        3. Please send all correspondence to address above.
                    </p>
                </td>

                {{-- Totals Column --}}
                {{-- Totals Column --}}
                <td style="width: 40%; padding: 0;" class="align-top">

                    <table class="totals-table"
                        style="
                            width: 100%;
                            border-collapse: collapse;
                            font-size: 11px;
                        ">

                        {{-- SUB TOTAL --}}
                        <tr>

                            <td class="font-bold">
                                SUB TOTAL
                            </td>

                            <td class="text-right font-bold" style="width: 35%;">
                                &nbsp;
                            </td>

                        </tr>


                        {{-- SERVICE CHARGE --}}
                        <tr>

                            <td class="font-bold">
                                Service Charge
                            </td>

                            <td class="text-right" style="width: 35%;">
                                &nbsp;
                            </td>

                        </tr>


                        {{-- OTHER TAX CHARGE --}}
                        <tr>

                            <td class="font-bold">
                                Other Tax charge
                            </td>

                            <td class="text-right" style="width: 35%;">
                                &nbsp;
                            </td>

                        </tr>


                        {{-- VAT / WITHHOLDING TAX --}}
                        <tr>

                            <td class="font-bold">
                                Tax (VAT or Withholding)
                            </td>

                            <td class="text-right" style="width: 35%;">
                                &nbsp;
                            </td>

                        </tr>


                        {{-- OTHER CHARGES --}}
                        <tr>

                            <td class="font-bold">
                                Other charges
                            </td>

                            <td class="text-right" style="width: 35%;">
                                &nbsp;
                            </td>

                        </tr>


                        {{-- TOTAL --}}
                        <tr>

                            <td class="font-bold"
                                style="
                                    font-size: 12px;
                                    background-color: #dbe5f1;
                                ">
                                Total
                            </td>

                            <td class="text-right font-bold"
                                style="
                                    font-size: 12px;
                                    background-color: #dbe5f1;
                                    color: #000;
                                ">
                                &nbsp;
                            </td>

                        </tr>

                    </table>

                </td>
            </tr>
        </table>

        {{-- AUTHORIZATION & VENDOR SIGNATURES --}}
        <table class="table-bordered" style="border-top: none;">
            <tr>
                {{-- Ordered By --}}
                <td style="width: 30%;" class="signature-box">
                    <strong style="font-size: 11px;">បញ្ជាទិញដោយ Ordered by:</strong><br><br><br><br><br><br><br>
                    <div class="signature-details">
                        Name: <br><br>
                        Position:<br><br>
                        Date:
                    </div>
                </td>

                {{-- Approved By --}}
                <td style="width: 30%;" class="signature-box">
                    <strong style="font-size: 11px;">អនុម័តដោយ Approved by:</strong><br><br><br><br><br><br><br>
                    <div class="signature-details">
                        Name: <br><br>
                        Position:<br><br>
                        Date:
                    </div>
                </td>

                {{-- Vendor Acceptance --}}
                <td style="width: 40%; line-height: 1.6;" class="signature-box">
                    <strong style="font-size: 11px;">Vendor Acceptance</strong><br>
                    <span style="font-size: 10px; color: #6b7280;">I hereby accept the terms and conditions in the
                        contract and purchase order. <br> ខ្ញុំបានឯកភាពនិងទទួលយកតាមលក្ខ័ណបញ្ជាទិញនេះ</span><br>

                    <div style="margin-top: 8px; font-size: 11px;">
                        Vendor Name: <br><br>
                        Position: <br><br>
                        Date:<br><br>
                    </div>

                    <div style="margin-top: 15px; font-size: 11px; padding-top: 2px;">
                        Signature
                    </div>
                </td>
            </tr>
        </table>

    </div>

</body>

</html>
