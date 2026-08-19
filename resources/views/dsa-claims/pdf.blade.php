<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'dejavusans', 'khmer', sans-serif;
            font-size: 10px;
            color: #111;
            line-height: 1.3;
        }

        .header-table,
        .info-table,
        .data-table,
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        /* Header */
        .logo {
            margin-bottom: 6px;
        }

        .doc-code {
            text-align: right;
            font-weight: bold;
            font-size: 11px;
        }

        .form-title {
            color: #047f0e;
            font-size: 18px;
            text-align: center;
            margin: 10px 0;
            line-height: 2;
            font-weight: bold;
        }

        /* Information Grid */
        .info-table {
            font-size: 15px;
            line-height: 1.5;
        }

        .info-table td {
            padding: 3px 4px;
            vertical-align: top;
        }

        /* Section Titles */
        .section-header {
            background-color: #047f0e;
            color: #f9f9f9;
            text-align: center;
            font-weight: bold;
            padding: 4px;
            border: 1px solid #777;
            font-size: 13px;
        }

        /* Table Styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #111;
            padding: 4px 3px;
            vertical-align: middle;
            font-size: 11px;
            line-height: 1.4;
            margin: 0px;
        }

        /* Main Section Header Row */
        .data-table .section-title-row {
            background-color: #ffffff;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            color: #047f0e;
            /* Matching the blue title text */
            padding: 5px;
        }

        .data-table th {
            background-color: #ffffff;
            text-align: center;
            font-weight: normal;
        }

        .data-table td {
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* Purpose Box */
        .purpose-table {
            width: 100%;
            border-collapse: collapse;
        }

        .purpose-cell {
            border: 1px solid #000;
            border-top: none;
            border-bottom: none;
            font-size: 13px;
            height: 60px;
            vertical-align: top;
            /* or top */
            padding: 6px;
        }

        .purpose-title {
            color: #047f0e;
            font-weight: bold;
        }

        /* DSA Tables */
        .grid-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 12px;
        }

        .grid-table th,
        .grid-table td {
            border: 1px solid #444;
            padding: 3px;
        }

        .group-title {
            text-align: center;
            font-weight: normal;
            font-size: 12px;
        }

        .policy-title {
            text-align: center;
            padding: 5px;
            font-weight: normal;
            font-size: 12px;
        }

        .grid-table thead tr:nth-child(2) th {
            font-weight: normal;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .total-cell {
            font-weight: bold;
        }

        .footer-row {
            background: #efefef;
            font-weight: bold;
        }

        .footer-title {
            color: #047f0e;
            text-align: left;
            font-weight: bold;
        }

        .grand-total {
            font-weight: bold;
        }

        .policy-cell {
            vertical-align: top;
            font-size: 12px;
            line-height: 1.35;
            padding: 6px;
        }

        .policy-cell strong {
            font-size: 12px;
        }

        .policy-cell em {
            font-style: italic;
            font-weight: bold;
        }

        .policy-cell div {
            margin-bottom: 2px;
        }

        /* Signature */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
            line-height: 1.8;
        }

        .signature-left {
            width: 40%;
            vertical-align: top;
            padding: 0 10px;
        }
        .signature-center {
            width: 35%;
            vertical-align: top;
            padding: 0 10px;
        }
        .signature-rigth {
            width: 25%;
            vertical-align: top;
            padding: 0 10px;
        }

        .signature-image-wrapper {
            height: 55px;
        }

        /* Note */
        .note-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border-top: 2px solid #000;
        }

        .note-table td {
            padding: 8px 1px;
            font-size: 12px;
        }

        .note-label {
            width: 110px;
            white-space: nowrap;
            font-weight: normal;
        }

        .note-line {
            height: 20px;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <table class="header-table">
        <tr>
            <td style="width: 30%;">
                @if (file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" class="logo" style="width: 20%;">
                @endif
            </td>
            <td style="width: 50%;" class="form-title">
                <div>ប័ណ្ណស្នើសុំប្រាក់សំណងការធ្វើដំណើរ</div>
                <div>DSA CLAIM FORM</div>
            </td>
            <td style="width: 20%;" class="doc-code">
                FM02-06
            </td>
        </tr>
    </table>

    <!-- Metadata Section -->
    <table class="info-table">
        <tr>
            <td style="width: 15%;">Date requested:</td>
            <td style="width: 45%;">{{ optional($dsaClaim->date_requested)->format('d-M-Y') }}
            <td style="width: 15%;">Name:</td>
            <td style="width: 25%;">{{ $dsaClaim->user->name ?? '' }}</td>
            </td>
        </tr>
        <tr>
            <td>Signature:</td>
            <td></td>
            <td>Title / Position:</td>
            <td>{{ $dsaClaim->user->position ?? '' }}</td>
        </tr>
        <tr>
            <td>Department:</td>
            <td>{{ $dsaClaim->department->name ?? '' }}</td>
            <td>Budget Code:</td>
            <td>{{ $dsaClaim->budget_code }}</td>
        </tr>
        <tr>
            <td>Donors:</td>
            <td>{{ $dsaClaim->donor ?? '  ' }}</td>
            <td>Donor Code:</td>
            <td>{{ $dsaClaim->donor_code ?? '   ' }}</td>
        </tr>
    </table>

    <!-- Travel Information -->
    <table class="data-table">
        <thead>
            <!-- Title Row inside Table -->
            <tr>
                <th colspan="5" class="section-title-row">
                    ព័ត៌មានការធ្វើដំណើរ / TRAVEL INFORMATON
                </th>
            </tr>
            <!-- Table Column Headers -->
            <tr>
                <th style="width: 15%;">កាលបរិច្ឆេទ<br>Date</th>
                <th style="width: 18%;">ចេញពី<br>From</th>
                <th style="width: 18%;">ទៅកាន់<br>To</th>
                <th style="width: 29%;">គោលបំណង<br>Purpose</th>
                <th style="width: 20%;">ម៉ោងចេញ-ម៉ោងទៅដល់<br>Leaving-Arriving Time</th>
            </tr>
        </thead>
        <tbody>

            @php
                $minRows = 5;
                $travelCount = $dsaClaim->travels->count();
            @endphp

            @forelse($dsaClaim->travels as $travel)
                <tr>
                    <td class="text-center">{{ optional($travel->travel_date)->format('d-M-Y') }}</td>
                    <td>{{ $travel->from_location }}</td>
                    <td>{{ $travel->to_location }}</td>
                    <td>{{ $travel->purpose }}</td>
                    <td class="text-center">
                        {{ $travel->departure_time ? \Carbon\Carbon::parse($travel->departure_time)->format('h:i A') : '' }}
                        {{ $travel->arrival_time ? ' - ' . \Carbon\Carbon::parse($travel->arrival_time)->format('h:i A') : '' }}
                    </td>
                </tr>
            @empty
            @endforelse

            {{-- Add empty rows until there are at least 3 rows --}}
            @for ($i = $travelCount; $i < $minRows; $i++)
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor

        </tbody>
    </table>

    <!-- Purpose Box beneath table -->
    <table class="purpose-table">
        <tr>
            <td class="purpose-cell">
                <span class="purpose-title">
                    គោលបំណងនៃការធ្វើដំណើរ / Purpose of travel:
                </span>
                {{ $dsaClaim->purpose_of_travel }}
            </td>
        </tr>
    </table>

    <!-- Expense Table -->
    <table class="grid-table">
        <thead>
            <tr>
                <th colspan="8" class="group-title">
                    DSA (Local or International)
                </th>
                <th rowspan="2" class="policy-title">
                    Article 2.3 Travel Policy
                </th>
            </tr>
            <tr>
                <th style="width:10%">Date</th>
                <th style="width:7%">Brk</th>
                <th style="width:7%">Lnc</th>
                <th style="width:7%">Dnn</th>
                <th style="width:8%">Acc</th>
                <th style="width:8%">Transp</th>
                <th style="width:8%">Inciden</th>
                <th style="width:10%">Total</th>
            </tr>
        </thead>

        <tbody>

            @php
                $totBrk = $totLnc = $totDnn = $totAcc = $totTransp = $totInc = $grandTot = 0;
                $rowCount = max(count($dsaClaim->items), 12);
            @endphp

            @foreach ($dsaClaim->items as $item)
                @php
                    $totBrk += $item->breakfast;
                    $totLnc += $item->lunch;
                    $totDnn += $item->dinner;
                    $totAcc += $item->accommodation;
                    $totTransp += $item->transport;
                    $totInc += $item->incident;
                    $grandTot += $item->total;
                @endphp

                <tr>

                    <td class="center">
                        {{ optional($item->expense_date)->format('d-M-Y') }}
                    </td>

                    <td class="right">{{ $item->breakfast ? number_format($item->breakfast, 2) : '' }}</td>

                    <td class="right">{{ $item->lunch ? number_format($item->lunch, 2) : '' }}</td>

                    <td class="right">{{ $item->dinner ? number_format($item->dinner, 2) : '' }}</td>

                    <td class="right">{{ $item->accommodation ? number_format($item->accommodation, 2) : '' }}</td>

                    <td class="right">{{ $item->transport ? number_format($item->transport, 2) : '' }}</td>

                    <td class="right">{{ $item->incident ? number_format($item->incident, 2) : '' }}</td>

                    <td class="right total-cell">
                        $ {{ number_format($item->total, 2) }}
                    </td>

                    @if ($loop->first)
                        <td rowspan="{{ $rowCount + 1 }}" class="policy-cell">

                            <strong><u>Domestic:</u></strong>

                            <div>• Leave Before 8:00 AM (USD 5)</div>
                            <div>• Leave Before 1:00 PM (USD 5 for lunch)</div>
                            <div>• Leave Before 6:00 PM (USD 5 for dinner)</div>
                            <div>• Arrive after 1:00 PM (USD 5 for lunch)</div>
                            <div>• Arrive after 6:00 PM (USD 5 for dinner)</div>

                            <br>

                            <strong>Local Transport</strong>

                            <div>
                                • Local transportation cost (USD5) is for Tuk Tuk or Moto Dup.
                                See criteria under this article.
                            </div>

                            <br>

                            <strong><em>International:</em></strong>

                            <br>

                            <strong><em>-Developing Country</em></strong>

                            <div>
                                &gt;Breakfast $10, Lunch $15, Dinner $15,
                                Incidental $10,
                                Accommodation actual receipt rank from $20-$50
                            </div>

                            <br>

                            <strong><em>-Developed Country</em></strong>

                            <div>
                                &gt;Breakfast $15, Lunch $20, Dinner $20,
                                Incidental $15,
                                Accommodation actual receipt rank from $50-$70
                            </div>

                        </td>
                    @endif

                </tr>
            @endforeach

            @for ($i = count($dsaClaim->items); $i < 12; $i++)
                <tr>

                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td class="right total-cell">$ 0.00</td>

                </tr>
            @endfor

            <tr class="footer-row">

                <td class="footer-title">Total Amount</td>

                <td class="right">$ {{ number_format($totBrk, 2) }}</td>
                <td class="right">$ {{ number_format($totLnc, 2) }}</td>
                <td class="right">$ {{ number_format($totDnn, 2) }}</td>
                <td class="right">$ {{ number_format($totAcc, 2) }}</td>
                <td class="right">$ {{ number_format($totTransp, 2) }}</td>
                <td class="right">$ {{ number_format($totInc, 2) }}</td>

                <td class="right grand-total">
                    $ {{ number_format($grandTot, 2) }}
                </td>

            </tr>

        </tbody>

    </table>

    <table class="signature-table">
        <tr>
            {{-- Verified --}}
            <td class="signature-left">
                <p><strong>Verified by:</strong></p>

                <span class="signature-image-wrapper"></span><br><br>

                <p>............................................</p>
                <p>(Name and Signature)</p>
                <p>
                    Date: ................................
                </p>
            </td>

            {{-- Paid --}}
            <td class="signature-center">
                <p><strong>Paid by:</strong></p>

                <span class="signature-image-wrapper"></span><br><br>

                <p>............................................</p>
                <p>(Name and Signature)</p>
                <p>
                    Date: ................................
                </p>
            </td>

            {{-- Received --}}
            <td class="signature-rigth">
                <p><strong>Received by:</strong></p>

                <span class="signature-image-wrapper"></span><br><br>

                <p>............................................</p>
                <p>(Name and Signature)</p>
                <p>
                    Date: ................................
                </p>
            </td>
        </tr>
    </table>

    <table class="note-table">
        <tr>
            <td class="note-label"><strong>Note/Comment:</strong></td>
            <td class="note-line"></td>
        </tr>
    </table>


</body>

</html>
