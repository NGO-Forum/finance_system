<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">

    <title>Verbal Quote</title>

    <style>
        @page {
            margin: 8mm;
        }

        body {
            font-family: 'dejavusans', 'khmer', sans-serif;
            font-size: 14px;
            color: #000;
        }

        .header-table {
            width: 100%;
            margin-bottom: 10px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            height: 60px;
            width: auto;
            margin-bottom: 6px;
        }

        .doc-code {
            font-size: 10px;
            font-weight: bold;
            color: #555;
            text-align: right;
            vertical-align: top;
        }

        .form-title {
            color: rgb(0, 92, 6);
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            line-height: 1.8;
            border: 1px solid #1c1c1c;
            padding: 8px;
        }

        .form-title {
            font-size: 18px;
        }

        /* Data information */
        .info-table {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 10px;
            border-collapse: collapse;
            font-size: 17px;
            table-layout: fixed;
        }

        .info-table td {
            padding: 6px 2px;
            vertical-align: bottom;
        }

        .label {
            font-weight: bold;
            white-space: nowrap;
        }

        .text-center {
            text-align: center;
        }

        /* Budget table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 15px;
            vertical-align: middle;
        }

        /* Header styling with light grey background */
        .items-table th {
            background-color: #e6e6e6;
            font-weight: bold;
            text-align: center;
            font-size: 15px;
        }

        /* Fixed height for table rows to match layout */
        .items-table tbody tr td {
            height: 35px;
        }

        /* Utility classes */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        /* Total row formatting */
        .total-row td {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }


        /* Section Title */
        .section-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 3px;
        }

        /* Additional Specifications Box */
        .spec-box {
            border: 1px solid #000;
            width: 100%;
            height: 80px;
            padding: 4px;
            box-sizing: border-box;
            font-size: 15px;
            margin-bottom: 15px;
        }

        /* Prepared By Section Table */
        .prepared-table {
            width: 100%;
            border: 1px solid #000;
            margin-bottom: 15px;
            padding: 6px;
            table-layout: fixed;
        }

        .prepared-table td {
            padding: 8px 4px;
            vertical-align: bottom;
            font-size: 15px;
        }

        .label-bold {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
            white-space: nowrap;
        }


        /* Footer Disclaimer Box */
        .disclaimer-box {
            border: 1px solid #000;
            width: 100%;
            padding: 8px;
            text-align: center;
            font-size: 14px;
            box-sizing: border-box;
        }
    </style>

</head>

