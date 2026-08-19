<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expenditure Summary</title>
    <style>
        /* PDF Page Layout Spacing */
        @page {
            margin: 12px 20px;
        }

        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        .watermark {
            position: fixed;
            top: 25%;
            left: 25%;
            width: 50%;
            text-align: center;
            z-index: -1;
            opacity: 0.05;
        }

        .watermark img {
            width: 500px;
        }

        /* Table Layouts */
        .table-full {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: -1px;
            /* Prevents double borders between stacked tables */
        }

        .table-xs {
            font-size: 12px;
        }

        .border-black {
            border: 1px solid #000000;
        }

        .p-2 {
            padding: 5px;
        }

        .header-title-box {
            width: 100%;
            vertical-align: top;
        }

        .form-code {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 12px;
            text-align: right;
        }

        .form-title {
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .pb-1 {
            padding-bottom: 4px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .pr-4 {
            padding-right: 16px;
        }

        .pl-4 {
            padding-left: 16px;
        }

        /* Typography & Alignment */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .align-top {
            vertical-align: top;
        }

        .align-center {
            vertical-align: middle;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-lg {
            font-size: 14px;
        }

        .text-sm {
            font-size: 14px;
        }

        .text-base {
            font-size: 12px;
        }

        .text-green-khmer {
            color: #15803d;
        }

        /* Tailwind green-700 */
        .text-blue-link {
            color: #2563eb;
            text-decoration: underline;
        }

        /* Structural Layout (Flex alternative for PDF engines) */
        .header-container {
            display: table;
            width: 100%;
        }

        .header-logo {
            display: table-cell;
            width: 120px;
            vertical-align: top;
        }

        .header-text {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            margin-left: 5px;
            width: 300px;
        }

        .type-container {
            display: table;
            width: 100%;
        }

        .type-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .border-left-gray {
            border-left: 1px solid #9ca3af;
        }

        .border-bottom-gray {
            border-bottom: 1px solid #9ca3af;
        }

        /* Fixed Row Heights & Column Widths */
        .h-8 {
            height: 24px;
        }

        .h-20 {
            height: 40px;
        }

        .h-28 {
            height: 112px;
        }

        .w-[400px] {
            width: 400px;
        }

        .w-[50px] {
            width: 50px;
        }

        .w-20 {
            width: 40px;
        }

        /* Checkbox & Options Alignment */
        .option-row {
            margin-bottom: 4px;
        }

        .option-row input {
            vertical-align: middle;
            margin-right: 8px;
        }

        .option-row span {
            vertical-align: middle;
        }

        /* Signatures Layout */
        .signature-section {
            background-color: #ffffff;
            padding: 0px 32px;
            font-size: 12px;
            margin-top: 16px;
        }

        .signature-container {
            display: table;
            width: 100%;
        }

        .signature-box {
            display: table-cell;
            width: 40%;
            vertical-align: top;
        }

        .signature-right {
            display: table-cell;
            width: 18%;
            vertical-align: top;
        }

        .signature-center {
            display: table-cell;
            width: 42%;
            vertical-align: top;
        }


        .signature-image-wrapper {
            height: 70px;
            display: block;
            margin-top: 6px;
            margin-bottom: 6px;
        }

        .signature-image {
            max-height: 70px;
            object-fit: contain;
        }

        .space-y-2 p {
            margin: 4px 0 0 0;
        }
    </style>
</head>

<body>

    <div class="watermark">
        <img src="{{ public_path('images/logo.png') }}">
    </div>

    @php
        $totalAv = $summary->items->sum('av_amount');
        $totalActual = $summary->items->sum('actual_expense');
        $totalVariance = $summary->items->sum('variance_amount');
        $totalVariancePercent = $summary->items->sum('variance_percent');

        $totalVariancePercent = max($totalVariancePercent, -100);
    @endphp

    {{-- HEADER & GENERAL INFO --}}
    <table class="table-full">
        <tr>
            <td colspan="10" class="p-2">
                <div class="header-container">
                    <div class="header-logo">
                        <img src="{{ public_path('images/logo.png') }}" style="height:70px; width:100%;">
                    </div>

                    <div class="header-text">
                        <img src="{{ public_path('images/exp.jpg') }}" style="height:70px; width:100%;">
                    </div>
                </div>
            </td>
            <td colspan="2">
                <div class="header-title-box">
                    <div class="form-code">FM02-03</div>
                    <div class="form-title">EXPENDITURE SUMMARY</div>
                </div>
            </td>
        </tr>

        {{-- INFO ROW --}}
        <tr>
            <td colspan="8">
                <strong>NAME & POSITION:</strong>
                {{ $summary->user?->name }} /
                {{ $summary->user?->position }}
            </td>

            <td colspan="2">
                <strong>DATE:</strong>
                {{ $summary->date ? \Carbon\Carbon::parse($summary->date)->format('d M Y') : '' }}
            </td>
            <td colspan="2" rowspan="3" class="border-black p-2 align-top">
                <div class="type-container">
                    {{-- Transaction Type --}}
                    <div class="type-column pr-4">
                        <div class="font-bold border-bottom-gray pb-1 mb-2">Transaction Type</div>
                        <div class="option-row">
                            <input type="checkbox"
                                {{ $summary->transaction_type == 'Advance Settlement' ? 'checked' : '' }}>
                            <span>Advance Settlement</span>
                        </div>
                        <div class="option-row">
                            <input type="checkbox" {{ $summary->transaction_type == 'Reimbursement' ? 'checked' : '' }}>
                            <span>Reimbursement</span>
                        </div>
                        <div class="option-row">
                            <input type="checkbox" {{ $summary->transaction_type == 'Direct Pay' ? 'checked' : '' }}>
                            <span>Direct Pay</span>
                        </div>
                    </div>

                    {{-- Payment Type --}}
                    <div class="type-column pl-4 border-left-gray">
                        <div class="font-bold border-bottom-gray pb-1 mb-2">Payment Type</div>
                        <div class="option-row">
                            <input type="checkbox" {{ $summary->payment_type == 'Cash/QR Code' ? 'checked' : '' }}>
                            <span>Cash / QR Code</span>
                        </div>
                        <div class="option-row">
                            <input type="checkbox"
                                {{ $summary->payment_type == 'Check/Bank Transfer' ? 'checked' : '' }}>
                            <span>Check / Bank Transfer</span>
                        </div>
                        <div class="option-row">
                            <input type="checkbox" {{ $summary->payment_type == 'Internet Banking' ? 'checked' : '' }}>
                            <span>Internet Banking</span>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <strong>ACTIVITY:</strong>
                {{ $summary->activity }}
            </td>
        </tr>
        <tr>
            <td colspan="8">
                <strong>PROGRAM:</strong>
                {{ $summary->user?->department?->name }}
            </td>
            <td colspan="2">
                <strong>PLACE:</strong>
                {{ $summary->place }}
            </td>
        </tr>

    </table>

    {{-- EXPENSE TABLE --}}
    <table class="table-full">
        <thead>
            <tr>
                <th rowspan="2" class="border-black">No.</th>
                <th rowspan="2" class="border-black">DESCRIPTION</th>
                <th rowspan="2" class="border-black">Ref.</th>
                <th rowspan="2" class="border-black">AV/PO/Agr#<br>AMOUNT</th>
                <th rowspan="2" class="border-black">ACTUAL<br>EXPENSES</th>
                <th colspan="2" class="border-black">VARIANCE</th>
                <th rowspan="2" class="border-black">Budget Code</th>
                <th rowspan="2" class="border-black">Donor</th>
                <th rowspan="2" class="border-black">Donor Code</th>
            </tr>
            <tr>
                <th class="border-black">$</th>
                <th class="border-black">%</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($summary->items as $index => $item)
                <tr>
                    <td class="border-black text-center h-8">{{ $index + 1 }}</td>
                    <td class="border-black p-2 w-[400px]">{{ $item->description }}</td>
                    <td class="border-black p-2 w-[50px] text-center">
                        @if ($item->attachments && $item->attachments->count() > 0)
                            {{ $item->attachments->count() }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="border-black text-right p-2">{{ number_format($item->av_amount, 2) }}</td>
                    <td class="border-black text-right p-2">{{ number_format($item->actual_expense, 2) }}</td>
                    <td class="border-black text-right p-2">
                        {{ $item->variance_amount < 0 ? '(' . number_format(abs($item->variance_amount), 2) . ')' : number_format($item->variance_amount, 2) }}
                    </td>
                    <td class="border-black text-right p-2">
                        {{ number_format($item->variance_percent, 2) }}%
                    </td>
                    <td class="border-black p-2 text-center">{{ $item->budget_code }}</td>
                    <td class="border-black p-2 text-center">{{ $item->donor }}</td>
                    <td class="border-black p-2 text-center">{{ $item->donor_code }}</td>
                </tr>
            @endforeach

            {{-- TOTAL ROW --}}
            <tr class="font-bold">
                <td colspan="3" class="border-black text-center">TOTAL</td>
                <td class="border-black text-right p-2">{{ number_format($totalAv, 2) }}</td>
                <td class="border-black text-right p-2">{{ number_format($totalActual, 2) }}</td>
                <td class="border-black text-right p-2">
                    {{ $totalVariance < 0 ? '(' . number_format(abs($totalVariance), 2) . ')' : number_format($totalVariance, 2) }}
                </td>
                <td class="border-black text-right p-2">{{ number_format($totalVariancePercent, 2) }}%</td>
                <td class="border-black"></td>
                <td class="border-black"></td>
                <td class="border-black"></td>
            </tr>
        </tbody>
    </table>

    {{-- ADVANCE SECTION --}}
    <table class="table-full">
        <tr>
            <td class="border-black p-2" style="width: 50%;">
                <strong>Advance voucher #:</strong> {{ $summary->advance_voucher_no }}
            </td>
            <td class="border-black p-2" style="width: 50%;">
                <strong>Advance Dated:</strong> {{ $summary->advance_date }}
            </td>
        </tr>
    </table>

    {{-- VARIANCE EXPLANATION --}}
    <table class="table-full table-xs">

        <tr>

            <td class="border-black p-2">
                There are the variance require to explain
            </td>

            <td class="border-black p-2 text-center" style="width:80px;">

                <div class="option-row">
                    <input type="checkbox" {{ $summary->variance_required ? 'checked' : '' }} disabled>
                    <span>YES</span>
                </div>

            </td>

            <td class="border-black p-2 text-center" style="width:80px;">

                <div class="option-row">
                    <input type="checkbox" {{ !$summary->variance_required ? 'checked' : '' }} disabled>
                    <span>NO</span>
                </div>

            </td>

        </tr>

        <tr>

            <td colspan="3" class="border-black p-2 align-top" style="height:32px;">

                {{ $summary->variance_explanation }}

            </td>

        </tr>

    </table>

    {{-- LATE LIQUIDATION --}}
    <table class="table-full table-xs">

        <tr>

            <td class="border-black p-2">
                There is late advance liquidation require to explain
            </td>

            <td class="border-black p-2 text-center" style="width:80px;">

                <div class="option-row">
                    <input type="checkbox" {{ $summary->late_liquidation ? 'checked' : '' }} disabled>
                    <span>YES</span>
                </div>

            </td>

            <td class="border-black p-2 text-center" style="width:80px;">

                <div class="option-row">
                    <input type="checkbox" {{ !$summary->late_liquidation ? 'checked' : '' }} disabled>
                    <span>NO</span>
                </div>

            </td>

        </tr>

        <tr>

            <td colspan="3" class="border-black p-2 align-top" style="height:32px;">

                {{ $summary->late_liquidation_explanation }}

            </td>

        </tr>

    </table>

    {{-- SIGNATURE SECTION --}}
    <div class="signature-section">
        <div class="signature-container">

            {{-- Prepared By --}}
            <div class="signature-box text-left">
                <p class="text-base"><span class="font-bold">Prepared by:</span>
                    {{ $summary->user?->name }}</p>
                <div class="signature-image-wrapper">
                    @if ($summary->prepared_signature)
                        <img src="{{ public_path('storage/' . $summary->prepared_signature) }}"
                            alt="Prepared Signature" class="signature-image">
                    @endif
                </div>
                <div class="space-y-2">
                    <p><span class="font-bold">Position:</span> {{ $summary->user?->position ?? '' }}</p>
                    <p><span class="font-bold">Date:</span>
                        {{ \Carbon\Carbon::parse($summary->date)->format('d M Y') }}</p>
                </div>
            </div>

            {{-- Reviewed By --}}
            <div class="signature-center text-left">
                <p class="text-base"><span class="font-bold">Reviewed by:</span>
                    {{ $summary->reviewer?->name ?? '' }}</p>
                <div class="signature-image-wrapper">
                    @if ($summary->reviewer_signature)
                        <img src="{{ public_path('storage/' . $summary->reviewer_signature) }}"
                            alt="Reviewer Signature" class="signature-image">
                    @endif
                </div>
                <div class="space-y-2">
                    <p><span class="font-bold">Position:</span> {{ $summary->reviewer?->position ?? '' }}
                    </p>
                    <p><span class="font-bold">Date:</span>
                        @if ($summary->date)
                            {{ \Carbon\Carbon::parse($summary->date)->format('d M Y') }}
                        @endif
                    </p>
                </div>
            </div>

            {{-- Approved By --}}
            <div class="signature-right text-left">
                <p class="text-base"><span class="font-bold">Approved by:</span>
                    {{ $summary->approver?->name ?? '' }}</p>
                <div class="signature-image-wrapper">
                    @if ($summary->approved_signature)
                        <img src="{{ public_path('storage/' . $summary->approved_signature) }}"
                            alt="Approver Signature" class="signature-image">
                    @endif
                </div>
                <div class="space-y-2">
                    <p><span class="font-bold">Position:</span> {{ $summary->approver?->position ?? '' }}
                    </p>
                    <p><span class="font-bold">Date:</span>
                        @if ($summary->date)
                            {{ \Carbon\Carbon::parse($summary->date)->format('d M Y') }}
                        @endif
                    </p>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
