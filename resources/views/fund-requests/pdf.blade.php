<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>CONCEPT NOTE</title>

    <style>
        @page {
            margin: 6mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .watermark {
            position: fixed;
            top: 35%;
            left: 25%;
            width: 50%;
            text-align: center;
            z-index: -1;
            opacity: 0.05;
        }

        .watermark img {
            width: 500px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            width: auto;
            height: 80px;
        }

        .header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: green;
        }

        .field-table {
            width: 100%;
            margin-bottom: 10px;
        }

        .field-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        .label {
            width: 60px;
            font-size: 10px;
            font-weight: bold;
        }

        .line {
            border-bottom: 1px dotted #000;
            font-size: 12px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 8px;
            padding-bottom: 2px;
            font-size: 14px;
            border-bottom: 1px solid #3c7202;
            color: #2f510a;
        }

        .section-content {
            min-height: 10px;
            padding-bottom: 5px;
            font-size: 11px;
        }

        .budget-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .budget-table th,
        .budget-table td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 12px;
        }

        .budget-table thead th {
            background: #92d050;
            text-align: center;
            font-weight: bold;
        }

        .budget-table td {
            vertical-align: middle;
            font-size: 10px;
        }

        .total-row td {
            font-weight: bold;
            font-size: 12px;
        }

        .total-row td:first-child {
            text-align: center;
        }

        .note {
            margin-top: 15px;
        }

        .signature-table {
            width: 100%;
            margin-top: 10px;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
        }

        .signature-box {
            padding: 0 10px;
        }

        .rigth {
            margin-left: 30%;
        }

        .signature-image {
            height: 50px;
            max-width: auto;
            object-fit: contain;
            margin: 15px 0;
        }

        .label {
            font-weight: bold;
            font-size: 10px;
        }

        .signature-box p {
            margin: 0;
            line-height: 1.2;
        }
    </style>

</head>

