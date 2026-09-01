<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <style>
        @page {
            margin: 8mm 6mm 6mm 6mm;
        }

        body {
            font-family: 'sans-serif', 'khmer';
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #474545;
            padding: 4px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .no-border {
            border: none !important;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-bold {
            font-weight: bold;
        }

        .bg-gray {
            background-color: #f2f2f2;
        }

        .khmer-header {
            font-size: 16px;
            color: #1b5e20;
            font-weight: bold;
        }

        .khmer-title {
            font-size: 18px;
            font-weight: bold;
        }

        .blank-line {
            display: inline-block;
            border-bottom: 1px dotted #000;
            height: 15px;
        }

        .matrix-table {
            width: 100%;
            border-collapse: collapse;
            line-height: 1.4;
            border: 1px solid #000;
        }

        .matrix-table th,
        .matrix-table td {
            border: 1px solid #000;
            padding: 7px;
            vertical-align: middle;
        }

        .matrix-table tbody tr td {
            border-top: 1px solid #999;
            border-bottom: 1px solid #999;
        }

        .matrix-table tbody tr:last-child td {
            border-bottom: 1px solid #000;
        }

        .supplier-space {
            height: 32px;
        }

        .criterion-space {
            height: 35px;
        }

        .decision-space {
            height: 70px;
            vertical-align: top !important;
        }

        .committee-space {
            height: 28px;
        }
    </style>

</head>


<body>

    <table class="no-border">

        <tr class="no-border">

            {{-- Logo --}}

            <td class="no-border" style="width: 15%; vertical-align: top;">

                @if (file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" style="width: 110px; height: auto;">
                @endif

            </td>


            {{-- Header image --}}

            <td class="no-border text-center" style="width: 40%;">

                @if (file_exists(public_path('images/exp.jpg')))
                    <img src="{{ public_path('images/exp.jpg') }}" style="width: auto; height: 60px;">
                @endif

            </td>


            {{-- Title --}}

            <td class="text-center no-border" style="width: 35%;">

                <table style="width: 100%;">

                    <tr>

                        <td class="text-center" style="border: none; padding: 4px;">

                            <div
                                style="
                                font-size:18px;
                                font-weight:bold;
                                color:#000;
                                line-height:1.2;
                            ">
                                QUOTATION ANALYSIS SUMMARY
                            </div>

                        </td>

                    </tr>


                    <tr>

                        <td class="text-center" style="border: none; padding: 4px;">

                            <div
                                style="
                                font-size:20px;
                                font-weight:800;
                                color:#177200;
                                text-transform:uppercase;
                                letter-spacing:0.5px;
                            ">
                                តារាងវិភាគសម្រង់តម្លៃ
                            </div>

                        </td>

                    </tr>

                </table>

            </td>


            {{-- Form Code --}}

            <td class="no-border text-right" style="width: 10%; vertical-align: top;">

                <div
                    style="
                    font-size:10px;
                    font-weight:700;
                    color:#4A5568;
                    letter-spacing:0.5px;
                ">
                    FM02-10
                </div>

            </td>

        </tr>

    </table>


    <table>

        <tr class="bg-gray text-center">

            <th colspan="7"
                style="
                font-size:14px;
                padding:4px;
                font-weight:normal;
            ">
                QUOTATION ANALYSIS SUMMARY
            </th>

        </tr>


        <tr>

            <td style="width:5%;" class="text-bold">
                QA No:
            </td>

            <td style="width:13%;">

                &nbsp;

            </td>


            <td style="width:12%;" class="text-bold">
                Items being Quoted:
            </td>

            <td style="width:58%;">

                &nbsp;

            </td>


            <td style="width:6%;" class="text-bold">
                Quantity:
            </td>

            <td style="width:6%;" colspan="2">

                &nbsp;

            </td>

        </tr>

    </table>


    <table class="matrix-table">

        <thead>

            <tr>

                <th rowspan="2" style="width:12%;" class="text-bold bg-gray">
                    Selection Criteria
                </th>


                {{-- Supplier 1 --}}

                <th colspan="4" class="text-bold text-left">

                    Supplier 1:

                    <div class="supplier-space">
                        &nbsp;
                    </div>

                </th>


                {{-- Supplier 2 --}}

                <th colspan="4" class="text-bold text-left">

                    Supplier 2:

                    <div class="supplier-space">
                        &nbsp;
                    </div>

                </th>


                {{-- Supplier 3 --}}

                <th colspan="4" class="text-bold text-left">

                    Supplier 3:

                    <div class="supplier-space">
                        &nbsp;
                    </div>

                </th>

            </tr>


            <tr class="bg-gray">

                <th colspan="3">
                    Description
                </th>

                <th style="width:5%;">
                    Score
                </th>


                <th colspan="3">
                    Description
                </th>

                <th style="width:5%;">
                    Score
                </th>


                <th colspan="3">
                    Description
                </th>

                <th style="width:5%;">
                    Score
                </th>

            </tr>

        </thead>


        <tbody>

            @php
                $criteria = [
                    'Price',
                    'Quality',
                    'Reliability/ Reputation',
                    'After-sale Service',
                    'Validity Date',
                    'Payment Term',
                    'Legality (Patent,..etc)',
                    'Other factors',
                ];
            @endphp

            @foreach ($criteria as $criterion)
                <tr>

                    <td class="text-left">
                        {{ $criterion }}
                    </td>


                    {{-- Supplier 1 --}}

                    <td colspan="3">
                        &nbsp;
                    </td>

                    <td class="text-center">
                        &nbsp;
                    </td>


                    {{-- Supplier 2 --}}

                    <td colspan="3">
                        &nbsp;
                    </td>

                    <td class="text-center">
                        &nbsp;
                    </td>


                    {{-- Supplier 3 --}}

                    <td colspan="3">
                        &nbsp;
                    </td>

                    <td class="text-center">
                        &nbsp;
                    </td>

                </tr>
             @endforeach

            <tr class="text-bold">

                <td class="text-right" colspan="4">
                    TOTAL
                </td>

                <td class="text-center">
                    &nbsp;
                </td>


                <td colspan="3">
                    &nbsp;
                </td>

                <td class="text-center">
                    &nbsp;
                </td>


                <td colspan="3">
                    &nbsp;
                </td>

                <td class="text-center">
                    &nbsp;
                </td>

            </tr>

        </tbody>

    </table>


    <table style="margin-top:-1px;">

        <tr class="bg-gray">

            <td style="font-size:11px;">

                <strong>Note:</strong>

                The score ranges from 1 – 3,
                1 being the lowest and 3 being the highest.
                The supplier with the highest total score
                should be recommended.

            </td>

        </tr>

    </table>


    <table style="margin-top:-1px;">

        <tr>

            <td style="width:8.4%;" rowspan="3" class="text-center">
                Decision
            </td>


            <td style="width:8%; line-height: 1.5;">
                Name of Supplier
            </td>


            <td style="width:21%;" class="text-center text-bold">

                &nbsp;

            </td>


            <td style="width:61.6%;" rowspan="3" class="decision-space">

                <span class="text-bold">
                    Explanation of Decision:
                </span>

                <br><br>

                &nbsp;

            </td>

        </tr>


        <tr>

            <td>
                Total Score
            </td>

            <td class="text-center text-bold">

                &nbsp;

            </td>

        </tr>

    </table>


    <table style="margin-top:-1px;">

        @for ($i = 1; $i <= 6; $i++)
            <tr>

                <td style="width:13%;">

                    Member of Procurement:

                </td>


                <td style="width:25%;">

                    &nbsp;

                </td>


                <td style="width:8%;" class="text-left ">

                    Name,Position:

                </td>


                <td style="width:40%;" class="committee-space">

                    &nbsp;

                </td>


                <td style="width:4%;" class="text-left">

                    Date:

                </td>


                <td style="width:10%;">

                    &nbsp;

                </td>

            </tr>
        @endfor

    </table>


    <table style="margin-top:-1px;">

        <tr>

            <td class="text-center" style="width:75%; font-size:11px;">

                This form is used to analyze quotations
                collected for the purchased request.

            </td>


            <td class="text-center" style="width:15%; font-size:11px;">

                Appendix

            </td>


            <td class="text-center" style="width:10%; font-size:11px;">

                FM02-10

            </td>

        </tr>

    </table>


</body>

</html>
