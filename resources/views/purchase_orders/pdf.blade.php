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
                                {{ $purchaseOrder->po_date ? \Carbon\Carbon::parse($purchaseOrder->po_date)->format('d M Y') : '' }}
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
                    {{ $purchaseOrder->supplier_name }}
                    @if ($purchaseOrder->supplier_address)
                        - {{ $purchaseOrder->supplier_address }}
                    @endif
                    @if ($purchaseOrder->supplier_phone)
                        - Tel: {{ $purchaseOrder->supplier_phone }}
                    @endif
                </td>
                <td style="vertical-align: top;">{{ $purchaseOrder->delivery_address }}</td>
            </tr>

            <!-- Row 2: Headers -->
            <tr>
                <td class="bg-light-green">ល័ក្ខខ័ណ្ឌទូទាត់ TERM OF PAYMENT</td>
                <td class="bg-light-green">កាលបរិច្ឆេទប្រគល់ DELIVERY DATE</td>
            </tr>
            <!-- Row 2: Content -->
            <tr>
                <td style="height: 40px;">{{ $purchaseOrder->term_of_payment }}</td>
                <td>
                    {{ $purchaseOrder->delivery_date ? \Carbon\Carbon::parse($purchaseOrder->delivery_date)->format('d-M-Y') : '' }}
                </td>
            </tr>

            <!-- Row 3: Headers -->
            <tr>
                <td class="bg-light-green">មធ្យោបាយទទូទាត់ MODE OF PAYMENT</td>
                <td class="bg-light-green">ល័ក្ខខ័ណ្ឌដឹកជញ្ជូន TERM OF DELIVERY</td>
            </tr>
            <!-- Row 3: Content -->
            <tr>
                <td style="height: 40px;">{{ $purchaseOrder->mode_of_payment }}</td>
                <td>{{ $purchaseOrder->term_of_delivery }}</td>
            </tr>
        </table>

        @php

            $currency = $purchaseOrder->currency ?? 'USD';

            // Sub Total from purchase order items
            $subtotal = (float) $purchaseOrder->subtotal;

            // Percentages
            $servicePercent = (float) ($purchaseOrder->service_charge ?? 0);

            $otherTaxPercent = (float) ($purchaseOrder->other_tax_charge ?? 0);

            $taxPercent = (float) ($purchaseOrder->tax_percent ?? 0);

            // Other charges are a fixed amount
            $otherCharges = (float) ($purchaseOrder->other_charges ?? 0);

            // Calculate service charge
            $serviceAmount = ($subtotal * $servicePercent) / 100;

            // Calculate other tax charge
            $otherTaxAmount = ($subtotal * $otherTaxPercent) / 100;

            // Calculate VAT / withholding
            $vatAmount = ($subtotal * $taxPercent) / 100;

            // Grand Total
            $grandTotal = $subtotal + $serviceAmount + $otherTaxAmount + $vatAmount + $otherCharges;
        @endphp

        {{-- ITEMS & TOTALS TABLE --}}
        <table class="table-bordered" style="border-top: none; font-size: 12px;">
            <thead>
                <tr class="bg-light-green">
                    <th style="width: 6%;" class="text-center">លេខ</th>
                    <th style="width: 40%;" class="text-left">ពិព៍ណនា​</th>
                    <th style="width: 13%;" class="text-center">កាលបរិច្ឆេទ</th>
                    <th style="width: 8%;" class="text-center">ឯកតា</th>
                    <th style="width: 8%;" class="text-center">បរិមាណ</th>
                    <th style="width: 9%;" class="text-center">តម្លៃឯកតា</th>
                    <th style="width: 10%;" class="text-center">ទឹកប្រាក់</th>
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
                @foreach ($purchaseOrder->items as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->description }}</td>
                        <td class="text-center">
                            {{ $item->required_date ? \Carbon\Carbon::parse($item->required_date)->format('d-M-Y') : '' }}
                        </td>
                        <td class="text-center">{{ $item->unit }}</td>
                        <td class="text-center">{{ number_format($item->quantity) }}</td>
                        <td class="text-right">{{ number_format($item->unit_price, 2) }}</td>
                        <td class="text-right">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
                {{-- Fill empty rows up to 5 --}}
                @for ($i = count($purchaseOrder->items); $i < 7; $i++)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
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
                        @if (!empty($purchaseOrder->notes))

                            @php
                                $additionalNotes = preg_split('/\r\n|\r|\n/', trim($purchaseOrder->notes));

                                $number = 4;
                            @endphp

                            @foreach ($additionalNotes as $note)
                                @if (trim($note) !== '')
                                    <br>

                                    {{ $number }}.
                                    {{ trim($note) }}

                                    @php
                                        $number++;
                                    @endphp
                                @endif
                            @endforeach

                        @endif

                    </p>
                </td>

                {{-- Totals Column --}}
                <td
                    style="
                        width:40%;
                        padding:0;
                        vertical-align:top;
                    ">

                    <table class="totals-table"
                        style="
                            width:100%;
                            border-collapse:collapse;
                            font-size:11px;
                        ">

                        {{-- SUB TOTAL --}}
                        <tr>

                            <td class="font-bold">
                                SUB TOTAL
                            </td>

                            <td class="text-right font-bold">

                                {{ $currency }}
                                {{ number_format($subtotal, 2) }}

                            </td>

                        </tr>


                        {{-- SERVICE CHARGE --}}
                        <tr>

                            <td>

                                Service Charge
                                ({{ number_format($servicePercent, 2) }}%)

                            </td>

                            <td class="text-right font-bold">

                                {{ $currency }}
                                {{ number_format($serviceAmount, 2) }}

                            </td>

                        </tr>


                        {{-- OTHER TAX CHARGE --}}
                        <tr>

                            <td>

                                Other Tax Charge
                                ({{ number_format($otherTaxPercent, 2) }}%)

                            </td>

                            <td class="text-right font-bold">

                                {{ $currency }}
                                {{ number_format($otherTaxAmount, 2) }}

                            </td>

                        </tr>


                        {{-- VAT --}}
                        <tr>

                            <td>

                                VAT
                                ({{ number_format($taxPercent, 2) }}%)
                                if applicable

                            </td>

                            <td class="text-right font-bold">

                                {{ $currency }}
                                {{ number_format($vatAmount, 2) }}

                            </td>

                        </tr>


                        {{-- OTHER CHARGES --}}
                        <tr>

                            <td>
                                Other Charges
                            </td>

                            <td class="text-right font-bold">

                                {{ $currency }}
                                {{ number_format($otherCharges, 2) }}

                            </td>

                        </tr>


                        {{-- TOTAL --}}
                        <tr>

                            <td class="font-bold"
                                style="
                                    font-size:12px;
                                    background:#e6f4ea;
                                ">
                                TOTAL
                            </td>

                            <td class="text-right font-bold"
                                style="
                                    font-size:12px;
                                    color:#14532d;
                                    background:#e6f4ea;
                                ">

                                {{ $currency }}
                                {{ number_format($grandTotal, 2) }}

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
