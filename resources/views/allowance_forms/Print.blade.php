<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8" />
    <style>
        /* Page Setup for A4 Landscape */
        @page {
            size: A4 landscape;
            margin: 4mm 6mm 4mm 6mm;
        }

        body {
            font-family: 'battambang', sans-serif !important;
            font-size: 10px;
            color: #000;
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
            opacity: 0.06;
        }

        .watermark img {
            width: 500px;
        }

        /* Header Layout */
        .header-table {
            width: 100%;
            height: 40px;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
        }

        .title-text {
            text-align: center;
            font-weight: bold;
            font-size: 10px;
            margin-right: 40px;
        }

        /* Form Details Top Meta */
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
            font-size: 11px;
        }

        .meta-table td {
            padding: 1px 0;
            vertical-align: bottom;
        }

        .dotted-line {
            font-weight: bold;
        }

        /* Compact Table Layout */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 10px;
            /* Compact font for grid */
            border: 1px solid #000;
            page-break-inside: auto;
        }

        .data-table tr {
            page-break-inside: avoid;
        }

        .participant-last-row td {
            border-bottom: 0.8pt solid #000 !important;
        }

        .data-table th {
            border: 1px solid #000;
            /* Bright cyan/blue headers */
            text-align: center;
            vertical-align: middle;
            padding: 0px 1px;
            /* Minimal padding */
            font-weight: bold;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 0px 6px;
            /* Tight padding to save vertical space */
            vertical-align: middle;
            line-height: 1.8;
            word-wrap: break-word;
            height: 8px;
            /* Fixed small row height */
        }

        /* Solid outer column borders */
        .solid-border {
            border: 1px solid #ffff;
        }


        /* Alignment Classes */
        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .font-14 {
            font-size: 12px;
        }

        .bold {
            font-weight: bold !important;
        }

        .grand-total-box {
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            border: 0.5pt solid #000 !important;
        }

        /* Footer summary */
        .summary-label {
            font-weight: bold;
            background: #f5f5f5;
        }

        .signature-box {
            text-align: center;
            vertical-align: top;
            font-weight: bold;
        }

        .signature-space {
            height: 35px;
        }

        /* Signatures Section */
        .signature-table {
            width: 100%;
            margin-top: 12px;
            font-size: 11px;
            line-height: 1.5;
            margin-bottom: 3px;
        }

        /* Footer Notes */
        .footer-abbrev {
            margin-top: 1px;
            border-top: 0.5pt solid #000;
            padding-top: 3px;
            font-size: 8pt;
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <div class="watermark">
        <img src="{{ asset('images/logo.png') }}">
    </div>

    @php
        $chunkedParticipants = $participants->chunk(4)->map(function ($chunk) {
            return $chunk->values()->pad(4, null);
        });
    @endphp

    @foreach ($chunkedParticipants as $chunkIndex => $participantGroup)
        <!-- Logos & Header -->
        <table class="header-table">
            <tr>
                <td style="width: 20%; text-align: left;">
                    <img src="{{ asset('images/logo.png') }}" style="height:50px;">
                </td>

                <td style="width: 55%; text-align: center;">
                    <img src="{{ asset('images/exp.jpg') }}" style="height: 40px;">
                </td>

                <td style="width: 25%; text-align: right;">
                    @foreach ($allowanceForm->donorLogos as $logo)
                        @if (!empty($logo->logo) && file_exists(asset('storage/' . $logo->logo)))
                            <img src="{{ asset('storage/' . $logo->logo) }}"
                                style="height: 50px; margin-left: 5px; vertical-align: middle;">
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>

        <!-- Document Title -->
        <div class="title-text" style="color: #006600; margin-bottom: 1px;">
            ប្រាក់ឧបត្ថម្ភសម្រាប់អ្នកចូលរួម / <span style="color: #000;">ALLOWANCE FOR PARTICIPANT</span>
        </div>

        <!-- Meta Information Fields -->
        <table class="meta-table">

            <tr>

                <td width="75%">

                    <table width="100%">
                        <tr>
                            <td width="20%">For activity:
                                <span class="dotted-line">{{ $allowanceForm->activity ?? '' }}</span>
                            </td>
                        </tr>
                    </table>

                </td>

                <td width="25%">

                    <table width="100%">
                        <tr>
                            <td width="45%">Starting date:
                                <span
                                    class="dotted-line">{{ !empty($allowanceForm->start_date) ? \Carbon\Carbon::parse($allowanceForm->start_date)->format('d M Y') : '' }}</span>
                            </td>
                        </tr>
                    </table>

                </td>

            </tr>

            <tr>

                <td>

                    <table width="100%">
                        <tr>
                            <td width="20%">
                                Place of conduct activity:
                                <span class="dotted-line">{{ $allowanceForm->venue ?? '' }}</span>
                            </td>
                        </tr>
                    </table>

                </td>

                <td>

                    <table width="100%">
                        <tr>
                            <td width="45%">
                                Ending date:
                                <span
                                    class="dotted-line">{{ !empty($allowanceForm->end_date) ? \Carbon\Carbon::parse($allowanceForm->end_date)->format('d M Y') : '' }}</span>
                            </td>
                        </tr>
                    </table>

                </td>

            </tr>

            <tr>

                <td width="50%">

                    <table width="100%">
                        <tr>

                            <td width="35%">
                                Budget line/code:
                                <span class="dotted-line">
                                    {{ $allowanceForm->budget_code ?? '' }}
                                </span>
                            </td>

                            <td width="25%">
                                Program:
                                <span class="dotted-line">
                                    {{ optional($allowanceForm->user?->department)->name }}
                                </span>
                            </td>

                        </tr>
                    </table>

                </td>

                <td width="50%">

                    <table width="100%">
                        <tr>

                            <td width="20%">
                                Donor:
                                <span class="dotted-line">
                                    {{ $allowanceForm->donor ?? '' }}
                                </span>
                            </td>

                            <td width="30%">
                                Donor's Code:
                                <span class="dotted-line">
                                    {{ $allowanceForm->donor_code ?? '' }}
                                </span>
                            </td>

                        </tr>
                    </table>

                </td>

            </tr>

        </table>

        <!-- Table Details -->
        <table class="data-table">

            @php
                $dateCols = max(count($dates), 1);
                $allowanceTypes = [
                    'Breakfast' => 'breakfast',
                    'Lunch' => 'lunch',
                    'Dinner' => 'dinner',
                    'Acc' => 'accommodation',
                    'Taxi/Bus' => 'taxi',
                    'L. Tran/Inc' => 'local_transport',
                ];

                // Reset page/chunk totals for each page group
                $foodTotal = 0;
                $accTotal = 0;
                $transportTotal = 0;
                $grandTotal = 0;
            @endphp

            <thead>
                <tr>
                    <th rowspan="2" width="3%" class="solid-border">No</th>
                    <th rowspan="2" width="15%" class="solid-border">
                        Name<br>(Position &amp; organization)
                    </th>
                    <th rowspan="2" width="3%" class="solid-border">Sex</th>
                    <th rowspan="2" width="17%" class="solid-border">
                        Village, Commune, District,<br>Province (be specific)
                    </th>
                    <th rowspan="2" width="12%" class="solid-border">
                        Allowance Type
                    </th>
                    <th colspan="{{ $dateCols }}" class="solid-border">Date</th>
                    <th rowspan="2" width="10%" class="solid-border">Total</th>
                    <th rowspan="2" width="13%" class="solid-border">Total and Signature</th>
                </tr>
                <tr>
                    @forelse($dates as $date)
                        <th width="5%" class="solid-border">
                            {{ \Carbon\Carbon::parse($date)->format('d/m') }}
                        </th>
                    @empty
                        <th class="solid-border">&nbsp;</th>
                    @endforelse
                </tr>
            </thead>

            <tbody>
                @foreach ($participantGroup as $participantIndex => $participant)
                    @php
                        $isEmptyParticipant = $participant === null;

                        $costs = $isEmptyParticipant ? [] : $participant->costs ?? [];

                        $participantTotal = 0;

                        foreach ($costs as $day) {
                            $participantTotal +=
                                ($day['breakfast'] ?? 0) +
                                ($day['lunch'] ?? 0) +
                                ($day['dinner'] ?? 0) +
                                ($day['accommodation'] ?? 0) +
                                ($day['taxi'] ?? 0) +
                                ($day['local_transport'] ?? 0);
                        }

                        // Accumulate totals for the current page chunk
                        foreach ($costs as $day) {
                            $foodTotal += ($day['breakfast'] ?? 0) + ($day['lunch'] ?? 0) + ($day['dinner'] ?? 0);
                            $accTotal += $day['accommodation'] ?? 0;
                            $transportTotal += ($day['taxi'] ?? 0) + ($day['local_transport'] ?? 0);
                        }
                        $grandTotal += $participantTotal;
                    @endphp

                    @foreach ($allowanceTypes as $label => $field)
                        @php
                            $isLastRow = $loop->last;
                        @endphp
                        <tr class="{{ $isLastRow ? 'participant-last-row' : '' }}">

                            @if ($loop->first)
                                <td rowspan="6" class="text-center bold solid-border">
                                    {{ $participantIndex + 1 }}
                                </td>

                                <td rowspan="6" class="text-left font-14 solid-border">
                                    @if ($participant)
                                        <strong>{{ $participant->name }}</strong>
                                        @if ($participant->position)
                                            <br>{{ $participant->position }}
                                        @endif
                                        @if ($participant->organization)
                                            <br>{{ $participant->organization }}
                                        @endif
                                    @else
                                        &nbsp;
                                    @endif
                                </td>

                                <td rowspan="6" class="text-center solid-border">
                                     @if ($participant)
                                        {{ $participant->gender }}
                                    @else
                                        &nbsp;
                                    @endif
                                </td>

                                <td rowspan="6" class="text-left font-14 solid-border">
                                    @if ($participant)
                                        <div>
                                            {{ $participant->province ?: '-' }}
                                        </div>

                                        @if ($participant->distance)
                                            <div style="margin-top:4px; color:#555;">
                                                Distance: {{ number_format($participant->distance, 2) }} km
                                            </div>
                                        @endif

                                        @if ($participant->remarks)
                                            <div style="margin-top:4px;">
                                                {{ $participant->remarks }}
                                            </div>
                                        @endif
                                    @else
                                        &nbsp;
                                    @endif
                                </td>
                            @endif

                            <td class="text-left bold">
                                {{ $label }}
                            </td>

                            @foreach ($dates as $index => $date)
                                @php
                                    $value = $costs[$index][$field] ?? 0;
                                @endphp
                                <td class="text-right">
                                    {{ $value > 0 ? number_format($value, 2) : '' }}
                                </td>
                            @endforeach

                            @if (count($dates) == 0)
                                <td></td>
                            @endif

                            <td class="text-right">
                                @php
                                    $rowTotal = collect($costs)->sum(function ($day) use ($field) {
                                        return $day[$field] ?? 0;
                                    });
                                @endphp
                                ${{ number_format($rowTotal, 2) }}
                            </td>

                            {{-- Total and Signature Column Layout --}}
                            @if ($loop->index == 0)
                                <td class="text-center bold solid-border" style="border: none !important;">
                                    TOTAL
                                </td>
                            @elseif ($loop->index == 1)
                                <td class="text-center bold solid-border" style="border: none !important;">
                                    ${{ number_format($participantTotal, 2) }}
                                </td>
                            @elseif ($loop->index == 2)
                                <td class="text-center bold solid-border" style="border: none !important;">
                                    SIGNATURE
                                </td>
                            @elseif ($loop->index == 3)
                                <td rowspan="3" class="solid-border" style="border-top: none !important;"></td>
                            @endif

                        </tr>
                    @endforeach
                @endforeach

                @php
                    $totalPages = ceil($participants->count() / 4);
                @endphp

                <!-- Summary Footer Rows (OUTSIDE the participant loop) -->
                <tr>
                    <td colspan="{{ 3 + $dateCols }}" rowspan="3" class="text-center bold">
                        TOTAL PAGE {{ $chunkIndex + 1 }} OF {{ $totalPages }}
                    </td>
                    <td colspan="2" class="text-left bold solid-border">Food</td>
                    <td class="text-right bold solid-border">${{ number_format($foodTotal, 2) }}</td>
                    <td class="grand-total-box bold">GRAND TOTAL</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-left bold solid-border">Acc</td>
                    <td class="text-right bold solid-border">${{ number_format($accTotal, 2) }}</td>
                    <td class="grand-total-box bold" rowspan="2"
                        style="font-size: 8.5pt; vertical-align: middle;">
                        ${{ number_format($grandTotal, 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-left bold solid-border">Taxi/Bus &amp; L.Tran</td>
                    <td class="text-right bold solid-border">${{ number_format($transportTotal, 2) }}</td>
                </tr>

            </tbody>
        </table>

        <!-- Signatures -->
        <table class="signature-table">
            <tr>
                <td style="width: 75%;">
                    <strong>Prepared and Paid by:</strong> ......................................................<br>
                    <span style="font-size: 7pt;">(Signature, Name, Date)</span>
                </td>
                <td style="width: 25%;">
                    <strong>Verified by:</strong> ......................................................<br>
                    <span style="font-size: 7pt; margin-right: 100px;">(Signature, Name, Date)</span>
                </td>
            </tr>
        </table>

        <!-- Footer Abbreviation Note -->
        <div class="footer-abbrev">
            <strong>Abbreviation of provinces and cities:</strong> Phnom Penh(PNP), Kandal (KL), Takeo (TK), Kompot
            (KT),
            Kompong Speu (KS), Kompong Som (KSM), Kompong Chhnang (KCHN), Pursat (PS), Kompong Cham (KCHM), Svay Rieng
            (SR),
            Kratie (KrT), Mondul Kiri(MDK), Ratanak Kiri (RK), Stoeng Treng (ST) Battamborng (BTB), Banteay Meanchey
            (BMC),
            Poipet (PP), Siem Reap (SRP), Kompong Thom (KTM).
        </div>

        {{-- Force page break between 5-participant chunks --}}
        @if (!$loop->last)
            <pagebreak />
        @endif
    @endforeach


    <script>
        window.onload = function() {
            window.print();
        };
    </script>

</body>

</html>