<body>

    <div class="watermark">
        <img src="{{ public_path('images/logo.png') }}">
    </div>

    <table class="header-table">

        <tr>

            <td width="20%" align="left">

                <img src="{{ public_path('images/logo.png') }}" class="logo">

            </td>

            <td width="60%" align="center">

                <div class="header">
                    CONCEPT NOTE
                </div>

            </td>

            <td width="20%" align="right">

                <strong>FM02-02</strong>

            </td>

        </tr>

    </table>

    <div style="text-align: center; margin-bottom: 10px;">
        @foreach ($fundRequest->donorLogos as $donor)
            <img src="{{ public_path('storage/' . $donor->logo) }}"
                style="height:50px; margin:0 6px; vertical-align:middle;">
        @endforeach
    </div>

    <table class="field-table">

        <tr>
            <td class="label">Title:</td>
            <td class="line">{{ $fundRequest->title }}</td>
        </tr>

        <tr>
            <td class="label">Date:</td>
            <td class="line">
                {{ \Carbon\Carbon::parse($fundRequest->request_date)->format('d M Y') }}
            </td>
        </tr>

        <tr>
            <td class="label">Place:</td>
            <td class="line">{{ $fundRequest->place }}</td>
        </tr>

    </table>

    <div class="section-title">
        1. Rationale:
    </div>

    <div class="section-content">
        {!! nl2br(e($fundRequest->rationale)) !!}
    </div>

    <div class="section-title">
        2. Objectives:
    </div>

    <div class="section-content">
        {!! nl2br(e($fundRequest->objectives)) !!}
    </div>

    <div class="section-title">
        3. Expectations:
    </div>

    <div class="section-content">
        {!! nl2br(e($fundRequest->expectation)) !!}
    </div>

    <div class="section-title">
        4. Estimate Participants:
    </div>

    <div class="section-content">
        {!! nl2br(e($fundRequest->participant_list)) !!}
    </div>

    <div class="section-title">
        5. Collaboration with Partners:
    </div>

    <div class="section-content">
        {!! nl2br(e($fundRequest->fund_by)) !!}
    </div>

    <div class="section-title">
        6. Detail Budget Calculation and donors
    </div>

    <table class="budget-table">

        <thead>

            <tr>

                <th rowspan="3" width="3%">
                    No.
                </th>

                <th rowspan="3" width="20%">
                    Description
                </th>

                <th colspan="3">
                    Detail Budget Calculation
                </th>

                <th rowspan="2" width="15%">
                    Total
                </th>

                <th rowspan="3" width="15%">
                    Budget Code
                </th>

                <th rowspan="3" width="15%">
                    Donor Code
                </th>

                <th rowspan="3" width="12%">
                    Donor
                </th>

            </tr>

            <tr>

                <th width="10%">
                    Cost
                </th>

                <th width="10%">
                    Quantity
                </th>

                <th width="8%">
                    Time
                </th>

            </tr>

            <tr>

                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4 = 1 * 2 * 3</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($fundRequest->items as $item)
                <tr>

                    <td align="center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->description }}
                    </td>

                    <td align="right">
                        {{ number_format($item->cost, 2) }} $
                    </td>

                    <td align="center">
                        {{ $item->quantity }}
                    </td>

                    <td align="center">
                        {{ $item->time }}
                    </td>

                    <td align="right">
                        {{ number_format($item->budget, 2) }} $
                    </td>

                    <td align="center">
                        {{ $item->budget_code }}
                    </td>

                    <td align="center">
                        {{-- {{ $item->donor_code }} --}}
                    </td>

                    <td align="center">
                        {{ $item->donor }}
                    </td>

                </tr>
            @endforeach

            <tr class="total-row">

                <td colspan="5" align="center">
                    TOTAL
                </td>

                <td align="right">
                    {{ number_format($fundRequest->total_budget, 2) }} $
                </td>

                <td colspan="3" style="border:none;"></td>
            </tr>

        </tbody>

    </table>

    @if ($fundRequest->agendas->count())

        <div class="section-title">
            7. Tentative Agenda
        </div>

        <table class="budget-table">

            <thead>

                <tr>

                    <th width="5%">
                        No.
                    </th>

                    <th width="20%">
                        Time
                    </th>

                    <th width="40%">
                        Activity
                    </th>

                    <th width="22%">
                        Responsible Person
                    </th>

                    <th width="12%">
                        Remarks
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach ($fundRequest->agendas as $agenda)
                    <tr>

                        <td align="center">
                            {{ $loop->iteration }}
                        </td>

                        <td align="center">

                            {{ \Carbon\Carbon::parse($agenda->start_time)->format('g:i A') }}

                            -

                            {{ \Carbon\Carbon::parse($agenda->end_time)->format('g:i A') }}

                        </td>

                        <td>
                            {!! nl2br(e($agenda->activity)) !!}
                        </td>

                        <td>
                            {{ $agenda->responsible_person ?? '' }}
                        </td>

                        <td>
                            {{ $agenda->remarks ?? '' }}
                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    @endif

    <table class="signature-table">

        <tr>

            {{-- Prepared By --}}
            <td>

                <div class="signature-box">

                    <p>
                        <span class="label">Prepared by:</span>
                    </p>

                    <p style="height: 85px;">
                        {{-- @if ($fundRequest->requester_signature)
                        <img class="signature-image"
                            src="{{ public_path('storage/' . $fundRequest->requester_signature) }}">
                    @endif --}}
                    </p>

                    <p>
                        <span class="label">Name:</span>
                        <span style="font-size: 10px"> {{ $fundRequest->user->name }} </span>
                    </p>

                    <p>
                        <span class="label">Position:</span>
                        <span style="font-size: 10px"> {{ $fundRequest->user->position ?? '-' }} </span>
                    </p>

                    <p>
                        <span class="label">Date:</span>
                        <span style="font-size: 10px">
                            {{ \Carbon\Carbon::parse($fundRequest->request_date)->format('d M Y') }} </span>
                    </p>

                </div>

            </td>

            {{-- Reviewed By --}}
            <td>

                <div class="signature-box rigth">

                    <p>
                        <span class="label">Reviewed by:</span>
                    </p>

                    <p style="height: 85px;">
                        {{-- @if ($fundRequest->reviewer_signature)
                            <img class="signature-image"
                                src="{{ public_path('storage/' . $fundRequest->reviewer_signature) }}">
                        @endif --}}
                    </p>

                    <p>
                        <span class="label">Name:</span>
                        <span style="font-size: 10px"> {{ $fundRequest->reviewer?->name ?? '' }} </span>
                    </p>

                    <p>
                        <span class="label">Position:</span>

                        <span style="font-size: 10px"> {{ $fundRequest->reviewer?->position ?? '-' }} </span>
                    </p>

                    <p>
                        <span class="label">Date:</span>

                        <span style="font-size: 10px">
                            @if ($fundRequest->request_date)
                                {{ \Carbon\Carbon::parse($fundRequest->request_date)->format('d M Y') }}
                            @endif
                        </span>
                    </p>

                </div>

            </td>


            {{-- Approved By --}}
            <td>

                <div class="signature-box rigth">

                    <p>
                        <span class="label">Approved by:</span>
                    </p>

                    <p style="height: 85px;">
                        {{-- @if ($fundRequest->approved_signature)
                        <img class="signature-image"
                            src="{{ public_path('storage/' . $fundRequest->approved_signature) }}">
                    @endif --}}
                    </p>

                    <p>
                        <span class="label">Name:</span>
                        <span style="font-size: 10px"> {{ $fundRequest->approver?->name ?? '' }} </span>
                    </p>

                    <p>
                        <span class="label">Position:</span>

                        <span style="font-size: 10px"> {{ $fundRequest->approver?->position ?? '-' }} </span>
                    </p>

                    <p>
                        <span class="label">Date:</span>

                        <span style="font-size: 10px">
                            @if ($fundRequest->request_date)
                                {{ \Carbon\Carbon::parse($fundRequest->request_date)->format('d M Y') }}
                            @endif
                        </span>
                    </p>

                </div>

            </td>

        </tr>

    </table>

</body>

</html>
