<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Finance Form FM02-01</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 6mm;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #0f172a;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        .watermark {
            position: fixed;
            top: 35%;
            left: 25%;
            width: 50%;
            text-align: center;
            z-index: -1;
            opacity: 0.06;
        }

        .watermark img {
            width: 500px;
        }

        /* ===========================
           GLOBAL TABLE UTILITIES
           =========================== */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            vertical-align: middle;
            word-wrap: break-word;
            padding: 4px;
        }

        .border-all {
            border: 1px solid #1e293b !important;
        }

        .border-none {
            border: none !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        /* ===========================
           HEADER & ADDRESS
           =========================== */
        .header-table {
            margin-bottom: 4px;
        }

        .logo {
            max-height: 65px;
            width: auto;
        }

        .header-title {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #0f172a;
            text-transform: uppercase;
        }

        .form-code-box {
            border: none;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 10px;
            display: inline-block;
        }

        .address-bar {
            color: #166534;
            font-size: 9px;
            font-weight: bold;
            border-bottom: 1.5px solid #166534;
            padding-bottom: 3px;
            margin-bottom: 8px;
            text-align: center;
        }

        /* ===========================
           TOP GRID (INFO & OPTIONS)
           =========================== */
        .grid-table {
            border: 1px solid #0f172a;
        }

        .grid-table>tbody>tr>td {
            border: 1px solid #0f172a;
            vertical-align: top;
            padding: 0;
        }

        /* Info Block */
        .info-inner-table td {
            padding: 6px 6px;
            border-bottom: 1px solid #cbd5e1;
        }

        .info-inner-table tr:last-child td {
            border-bottom: none;
        }

        .info-label {
            width: 47%;
            font-weight: bold;
            color: #1e293b;
            background: #f1f5f9;
            border-right: 1px solid #cbd5e1;
        }

        .info-value {
            font-size: 11px;
            color: #000;
            background: #fff;
        }

        .info-value.amount {
            font-size: 10.5px;
            font-weight: bold;
            color: #0f172a;
        }

        /* Header Labels for Sub-Tables */
        .column-header {
            background: #166534;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            padding: 6.5px 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #0f172a;
        }

        .column-header-accounting {
            background: #9a3412;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            padding: 6.5px 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #0f172a;
        }

        /* Option Item Formatting */
        .option-row {
            padding: 4.5px 5px;
            font-size: 10px;
        }

        .checkbox {
            display: inline-block;
            width: 9px;
            height: 9px;
            border: 1px solid #000;
            margin-right: 4px;
            vertical-align: middle;
            text-align: center;
            line-height: 8px;
            font-size: 10px;
            font-weight: bold;
        }

        .checkbox.checked {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        /* Accounting Formatting */
        .accounting-row {
            padding: 7.5px 5px;
            background: #fff7ed;
            font-size: 10px;
        }

        .accounting-code {
            display: inline-block;
            width: 40px;
            font-weight: bold;
            color: #9a3412;
        }

        /* ===========================
           ITEMS & ACCOUNTING TABLE
           =========================== */
        .items-table {
            border: 1px solid #0f172a;
            margin-bottom: 8px;
        }

        .items-table th {
            background: #e2e8f0;
            color: #0f172a;
            font-size: 10px;
            font-weight: bold;
            border: 1px solid #0f172a;
            padding: 5px 3px;
        }

        .items-table th.green-bg {
            background: #dcfce7;
            color: #14532d;
        }

        .items-table td {
            border: 1px solid #0f172a;
            padding: 4px;
            height: 17px;
            font-size: 10px;
        }

        .items-table td.green-bg {
            background: #f0fdf4;
        }

        .total-row td {
            background: #f8fafc;
            font-weight: bold;
        }

        /* ===========================
           SIGNATURE SECTION
           =========================== */
        .signature-table {
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .signature-title {
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
            padding-bottom: 6px;
        }

        .signature-space {
            height: 90px;
            vertical-align: bottom;
            text-align: center;
        }

        .signature-space img {
            max-height: 40px;
            width: auto;
        }

        .line-underline {
            border-bottom: 1px solid #000;
            display: inline-block;
            width: 70%;
            height: 16px;
        }
    </style>
</head>

<body>

    <div class="watermark">
        <img src="{{ public_path('images/logo.png') }}">
    </div>

    <!-- HEADER TABLE -->
    <table class="header-table">
        <tr>
            <td class="border-none" style="width: 20%;">
                @if (file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" class="logo">
                @endif
            </td>
            <td class="border-none text-center">
                <div class="header-title">FINANCE FORM</div>
            </td>
            <td class="border-none text-right" style="width: 20%;">
                <div class="form-code-box">FM02-01</div>
            </td>
        </tr>
    </table>

    <!-- ADDRESS BAR -->
    <div class="address-bar">
        #9-11 Street 476, Sangkat Toul Tompoung I, Khan Chamkarmon, Phnom Penh, Cambodia &nbsp;|&nbsp; P.O Box 2295
        &nbsp;&nbsp;&bull;&nbsp;&nbsp; Tel / Fax: (+855) 78 550 449
    </div>

    @php
        $transactions = [
            'cash_advance' => 'Cash Advance',
            'cash_advance_settlement' => 'Cash Advance Settlement',
            'reimbursement' => 'Reimbursement',
            'direct_payment' => 'Direct Payment/Deposit',
            'journal_entry' => 'Journal Entry',
            'receipt' => 'Receipt',
        ];

        $payments = [
            'cheque' => 'Cheque',
            'cash' => 'Cash',
            'bank_transfer' => 'B. Transfer',
            'internet_banking' => 'Internet Banking',
            'qr_code' => 'QR Code',
        ];
    @endphp

    <!-- MAIN GRID SECTION -->
    <table class="grid-table">
        <tr>
            <!-- LEFT INFORMATION -->
            <td style="width: 42%;">
                <table class="info-inner-table">
                    <tr>
                        <td class="info-label">Received From / Pay To</td>
                        <td class="info-value">
                            {{ $financeForm->received_from ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">The Amount of</td>
                        <td class="info-value amount text-left">
                            $ {{ number_format((float) ($financeForm->amount ?? 0), 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="6" class="info-label" style="vertical-align: top; text-align: left;">
                            Amount in Words</td>
                        <td rowspan="6" class="info-value"
                            style="
                                vertical-align: top;
                                text-align: left;
                                font-style: italic;
                                white-space: normal;
                                word-wrap: break-word;
                                overflow-wrap: break-word;
                                line-height: 16px;
                                height: 48px;
                                max-height: 48px;
                                overflow: hidden;
                            ">
                            {{ $financeForm->amount_in_words ?? '' }}
                        </td>
                    </tr>
                </table>
            </td>

            <!-- TRANSACTION TYPE -->
            <td style="width: 22%;">
                <table>
                    <tr>
                        <td class="column-header">Transaction Type</td>
                    </tr>
                    @foreach ($transactions as $key => $label)
                        <tr>
                            <td class="option-row">
                                <span
                                    class="checkbox {{ ($financeForm->transaction_type ?? '') == $label ? 'checked' : '' }}">
                                    {!! ($financeForm->transaction_type ?? '') == $label ? '&#10003;' : '' !!}
                                </span>
                                <span>{{ $label }}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>

            <!-- PAYMENT TYPE -->
            <td style="width: 16%;">
                <table>
                    <tr>
                        <td class="column-header">Payment Type</td>
                    </tr>
                    @foreach ($payments as $key => $label)
                        <tr>
                            <td class="option-row">
                                <span
                                    class="checkbox {{ ($financeForm->payment_type ?? '') == $label ? 'checked' : '' }}">
                                    {!! ($financeForm->payment_type ?? '') == $label ? '&#10003;' : '' !!}
                                </span>
                                <span>{{ $label }}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>

            <!-- ACCOUNTING USE ONLY -->
            <td style="width: 20%;">
                <table>
                    <tr>
                        <td class="column-header-accounting">Accounting Only</td>
                    </tr>
                    @foreach (['AV', 'AS', 'PV', 'RV', 'JV'] as $code)
                        <tr>
                            <td class="accounting-row">
                                <span class="accounting-code">{{ $code }}#</span>
                                <span style="font-weight: bold;">
                                    {{ ($financeForm->accounting_type ?? '') == $code ? $financeForm->reference_no ?? '_____________' : '_____________' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>

    <!-- FINANCE ITEMS & ACCOUNTING DETAIL TABLE -->
    <table class="items-table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 11%;">Date</th>
                <th rowspan="2" style="width: 31%;">Description</th>
                <th rowspan="1" style="width: 11%;">Amount</th>
                <th rowspan="2" style="width: 11%;">Account Code</th>
                <th rowspan="2" style="width: 16%;">Donor</th>
                <th colspan="2" class="green-bg" style="width: 20%;">ACCOUNT</th>
            </tr>
            <tr>
                <th>(USD)</th>
                <th class="green-bg">Debit</th>
                <th class="green-bg">Credit</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = optional($financeForm->items)->values() ?? collect();

                $rows = max($items->count(), 15);

                /*
                |--------------------------------------------------------------------------
                | ACCOUNTING TOTALS
                |--------------------------------------------------------------------------
                */

                $totalDebit = 0;

                $totalCredit = 0;

                /*
                |--------------------------------------------------------------------------
                | TRANSACTION VALUES
                |--------------------------------------------------------------------------
                */

                $advance = 0;
                $expense = 0;
                $settlement = 0;

                $income = 0;
                $charges = 0;
                $directPayment = 0;
                $reimbursement = 0;

                /*
                |--------------------------------------------------------------------------
                | READ ITEMS
                |--------------------------------------------------------------------------
                */

                foreach ($items as $item) {
                    $amount = (float) ($item->amount ?? 0);

                    $totalDebit += (float) ($item->debit ?? 0);
                    $totalCredit += (float) ($item->credit ?? 0);

                    $lineType = strtolower(str_replace(['-', ' ', '/'], '_', trim($item->line_type ?? '')));

                    /*
                    |--------------------------------------------------------------------------
                    | ADVANCE
                    |--------------------------------------------------------------------------
                    */

                    if (in_array($lineType, ['advance', 'cash_advance']) && $amount > 0) {
                        $advance += $amount;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | EXPENSE
                    |--------------------------------------------------------------------------
                    */

                    if ($lineType === 'expense' && $amount > 0) {
                        $expense += $amount;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | POSITIVE SETTLEMENT
                    |--------------------------------------------------------------------------
                    */

                    if ($lineType === 'settlement' && $amount > 0) {
                        $settlement += $amount;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | INCOME
                    |--------------------------------------------------------------------------
                    */

                    if (in_array($lineType, ['income', 'grant', 'donor_income', 'revenue']) && $amount > 0) {
                        $income += $amount;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | INCOME CHARGES
                    |--------------------------------------------------------------------------
                    */

                    if (
                        in_array($lineType, [
                            'expense',
                            'tax',
                            'bank',
                            'bank_charge',
                            'bank_charges',
                            'service_charge',
                            'service_charges',
                            'withholding_tax',
                        ]) &&
                        $amount > 0
                    ) {
                        $charges += $amount;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | DIRECT PAYMENT
                    |--------------------------------------------------------------------------
                    */

                    if (
                        in_array($lineType, [
                            'payment',
                            'payable',
                            'direct_payment',
                            'direct_pay',
                            'supplier_payment',
                            'supplier',
                            'consultant_payment',
                            'consultant',
                        ]) &&
                        $amount < 0
                    ) {
                        $directPayment = max($directPayment, abs($amount));
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | REIMBURSEMENT
                    |--------------------------------------------------------------------------
                    */

                    if (in_array($lineType, ['expense', 'reimbursement', 'reimbursement_expense']) && $amount > 0) {
                        $reimbursement += $amount;
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | AVAILABLE ADVANCE
                |--------------------------------------------------------------------------
                |
                | Used by Cash Advance Settlement / Refund
                |
                */

                $availableAdvance = $advance + $settlement;

                /*
                |--------------------------------------------------------------------------
                | TRANSACTION TYPE
                |--------------------------------------------------------------------------
                */

                $transactionType = strtolower(trim($financeForm->transaction_type ?? ''));

                /*
                |--------------------------------------------------------------------------
                | EXCEL-STYLE VALUES
                |--------------------------------------------------------------------------
                |
                | $displayAdvanceExpense
                |     = value shown in TOTAL (ADVANCE / EXPENSE)
                |
                | $displayAdvanceAmount
                |     = value shown in ADVANCE AMOUNT
                |
                | $displayTotal
                |     = value shown in final TOTAL
                |
                */

                $displayAdvanceExpense = 0;
                $displayAdvanceAmount = null;
                $displayTotal = null;

                switch ($transactionType) {
                    /*
                    |--------------------------------------------------------------------------
                    | JOURNAL ENTRY
                    |--------------------------------------------------------------------------
                    |
                    | Excel Journal Entry does not have a transaction total.
                    |
                    */

                    case 'journal_entry':
                    case 'journal':
                        $displayAdvanceExpense = null;
                        $displayAdvanceAmount = null;
                        $displayTotal = null;

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | INCOME
                    |--------------------------------------------------------------------------
                    |
                    | 1000 - 8 = 992
                    |
                    | Excel:
                    | TOTAL (ADVANCE / EXPENSE) = 992
                    | TOTAL                    = 992
                    |
                    */

                    case 'income':
                        $displayAdvanceExpense = max($income - $charges, 0);

                        $displayAdvanceAmount = null;

                        $displayTotal = $displayAdvanceExpense;

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | DIRECT PAYMENT
                    |--------------------------------------------------------------------------
                    |
                    | 1020
                    |
                    */

                    case 'direct_payment':
                    case 'direct_pay':
                        $displayAdvanceExpense = $directPayment;

                        $displayAdvanceAmount = null;

                        $displayTotal = $directPayment;

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | REIMBURSEMENT
                    |--------------------------------------------------------------------------
                    |
                    | 27 + 20 = 47
                    |
                    */

                    case 'reimbursement':
                    case 'reimbursment':
                        $displayAdvanceExpense = $reimbursement;

                        $displayAdvanceAmount = null;

                        $displayTotal = $reimbursement;

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | DISBURSEMENT
                    |--------------------------------------------------------------------------
                    |
                    | Excel:
                    |
                    | Expense = 170
                    | Advance = 150
                    | Total   = 20
                    |
                    */

                    case 'disbursement':
                    case 'cash_advance_disbursement':
                        $displayAdvanceExpense = $expense;

                        $displayAdvanceAmount = $advance;

                        $displayTotal = max($expense - $advance, 0);

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | CASH ADVANCE SETTLEMENT
                    |--------------------------------------------------------------------------
                    |
                    | Available Advance = Advance + Positive Settlement
                    |
                    | Total = absolute difference
                    |
                    */

                    case 'cash_advance_settlement':
                    case 'cash_advance_settle':
                    case 'settlement':
                        $displayAdvanceExpense = $expense;

                        $displayAdvanceAmount = $availableAdvance;

                        $displayTotal = abs($availableAdvance - $expense);

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | REFUND
                    |--------------------------------------------------------------------------
                    |
                    | Excel:
                    |
                    | Expense = 150
                    | Advance = 170
                    | Total   = 20
                    |
                    */

                    case 'refund':
                    case 'cash_advance_refund':
                        $displayAdvanceExpense = $expense;

                        $displayAdvanceAmount = $availableAdvance;

                        $displayTotal = abs($availableAdvance - $expense);

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | DEFAULT
                    |--------------------------------------------------------------------------
                    */

                    default:
                        $displayAdvanceExpense = $items
                            ->filter(function ($item) {
                                return (float) ($item->amount ?? 0) > 0;
                            })
                            ->sum(function ($item) {
                                return (float) $item->amount;
                            });

                        $displayAdvanceAmount = null;

                        $displayTotal = $displayAdvanceExpense;

                        break;
                }
            @endphp

            @for ($i = 0; $i < $rows; $i++)
                @php
                    $item = $items->get($i);

                    $amount = (float) ($item->amount ?? 0);

                    $transactionType = $financeForm->transaction_type;

                    $showRefund = in_array($transactionType, [
                        'reimbursement',
                        'refund',
                        'cash_advance_settlement',
                        'cash_advance',
                    ]);

                    $showIncome = $transactionType === 'income';

                    $showDisbursement = in_array($transactionType, ['direct_payment', 'disbursement']);

                    $showJournal = $transactionType === 'journal_entry';
                @endphp
                <tr>
                    <td class="text-center">
                        @if ($i === 0 && $item && $item->date)
                            {{ \Carbon\Carbon::parse($item->date)->format('d-M-Y') }}
                        @endif
                    </td>
                    <td>{{ $item->description ?? '' }}</td>
                    <td class="text-right">
                        @if ($item && $amount != 0)
                            @if ($amount < 0)
                                ({{ number_format(abs($amount), 2) }})
                            @else
                                {{ number_format($amount, 2) }}
                            @endif
                        @endif
                    </td>
                    <td class="text-center">{{ $item->account_code ?? '' }}</td>
                    <td class="text-center">{{ $item->donor ?? '' }}</td>
                    <td class="green-bg text-right">
                        {{ $item && $item->debit > 0 ? number_format($item->debit, 2) : '' }}
                    </td>
                    <td class="green-bg text-right">
                        {{ $item && $item->credit > 0 ? number_format($item->credit, 2) : '' }}
                    </td>
                </tr>
            @endfor

            <!-- TOTAL ADVANCE/EXPENSE ROW -->
            <tr class="total-row">
                <td colspan="2" class="fw-bold">TOTAL (ADVANCE / EXPENSE)</td>
                <td class="text-right fw-bold">
                    @if ($displayAdvanceExpense !== null)
                        {{ number_format($displayAdvanceExpense, 2) }}
                    @endif
                </td>
                <td>{{ $item->account_code ?? '' }}</td>
                <td>{{ $item->donor ?? '' }}</td>
                <td class="green-bg text-right fw-bold"></td>
                <td class="green-bg text-right fw-bold">
                    @if ($transactionType === 'reimbursement')
                        {{ number_format($totalDebit, 2) }}
                    @endif
                </td>
            </tr>

            <!-- ADVANCE AMOUNT REFERENCE ROW -->
            <tr>
                <td colspan="2" class="fw-bold" style="color: #475569;">
                    ADVANCE AMOUNT (Ref# <span
                        style="border-bottom: 1px dotted #000; display: inline-block; width: 140px;"></span>)
                </td>
                <td class="text-right fw-bold">
                    @if ($displayAdvanceAmount !== null)
                        {{ number_format($displayAdvanceAmount, 2) }}
                    @endif
                </td>
                <td></td>
                <td></td>
                <td class="green-bg"></td>
                <td class="green-bg"></td>
            </tr>

            <!-- FINAL TOTAL & REFUND / DISBURSEMENT ROW -->
            <tr class="total-row">
                <td colspan="2" class="fw-bold text-center">TOTAL</td>
                <td class="text-right fw-bold">
                    @if ($displayTotal !== null)
                        {{ number_format($displayTotal, 2) }}
                    @endif
                </td>


                @if (!$showJournal)

                    <td colspan="2" class="fw-bold text-center" style="font-size: 10px;">

                        @if ($showRefund)
                            REFUND
                        @elseif ($showIncome)
                            INCOME
                        @elseif ($showDisbursement)
                            DISBURSEMENT
                        @endif

                    </td>
                @else
                    <td colspan="2" class="fw-bold text-center" style="font-size: 10px;"></td>

                @endif

                <td class="green-bg text-right fw-bold">{{ number_format($totalDebit, 2) }}</td>
                <td class="green-bg text-right fw-bold">
                    @if ($transactionType === 'reimbursement')
                        {{ number_format($totalDebit, 2) }}
                    @else
                        {{ number_format($totalCredit, 2) }}
                    @endif
                </td>
            </tr>

            <!-- POSTED BY ROW -->
            <tr>
                <td colspan="4" class="border-none"></td>
                <td colspan="1" class="text-left fw-bold" style="background: #f1f5f9;">Posted by / Date:</td>
                <td colspan="2" style="background: #f1f5f9;"></td>
            </tr>
        </tbody>
    </table>

    <!-- SIGNATURE SECTION -->
    <table class="signature-table">
        <tr>
            <th style="width: 24%;" class="signature-title text-left">Prepared By</th>
            <th style="width: 24%;" class="signature-title text-left">Certified By</th>
            <th style="width: 24%;" class="signature-title text-left">Approved By</th>
            <th style="width: 24%;" class="signature-title text-left">Received By</th>
        </tr>
        <tr>
            <td class="signature-space">

            </td>
            <td class="signature-space">

            </td>
            <td class="signature-space">

            </td>
            <td class="signature-space">

            </td>
        </tr>
        <tr>
            <td><strong>Name:</strong> </td>
            <td><strong>Name:</strong> </td>
            <td><strong>Name:</strong> </td>
            <td><strong>Name:</strong> </td>
        </tr>

        <tr>
            <td><strong>Position:</strong> </td>
            <td><strong>Position:</strong> </td>
            <td><strong>Position:</strong> </td>
            <td><strong>Position:</strong> </td>
        </tr>
        <tr>
            <td style="padding-top: 4px;"><strong>Date:</strong> <span class="line-underline"></span></td>
            <td style="padding-top: 4px;"><strong>Date:</strong> <span class="line-underline"></span></td>
            <td style="padding-top: 4px;"><strong>Date:</strong> <span class="line-underline"></span></td>
            <td style="padding-top: 4px;"><strong>Date:</strong> <span class="line-underline"></span></td>
        </tr>
    </table>

</body>

</html>
