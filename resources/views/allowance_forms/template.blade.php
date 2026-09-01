<!DOCTYPE html>
<html lang="km">

<head>

    <meta charset="UTF-8">

    <style>
        @page {
            margin: 2mm 6mm 4mm 6mm;
        }

        body {
            font-family: 'battambang', sans-serif !important;
            font-size: 10px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* =====================================================
           HEADER
           ===================================================== */

        .header-table {
            width: 100%;
            height: 35px;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            vertical-align: middle;
        }

        .title-text {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            margin-right: 40px;
        }

        /* =====================================================
           META
           ===================================================== */

        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
            font-size: 14px;
        }

        .meta-table td {
            padding: 1px 0;
            vertical-align: bottom;
        }

        .blank-line {
            display: inline-block;
            border-bottom: 1px dotted #000;
            min-width: 180px;
            height: 16px;
        }

        .blank-line-small {
            display: inline-block;
            border-bottom: 1px dotted #000;
            min-width: 90px;
            height: 16px;
        }

        /* =====================================================
           MAIN TABLE
           ===================================================== */

        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 10px;
            border: 1px solid #000;
            page-break-inside: auto;
        }

        .data-table tr {
            page-break-inside: avoid;
        }

        .data-table th {
            border: 1px solid #000;
            background: #048f1b;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            padding: 2px 1px;
            font-weight: bold;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 0 4px;
            vertical-align: middle;
            line-height: 1.8;
            word-wrap: break-word;
            height: 8px;
        }

        .solid-border {
            border: 0.5pt solid #000 !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .bold {
            font-weight: bold !important;
        }

        /* =====================================================
           TOTAL
           ===================================================== */

        .gray-bar {
            background-color: #d9d9d9 !important;
        }

        .grand-total-box {
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            border: 0.5pt solid #000 !important;
        }

        /* =====================================================
           SIGNATURE
           ===================================================== */

        .signature-table {
            width: 100%;
            margin-top: 12px;
            font-size: 11px;
            line-height: 1.5;
            margin-bottom: 3px;
        }

        .signature-space {
            height: 35px;
        }

        /* =====================================================
           FOOTER
           ===================================================== */

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


    <table class="header-table">

        <tr>

            {{-- NGO Forum Logo --}}

            <td style="width: 20%; text-align: left;">

                @if (file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" style="height: 50px;">
                @endif

            </td>


            {{-- Header Image --}}

            <td style="width: 55%; text-align: center;">

                @if (file_exists(public_path('images/exp.jpg')))
                    <img src="{{ public_path('images/exp.jpg') }}" style="height: 40px;">
                @endif

            </td>


            {{-- Empty donor-logo area --}}

            <td style="width: 25%; text-align: right;">

                &nbsp;

            </td>

        </tr>

    </table>


    <div class="title-text" style="color: #006600; margin-bottom: 1px;">

        ប្រាក់ឧបត្ថម្ភសម្រាប់អ្នកចូលរួម /
        <span style="color: #000;">
            ALLOWANCE FOR PARTICIPANT
        </span>

    </div>


    <table class="meta-table">

        {{-- Activity / Start Date --}}

        <tr>

            <td width="75%">

                For activity:

                <span class="blank-line">
                    &nbsp;
                </span>

            </td>


            <td width="25%">

                Starting date:

                <span class="blank-line-small">

                </span>

            </td>

        </tr>


        {{-- Venue / End Date --}}

        <tr>

            <td>

                Place of conduct activity:

                <span class="blank-line">

                </span>

            </td>


            <td>

                Ending date:

                <span class="blank-line-small">

                </span>

            </td>

        </tr>


        {{-- Budget / Program / Donor --}}

        <tr>

            <td>

                Budget line/code:

                <span class="blank-line-small">
                    &nbsp;
                </span>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                Program:

                <span class="blank-line-small">
                    &nbsp;
                </span>

            </td>


            <td>

                Donor:

                <span class="blank-line-small">
                    &nbsp;
                </span>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                Donor's Code:

                <span class="blank-line-small">
                    &nbsp;
                </span>

            </td>

        </tr>

    </table>

    <table class="data-table">

        <thead>

            <tr>

                <th rowspan="2" width="3%" class="solid-border">
                    No
                </th>


                <th rowspan="2" width="15%" class="solid-border">
                    Name<br>
                    (Position &amp; organization)
                </th>


                <th rowspan="2" width="3%" class="solid-border">
                    Sex
                </th>


                <th rowspan="2" width="17%" class="solid-border">
                    Village, Commune, District,<br>
                    Province (be specific)
                </th>


                <th rowspan="2" width="10%" class="solid-border">
                    Allowance Type
                </th>


                {{-- 5 blank date columns --}}

                <th colspan="5" class="solid-border">
                    Date
                </th>


                <th rowspan="2" width="8%" class="solid-border">
                    Total
                </th>


                <th rowspan="2" width="13%" class="solid-border">
                    Total and Signature
                </th>

            </tr>


            <tr>

                <th class="solid-border">
                    &nbsp;
                </th>

                <th class="solid-border">
                    &nbsp;
                </th>

                <th class="solid-border">
                    &nbsp;
                </th>

                <th class="solid-border">
                    &nbsp;
                </th>

                <th class="solid-border">
                    &nbsp;
                </th>

            </tr>

        </thead>


        <tbody>

            @for ($participant = 1; $participant <= 4; $participant++)

                @php
                    $allowanceTypes = ['Breakfast', 'Lunch', 'Dinner', 'Acc', 'Taxi/Bus', 'L. Tran/Inc'];
                @endphp


                @foreach ($allowanceTypes as $typeIndex => $type)
                    <tr>


                        {{-- Participant No --}}

                        @if ($typeIndex === 0)
                            <td rowspan="6" class="text-center bold solid-border">
                                {{ $participant }}
                            </td>


                            {{-- Name --}}

                            <td rowspan="6" class="solid-border">
                                &nbsp;
                            </td>


                            {{-- Sex --}}

                            <td rowspan="6" class="text-center solid-border">
                                &nbsp;
                            </td>


                            {{-- Address --}}

                            <td rowspan="6" class="solid-border">
                                &nbsp;
                            </td>
                        @endif


                        {{-- Allowance Type --}}

                        <td class="bold">
                            {{ $type }}
                        </td>


                        {{-- Date columns --}}

                        <td class="text-right" style="width: 6%;">

                        </td>

                        <td class="text-right" style="width: 6%;">

                        </td>

                        <td class="text-right" style="width: 6%;">

                        </td>

                        <td class="text-right" style="width: 6%;">

                        </td>

                        <td class="text-right" style="width: 6%;">

                        </td>


                        {{-- Total --}}

                        <td class="text-left">
                            $
                        </td>


                        {{-- Total / Signature --}}

                        @if ($typeIndex === 0)
                            <td class="text-center bold solid-border" style="border-bottom:none;">
                                TOTAL
                            </td>
                        @elseif ($typeIndex === 1)
                            <td class="text-center bold gray-bar solid-border"
                                style="border-top:none;border-bottom:none;">

                            </td>
                        @elseif ($typeIndex === 2)
                            <td class="text-center bold solid-border" style="border-top:none;border-bottom:none;">
                                SIGNATURE
                            </td>
                        @elseif ($typeIndex === 3)
                            <td rowspan="3" class="solid-border" style="border-top:none;">
                                &nbsp;
                            </td>
                        @endif

                    </tr>
                @endforeach

            @endfor


            <tr>
                <td colspan="8" rowspan="3" class="text-center bold">
                    TOTAL PAGE  OF 
                </td>
                <td colspan="2" class="text-left bold solid-border">Food</td>
                <td class="text-right bold solid-border">$</td>
                <td class="grand-total-box bold">GRAND TOTAL</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left bold solid-border">Acc</td>
                <td class="text-right bold solid-border">$</td>
                <td class="grand-total-box bold text-right" rowspan="2" style="font-size: 8.5pt; vertical-align: middle;">
                    
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-left bold solid-border">Taxi/Bus &amp; L.Tran</td>
                <td class="text-right bold solid-border">$</td>
            </tr>


        </tbody>

    </table>


    {{-- =========================================================
     SIGNATURES
     ========================================================= --}}

    <table class="signature-table">

        <tr>

            <td style="width: 75%;">

                <strong>
                    Prepared and Paid by:
                </strong>

                ......................................................

                <br>

                <span style="font-size: 7pt; margin-left: 100px;">
                    (Signature, Name, Date)
                </span>

            </td>


            <td style="width: 25%;">

                <strong>
                    Verified by:
                </strong>

                ......................................................

                <br>

                <span style="font-size: 7pt;">
                    (Signature, Name, Date)
                </span>

            </td>

        </tr>

    </table>


    {{-- =========================================================
     FOOTER
     ========================================================= --}}

    <div class="footer-abbrev">

        <strong>
            Abbreviation of provinces and cities:
        </strong>

        Phnom Penh(PNP), Kandal (KL), Takeo (TK), Kompot (KT),
        Kompong Speu (KS), Kompong Som (KSM),
        Kompong Chhnang (KCHN), Pursat (PS),
        Kompong Cham (KCHM), Svay Rieng (SR),
        Kratie (KrT), Mondul Kiri(MDK),
        Ratanak Kiri (RK), Stoeng Treng (ST),
        Battamborng (BTB), Banteay Meanchey (BMC),
        Poipet (PP), Siem Reap (SRP), Kompong Thom (KTM).

    </div>


</body>

</html>
