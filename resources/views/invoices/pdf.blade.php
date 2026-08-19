<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <title>INVOICE</title>
    <style>
        @page {
            margin: 6mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'khmer', 'dejavusans', sans-serif;
            font-size: 12px;
            color: #000;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* HEADER TABLE */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        /* LEFT COLUMN (LOGO) */
        .logo-cell-left {
            width: 18%;
            vertical-align: top;
            text-align: left;
        }

        .logo {
            max-width: 100%;
            height: 60px;
            width: auto;
        }

        /* CENTER COLUMN */
        .header-center {
            width: 70%;
            text-align: center;
            vertical-align: top;
        }

        .header-title-img {
            height: 45px;
            width: auto;
            margin-bottom: 2mm;
        }

        .address,
        .telephone {
            font-size: 13px;
            line-height: 1.5;
            color: #333333;
        }

        /* RIGHT COLUMN (FORM CODE) */
        .header-right {
            width: 12%;
            vertical-align: top;
            text-align: right;
        }

        .form-code {
            display: inline-block;
            font-size: 10px;
            font-weight: bold;
            color: #000000;
        }

        .header-line {
            border-top: 1.2px solid #000000;
            margin-top: 3mm;
            margin-bottom: 3mm;
        }

        /* INVOICE TITLE */
        .invoice-title {
            text-align: center;
            color: #138100;
            padding: 1mm 0 3mm 0;
        }

        .invoice-title-khmer {
            font-size: 22px;
            font-weight: bold;
            line-height: 1.3;
        }

        .invoice-title-english {
            font-size: 20px;
            font-weight: bold;
            margin-top: 1mm;
        }

        /* CUSTOMER / INVOICE INFO */
        .info-table {
            width: 100%;
        }

        .info-left {
            width: 58%;
            vertical-align: top;
        }

        .info-right {
            width: 42%;
            vertical-align: top;
        }

        .info-left-table td,
        .info-right-table td {
            vertical-align: top;
            line-height: 1.5;
            padding: 1.5mm 1mm;
        }

        .customer-title,
        .small-label {
            font-size: 16px;
            font-weight: bold;
        }

        .customer-value,
        .address-value {
            font-size: 16px;
            min-height: 6mm;
        }

        .telephone-value {
            font-size: 16px;
            color: #138100;
        }

        .invoice-label {
            font-size: 16px;
            color: #138100;
            font-weight: bold;
        }

        .invoice-value {
            font-size: 16px;
            margin-top: 5px;
        }

        /* ITEMS TABLE */
        .items-table {
            width: 100%;
            margin-top: 3mm;
        }

        .items-table th {
            border: 1px solid #000;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            padding: 2mm 1mm;
            line-height: 1.8;
            font-size: 14px;
        }

        .items-table td {
            border: 1px solid #000;
            vertical-align: middle;
            height: 12mm;
            padding: 1mm;
            font-size: 14px;
        }

        .col-no {
            width: 5%;
            text-align: center;
        }

        .col-description {
            width: 63%;
            text-align: left;
        }

        .col-quantity {
            width: 9%;
            text-align: center;
        }

        .col-unit {
            width: 10%;
            text-align: right;
        }

        .col-amount {
            width: 13%;
            text-align: right;
        }

        .khmer-header,
        .english-header {
            display: block;
            font-size: 14px;
            font-weight: bold;
            line-height: 1.8;
        }

        .item-number {
            text-align: center;
        }

        .item-description {
            text-align: left;
        }

        .item-quantity {
            text-align: center;
        }

        .item-unit,
        .item-amount {
            text-align: right;
        }

        /* GRAND TOTAL & WORDS */
        .grand-total td {
            border: 1px solid #000;
            height: 10mm;
            vertical-align: middle;
            font-weight: bold;
        }

        .grand-total-label {
            text-align: right;
            padding-right: 4mm !important;
            font-size: 10.5px;
        }

        .grand-total-amount {
            text-align: right;
            padding-right: 2mm !important;
            font-size: 10.5px;
        }

        .amount-words td {
            border: 1px solid #000;
            height: 8mm;
            text-align: center;
            vertical-align: middle;
            font-size: 15px;
            font-weight: normal;
        }

        /* PAYMENT & SIGNATURE */
        .bottom-table {
            width: 100%;
            line-height: 1.8;
        }

        .payment-cell {
            width: 57%;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            border-left: 1px solid #000;
            vertical-align: top;
            padding: 2mm;
        }

        .qr-code {
            width: 18%;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 2mm;
        }

        .logo-qr {
            height: 120px;
            width: 120px;
        }

        .signature-cell {
            width: 25%;
            border: 1px solid #000;
            vertical-align: bottom;
            text-align: center;
            padding: 2mm;
            height: 35mm;
        }

        .payment-title {
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 1.5mm;
        }

        .payment-line {
            font-size: 13px;
            line-height: 1.8;
        }

        .signature-space {
            height: 20mm;
        }

        .signature-name {
            font-size: 13px;
            font-weight: normal;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="invoice-page">

        {{-- HEADER --}}
        <table class="header-table">
            <tr>
                <!-- Left Logo -->
                <td class="logo-cell-left">
                    @php $logo = public_path('images/logo.png'); @endphp
                    @if (file_exists($logo))
                        <img src="{{ $logo }}" class="logo">
                    @endif
                </td>

                <!-- Center Header Info -->
                <td class="header-center">
                    @php $logoExp = public_path('images/exp.jpg'); @endphp
                    @if (file_exists($logoExp))
                        <img src="{{ $logoExp }}" class="header-title-img">
                    @endif

                    <div class="address">#9-11, St. 476, Sangkat Toul Tompoung I, Khan Chamkarmon, Phnom Penh</div>
                    <div class="telephone">Tel: (+855) 78 550 449, Fax: (+855) 78 550 449</div>
                </td>

                <!-- Right Form Code -->
                <td class="header-right">
                    <span class="form-code">FM02-14</span>
                </td>
            </tr>
        </table>

        <div class="header-line"></div>

        {{-- INVOICE TITLE --}}
        <div class="invoice-title">
            <div class="invoice-title-khmer">វិក្កយបត្រ</div>
            <div class="invoice-title-english">INVOICE</div>
        </div>

        {{-- CUSTOMER / INVOICE INFO --}}
        <table class="info-table">
            <tr>
                <td class="info-left">
                    <table class="info-left-table">
                        <tr>
                            <td>
                                <div class="customer-title">អតិថិជន/CUSTOMER: <span
                                        class="customer-value">{{ $invoice->customer ?? ' ' }}</span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="small-label">ឈ្មោះស្ថាប័នឬអតិថិជន </div>
                                <div class="small-label">ENTITY/CUSTOMER: <span
                                        class="address-value">{{ $invoice->company ?? ' ' }}</span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="small-label">អាស័យដ្ឋាន </div>
                                <div class="small-label">Address: <span
                                        class="address-value">{{ $invoice->address ?? ' ' }}</span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="small-label">ទូរស័ព្ទ Tel: <span
                                        class="address-value">{{ $invoice->telephone ?? ' ' }}</span></div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="info-right">
                    <table class="info-right-table">
                        <tr>
                            <td>
                                <div class="invoice-label">លេខវិក្កយបត្រ</div>
                                <div class="invoice-value">INVOICE No: {{ $invoice->invoice_no }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoice-label">កាលបរិច្ឆេទ</div>
                                <div class="invoice-value">
                                    DATE:
                                    {{ $invoice->invoice_date ? \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') : '' }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        {{-- ITEMS TABLE --}}
        <table class="items-table">

            <thead>
                <tr>
                    <th class="col-no">
                        <span class="khmer-header">ល.រ</span> <br>
                        <span class="english-header">No.</span>
                    </th>
                    <th class="col-description">
                        <span class="khmer-header">បរិយាយមុខទំនិញ ឬសេវា</span> <br>
                        <span class="english-header">Description of goods or service</span>
                    </th>
                    <th class="col-quantity">
                        <span class="khmer-header">បរិមាណ</span> <br>
                        <span class="english-header">Quantity</span>
                    </th>
                    <th class="col-unit">
                        <span class="khmer-header">តម្លៃឯកតា</span> <br>
                        <span class="english-header">Unit Price</span>
                    </th>
                    <th class="col-amount">
                        <span class="khmer-header">ចំនួនទឹកប្រាក់</span> <br>
                        <span class="english-header">Amount</span>
                    </th>
                </tr>
            </thead>

            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($invoice->items as $index => $item)
                    @php
                        $quantity = (float) $item->quantity;
                        $unitPrice = (float) $item->unit_price;
                        $amount = (float) $item->amount;
                        $grandTotal += $amount;
                    @endphp
                    <tr>
                        <td class="item-number">{{ $index + 1 }}</td>
                        <td class="item-description">{{ $item->description }}</td>
                        <td class="item-quantity">{{ rtrim(rtrim(number_format($quantity, 2), '0'), '.') }}</td>
                        <td class="item-unit">$ {{ number_format($unitPrice, 2) }}</td>
                        <td class="item-amount">$ {{ number_format($amount, 2) }}</td>
                    </tr>
                @endforeach

                {{-- Empty Filler Rows --}}
                @for ($i = count($invoice->items); $i < 8; $i++)
                    <tr>
                        <td class="item-number">{{ $i + 1 }}</td>
                        <td class="item-description">&nbsp;</td>
                        <td class="item-quantity">&nbsp;</td>
                        <td class="item-unit">&nbsp;</td>
                        <td class="item-amount">&nbsp;</td>
                    </tr>
                @endfor

                {{-- GRAND TOTAL --}}
                <tr class="grand-total">
                    <td colspan="4" class="grand-total-label">សរុបរួម/Grand Total</td>
                    <td class="grand-total-amount">$ {{ number_format($invoice->grand_total ?? $grandTotal, 2) }}</td>
                </tr>

                {{-- AMOUNT IN WORDS --}}
                <tr class="amount-words">
                    <td colspan="5">In word ({{ $invoice->amount_in_words ?? '' }})</td>
                </tr>
            </tbody>
        </table>

        {{-- PAYMENT AND SIGNATURE --}}
        <table class="bottom-table">
            <tr>
                <td class="payment-cell">
                    <div class="payment-title">Payment Term:</div>
                    <div class="payment-line"><strong>1-</strong> By check address to <strong>NGO FORUM ON
                            CAMBODIA</strong></div>
                    <div class="payment-line"><strong>2-</strong> By bank transfer: Bank Name: <strong>ACLEDA BANK
                            Plc.</strong></div>
                    <div class="payment-line">Address: #61, Preah Monivong Blvd., Sangkat Srah Chork, Khan Daun Penh
                    </div>
                    <div class="payment-line">Bank Account Name: <strong>NGO FORUM ON CAMBODIA.</strong></div>
                    <div class="payment-line">Bank Account #: <strong>0090-10-166036-29</strong>, SWIFT:
                        <strong>ACLBKHPP.</strong>
                    </div>
                </td>
                <td class="qr-code">
                    <div>
                        @php $logo = public_path('images/qr.jpg'); @endphp
                        @if (file_exists($logo))
                            <img src="{{ $logo }}" class="logo-qr">
                        @endif
                    </div>
                </td>
                <td class="signature-cell">
                    <div class="signature-space"></div>
                    <div class="signature-name">Issued by (Signature &amp; Name)</div>
                    @if (!empty($invoice->issued_by))
                        <div style="margin-top: 1mm; font-size: 8.5px;">{{ $invoice->issued_by }}</div>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
