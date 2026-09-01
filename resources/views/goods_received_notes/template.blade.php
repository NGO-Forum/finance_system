<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        Goods / Service Received Note
    </title>


    <style>
        @page {
            margin: 5mm 5mm;
        }

        body {
            margin: 0;
            padding: 0;

            font-family:
                dejavusans,
                sans-serif;

            font-size: 9px;

            color: #1f2937;

            line-height: 1.35;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }


        /*
        |--------------------------------------------------------------------------
        | COLORS
        |--------------------------------------------------------------------------
        */

        .green {
            color: #166534;
        }

        .green-dark {
            color: #14532d;
        }

        .green-bg {
            background-color: #dcfce7;
        }

        .green-dark-bg {
            background-color: #166534;
            color: #ffffff;
        }

        .green-light-bg {
            background-color: #f0fdf4;
        }

        .gray-bg {
            background-color: #f3f4f6;
        }

        .gray-light-bg {
            background-color: #f9fafb;
        }

        .white {
            color: #ffffff;
        }


        /*
        |--------------------------------------------------------------------------
        | TEXT
        |--------------------------------------------------------------------------
        */

        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .uppercase {
            text-transform: uppercase;
        }


        /*
        |--------------------------------------------------------------------------
        | BORDERS
        |--------------------------------------------------------------------------
        */

        .border {
            border: 1px solid #9ca3af;
        }

        .border-dark {
            border: 1px solid #4b5563;
        }

        .border-green {
            border: 1px solid #166534;
        }


        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        .organization-address {
            font-size: 10px;
            color: #4b5563;
        }


        .document-title {
            font-size: 16px;
            font-weight: bold;
            color: #009f3d;
            text-align: center;
            vertical-align: center;
            letter-spacing: 0.4px;
        }

        .document-subtitle {
            margin-top: 4px;
            font-size: 7px;
            color: #6b7280;
            text-align: center;
            letter-spacing: 0.7px;
        }


        .form-code {
            display: inline-block;

            background-color: #166534;

            color: #ffffff;

            font-size: 10px;

            font-weight: bold;

            padding: 7px 8px;
        }


        /*
        |--------------------------------------------------------------------------
        | SECTION
        |--------------------------------------------------------------------------
        */

        .section-title {
            padding: 5px 7px;

            background-color: #dcfce7;

            border: 1px solid #9ca3af;

            color: #00963a;

            font-size: 8px;

            font-weight: bold;

            text-transform: uppercase;

            letter-spacing: 0.4px;
        }


        /*
        |--------------------------------------------------------------------------
        | GENERAL CELLS
        |--------------------------------------------------------------------------
        */

        .cell {
            border: 1px solid #9ca3af;
            padding: 5px;
            vertical-align: top;
        }

        .label-cell {
            border: 1px solid #9ca3af;

            background-color: #f3f4f6;

            padding: 5px;

            font-weight: bold;

            color: #4b5563;
        }


        /*
        |--------------------------------------------------------------------------
        | SUPPLIER
        |--------------------------------------------------------------------------
        */

        .supplier-name {
            margin-top: 3px;

            font-size: 10px;

            font-weight: bold;

            color: #111827;
        }

        .supplier-detail {
            margin-top: 6px;

            font-size: 8px;

            color: #374151;

            line-height: 13px;
        }


        /*
        |--------------------------------------------------------------------------
        | ITEMS TABLE
        |--------------------------------------------------------------------------
        */

        .items-table {
            margin-top: 0px;
        }


        .items-table th {
            border: 1px solid #d1d5db;

            background-color: #007a2f;

            color: #ffffff;

            padding: 5px;

            font-size: 10px;

            font-weight: bold;

            text-align: center;

            vertical-align: middle;
        }


        .items-table td {
            border: 1px solid #9ca3af;

            height: 40px;

            font-size: 11px;

            vertical-align: middle;
        }


        .description {
            text-align: left;

            line-height: 1.5;
        }


        .criteria {
            text-align: left;

            line-height: 1.5;

            color: #4b5563;
        }


        .quantity {
            text-align: center;

            font-weight: bold;
        }


        /*
        |--------------------------------------------------------------------------
        | RESULT
        |--------------------------------------------------------------------------
        */

        .check {
            font-size: 10px;

            font-weight: bold;

            color: #15803d;
        }


        .dash {
            font-size: 10px;

            color: #545555;
        }


        .accepted {

            color: #15803d;

            font-weight: bold;

            text-align: center;
        }


        .rejected {

            color: #dc2626;

            font-weight: bold;

            text-align: center;
        }


        /*
        |--------------------------------------------------------------------------
        | NOTICE
        |--------------------------------------------------------------------------
        */

        .notice {
            padding: 6px 8px;

            background-color: #166534;

            border: 1px solid #14532d;

            color: #ffffff;

            text-align: center;

            font-size: 9px;

            font-weight: bold;

            line-height: 11px;
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSIBILITY TABLE
        |--------------------------------------------------------------------------
        */

        .responsibility-table {
            margin-top: 10px;
        }


        .responsibility-table td {
            border: none;

            padding: 10px 0px;

            font-size: 11px;

            vertical-align: middle;
        }


        .responsibility-label {
            font-weight: bold;
        }


        /*
        |--------------------------------------------------------------------------
        | COMMENTS
        |--------------------------------------------------------------------------
        */

        .comments-title {
            margin-top: 10px;

            margin-bottom: 3px;

            font-size: 11px;

            font-weight: bold;

            color: #374151;
        }


        .comments-box {
            border: 1px solid #9ca3af;

            padding: 6px;

            font-size: 10px;

            line-height: 13px;

            vertical-align: top;
        }


        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .document-footer {
            margin-top: 7px;

            border-top: 1px solid #d1d5db;

            padding-top: 4px;

            font-size: 10px;

            color: #9ca3af;
        }

    </style>

</head>


<body>


    {{-- TOP HEADER & LOGOS --}}
    <table>
        <tr>
            <td style="width: 20%;" class="text-center">
                <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 65px; width: auto;">
            </td>
            <td style="width: 70%;" class="text-center">
                <img src="{{ public_path('images/exp.jpg') }}" alt="NGO Forum" style="height: 65px; width: auto;">
            </td>
            <td style="width: 10%; vertical-align: top;" class="text-right">
                <span style="font-weight: 500; color: #4b5563; vertical-align: top;">FM02-12</span>
            </td>
        </tr>
    </table>

    <table style="margin-top: 5px;">

        <tr>

            <td class="cell" style="width:40%; line-height: 1.8;">

                <div class="organization-address">

                    #9-11, St. 476, Sangkat Toul Tompoung I,
                    Khan Chamkarmon, Phnom Penh.<br>

                    <strong>Tel:</strong>
                    (+855) 78 550 449

                    &nbsp;&nbsp;&nbsp;

                    <strong>Fax:</strong>
                    (+855) 78 550 449

                </div>

            </td>

            <td class="center" style="width:60%; border: 1px solid #9ca3af;">

                <div>

                    <div class="document-title">

                        GOODS / SERVICE RECEIVED NOTE

                    </div>

                </div>

            </td>

        </tr>

    </table>

    <table style="width:100%; border-collapse:collapse;">

        <tr>

            <td rowspan="5"
                style="width:55%; border:1px solid #d1d5db; padding:0; vertical-align:top; background:#ffffff;">
                <table style="width:100%; border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        <td
                            style="padding:5px; border-bottom:1px solid #d1d5db; font-size:12px; font-weight:bold;">
                            NAME: 
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:4px 6px; font-size:12px; font-weight:bold; line-height:1.5;">
                            ADDRESS: <br><br>
                            Tel: 
                           
                        </td>
                    </tr>
                </table>
            </td>



            <td
                style="
                width:15%;
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
                font-weight:bold;
            ">

                GRN #

            </td>


            <td
                style="
                width:25%;
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
            ">

               

            </td>

        </tr>

        <tr>

            <td
                style="
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
                font-weight:bold;
            ">

                GRN DATE #

            </td>


            <td
                style="
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
            ">

             

            </td>

        </tr>

        <tr>

            <td
                style="
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
                font-weight:bold;
            ">

                PO / CONTRACT #

            </td>


            <td
                style="
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
            ">

          

            </td>

        </tr>


        <tr>

            <td
                style="
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
                font-weight:bold;
            ">

                VENDOR INVOICE #

            </td>


            <td
                style="
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
            ">

            

            </td>

        </tr>

        <tr>

            <td
                style="
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
                font-weight:bold;
            ">

                DELIVERY NOTE #

            </td>


            <td
                style="
                border:1px solid #d1d5db;
                padding:5px 7px;
                font-size:12px;
            ">

              

            </td>

        </tr>

    </table>


    <div class="avoid-break">

        <table class="items-table">

            <thead>

                <tr>

                    <th rowspan="2" style="width:27%;">
                        DESCRIPTION
                    </th>


                    <th rowspan="2" style="width:22%;">
                        INSPECTION CRITERIA
                    </th>


                    <th colspan="5">
                        QUANTITY
                    </th>

                </tr>


                <tr>

                    <th style="width:9%;">

                        ORDERED

                    </th>


                    <th style="width:9%;">

                        RECEIVED

                    </th>


                    <th style="width:9%;">

                        INSPECTED

                    </th>


                    <th style="width:9%;">

                        ACCEPTED

                    </th>


                    <th style="width:9%;">

                        REJECTED

                    </th>

                </tr>

            </thead>


            <tbody>

                @for ($i = 0; $i < 12; $i++)
                    <tr>

                        <td class="item-cell" style="height:30px;"></td>

                        <td class="item-cell"></td>

                        <td class="item-cell"></td>

                        <td class="item-cell"></td>

                        <td class="item-cell"></td>

                        <td class="item-cell"></td>

                        <td class="item-cell"></td>

                    </tr>
                @endfor

            </tbody>

        </table>

    </div>


    <div class="notice">

        Goods / Materials received are delivered correctly
        in terms of quantity, quality and other specifications
        according to the specified PO.

    </div>


    <table class="responsibility-table">


        <tr>

            <td class="responsibility-label" style="width:15%;">

                Delivered By:

            </td>


            <td style="width:45%;">

                

            </td>


            <td class="responsibility-label" style="width:15%;">

                Date / Time:

            </td>


            <td style="width:25%;">

               
            </td>

        </tr>


        {{-- ======================================================== --}}
        {{-- RECEIVED --}}
        {{-- ======================================================== --}}

        <tr>

            <td class="responsibility-label">

                Received By:

            </td>


            <td>

               

            </td>


            <td class="responsibility-label">

                Date / Time:

            </td>


            <td>

                

            </td>

        </tr>


        {{-- ======================================================== --}}
        {{-- INSPECTED --}}
        {{-- ======================================================== --}}

        <tr>

            <td class="responsibility-label">

                Inspected By:

            </td>


            <td>

                

            </td>


            <td class="responsibility-label">

                Date / Time:

            </td>


            <td>

                

            </td>

        </tr>

    </table>


    <div class="comments-title">

        Further comments may be noted here if necessary:

    </div>


    <table>

        <tr>

            <td class="comments-box" style="height: 140px;">

                

            </td>

        </tr>

    </table>


</body>

</html>