<body>

    <table class="header-table">

        <tr>
            <td class="border-none" style="width: 20%; vertical-align: top;">
                @if (file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" class="logo"​ style="width: 20%;">
                @endif
            </td>
            <td class="border-none text-left" style="vertical-align: top;">
                @if (file_exists(public_path('images/exp.jpg')))
                    <img src="{{ public_path('images/exp.jpg') }}" class="logo">
                @endif
            </td>
            <td class="border-none doc-code" style="width: 15%;">
                FM02-09
            </td>
        </tr>

    </table>

    <table style="width:35%; border-collapse:collapse; margin: 0 auto;">
        <tr>
            <td class="form-title">
                <div>ទម្រង់សម្រង់តម្លៃផ្ទាល់មាត់</div>
                <div>VERBAL QUOTATION FORM</div>
            </td>
        </tr>
    </table>

    <table class="info-table">
        <!-- Row 1: Date & QF # share the left side, Supplier Name on right -->
        <tr>
            <td style="width: 6%;" class="label">Date:</td>
            <td style="width: 16%;">
                {{ optional($verbalQuote->created_at)->format('d-M-Y') }}
            </td>
            <td style="width: 38%;" class="label">
                &nbsp;&nbsp;&nbsp;&nbsp;QF #
                <span class="underline-field" style="display: inline-block; width: 75%;">

                </span>
            </td>
            <td style="width: 40%;" class="label">
                Supplier Name:
                <span style="display: inline-block; width: 60%;">
                    {{ $verbalQuote->supplier_name }}
                </span>
            </td>
        </tr>

        <!-- Row 2: Requested By on left, Contact Info on right -->
        <tr>
            <td colspan="1" class="label">Requested By:</td>
            <td>
                {{ optional($verbalQuote->requester)->name }}
            </td>
            <td colspan="1" class="label"></td>
            <td class="label">
                Contact Information:
                <span style="display: inline-block; width: 50%;">
                    {{ $verbalQuote->contact_information }}
                </span>
            </td>
        </tr>

        <!-- Row 3: Empty space on left, Date of contact on right -->
        <tr>
            <td colspan="3"></td>
            <td class="label">
                Date of contact:
                <span style="display: inline-block; width: 60%;">
                    {{ optional($verbalQuote->contact_date)->format('d-M-Y') }}
                </span>
            </td>
        </tr>

        <!-- Row 4: Validity Date on left, Time of contact on right -->
        <tr>
            <td colspan="1" class="label">Validity Date:</td>
            <td>
                {{ optional($verbalQuote->validity_date)->format('d-M-Y') }}
            </td>
            <td colspan="1"></td>
            <td class="label">
                Time of contact:
                <span style="display:inline-block; width:60%;">
                    {{ $verbalQuote->contact_time ? \Carbon\Carbon::parse($verbalQuote->contact_time)->format('h:i A') : '' }}
                </span>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 6%;">No</th>
                <th style="width: 14%;">Budget Line</th>
                <th style="width: 42%;">Description</th>
                <th style="width: 8%;">Qty</th>
                <th style="width: 14%;">Unit Price</th>
                <th style="width: 16%;">Extended Price</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = $verbalQuote->items ?? collect();
                $totalRows = 5;
            @endphp

            @for ($i = 0; $i < $totalRows; $i++)
                @php
                    $item = $items->get($i);
                @endphp
                <tr>
                    <td class="text-center">{{ $item ? $i + 1 : '' }}</td>
                    <td>{{ $item->budget_line ?? '' }}</td>
                    <td>{{ $item->description ?? '' }}</td>
                    <td class="text-center">{{ $item ? $item->qty : '' }}</td>
                    <td class="text-right">{{ $item ? number_format($item->unit_price, 2) : '' }}</td>
                    <td class="text-right">{{ $item ? number_format($item->qty * $item->unit_price, 2) : '' }}</td>
                </tr>
            @endfor

            <!-- Total Row -->
            <tr class="total-row">
                <td colspan="5" class="text-right font-bold">TOTAL</td>
                <td class="text-right font-bold">
                    {{ number_format($verbalQuote->items->sum(fn($i) => $i->qty * $i->unit_price), 2) }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- 1. Additional Specifications Block -->
    <div class="section-title">Additional Specifications</div>
    <div class="spec-box">
        {{ $verbalQuote->additional_specifications ?? '' }}
    </div>

    <!-- 2. Prepared By Form Table -->
    <table class="prepared-table">
        <tr>
            <td style="width: 20%;" class="label-bold">Prepared By:</td>
            <td style="width: 68%;" class="line-field">
                {{ optional($verbalQuote->preparer)->name }}
            </td>
            <td style="width: 12%;"></td>
        </tr>
        <tr>
            <td class="label-bold">Position:</td>
            <td class="line-field">
                {{ optional($verbalQuote->preparer)->position }}
            </td>
            <td></td>
        </tr>
        <tr>
            <td class="label-bold">Signature:</td>
            <td class="line-field">

            </td>
            <td></td>
        </tr>
        <tr>
            <td class="label-bold">Date:</td>
            <td class="line-field">
                {{ optional($verbalQuote->created_at)->format('d-M-Y') }}
            </td>
            <td></td>
        </tr>
    </table>

    <!-- 3. Bottom Boxed Disclaimer -->
    <div class="disclaimer-box">
        This form is used only when official quotation from supplier is not feasible.
    </div>

</body>

</html>
