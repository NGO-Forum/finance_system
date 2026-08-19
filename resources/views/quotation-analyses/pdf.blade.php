<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'sans-serif', 'khmer';
            font-size: 11px;
            color: #000;
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

        .dot-line {
            border-bottom: 1px dotted #000;
            display: inline-block;
            width: 100%;
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
            padding: 4px;
            vertical-align: middle;
        }

        .matrix-table tbody tr td {
            border-top: 1px dotted #999;
            border-bottom: 1px dotted #999;
        }

        .matrix-table tbody tr:last-child td {
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <table class="no-border">
        <tr class="no-border">
            <td class="no-border" style="width: 15%; vertical-align: top;">
                <img src="{{ public_path('images/logo.png') }}" style="width: 110px; height: auto;" />
            </td>
            <td class="no-border text-center" style="width: 40%;">
                <img src="{{ public_path('images/exp.jpg') }}" style="width: auto; height: 60px;" />
            </td>
            <td class="text-center no-border" style="width: 35%;">
                <!-- Nested Table forces mPDF to render strict borders correctly -->
                <table style="width: 100%;">
                    <!-- Top Section: Khmer Title -->
                    <tr>
                        <td class="text-center" style="border: none; padding: 4px;">
                            <div class="khmer-title"
                                style="font-size: 18px; font-weight: bold; color: #000000; line-height: 1.2;">
                                QUOTATION ANALYSIS SUMMARY
                            </div>
                        </td>
                    </tr>
                    <!-- Bottom Section: English Title -->
                    <tr>
                        <td class="text-center" style="border: none; padding: 4px;">
                            <div
                                style="font-size: 20px; font-weight: 800; color: #177200; text-transform: uppercase; letter-spacing: 0.5px;">
                                តារាងវិភាគសម្រង់តម្លៃ
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="no-border text-right" style="width: 10%; vertical-align: top;">
                <div
                    style="font-size: 10px; font-weight: 700; color: #4A5568; letter-spacing: 0.5px; margin-bottom: 2px;">
                    FM02-10
                </div>
            </td>
        </tr>
    </table>

    <!-- Title Bar -->
    <table>
        <tr class="bg-gray text-center">
            <th colspan="7" style="font-size: 14px; padding: 4px; font-weight: normal;">QUOTATION ANALYSIS SUMMARY
            </th>
        </tr>
        <tr>
            <td style="width: 5%;" class="text-bold">QA No:</td>
            <td style="width: 13%;"></td>
            <td style="width: 12%;" class="text-bold">Items being Quoted:</td>
            <td style="width: 58%;">{{ $quotationAnalysis->item_name }}</td>
            <td style="width: 7%;" class="text-bold">Quantity:</td>
            <td style="width: 5%;" colspan="2">{{ $quotationAnalysis->quantity }}</td>
        </tr>
    </table>

    <!-- Main Comparison Matrix -->
    <table class="matrix-table">
        <thead>
            {{-- Supplier Header --}}
            <tr class="">
                <th rowspan="2" style="width: 12%" class="text-bold bg-gray">
                    Selection Criteria
                </th>

                @foreach ($quotationAnalysis->suppliers as $index => $supplier)
                    <th style="width: 7%" class="text-bold">
                        Supplier {{ $index + 1 }}:
                    </th>

                    <th colspan="3" class="text-bold">
                        {{ $supplier->supplier_name ?? '' }}

                        @if (!empty($supplier->contact_person))
                            / {{ $supplier->contact_person }}
                        @endif

                        @if (!empty($supplier->phone))
                            - {{ $supplier->phone }}
                        @endif
                    </th>
                @endforeach
            </tr>

            {{-- Description / Score Header --}}
            <tr class="bg-gray">
                @foreach ($quotationAnalysis->suppliers as $supplier)
                    <th colspan="3">
                        Description
                    </th>

                    <th style="width: 5%">
                        Score
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody>

            {{-- Criteria Rows --}}
            @foreach ($criteria as $criterion)
                <tr>
                    <td style="font-weight: normal;">
                        {{ $criterion->name }}
                    </td>

                    @foreach ($quotationAnalysis->suppliers as $supplier)
                        @php
                            $scoreObj = $supplier->scores
                                ->where('quotation_analysis_criterion_id', $criterion->id)
                                ->first();
                        @endphp

                        {{-- Description --}}
                        <td colspan="3" class="align-middle px-4 py-3 whitespace-pre-line">
                            {{ $scoreObj->description ?? '' }}
                        </td>

                        {{-- Score --}}
                        <td class="text-center">
                            {{ $scoreObj->score ?? '' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach


            {{-- Total Row --}}
            <tr class="text-bold" style="border-top: 2px solid #000;">
                {{-- Criteria column --}}
                <td class="text-right text-bold">
                    TOTAL
                </td>

                {{-- Supplier totals --}}
                @foreach ($quotationAnalysis->suppliers as $supplier)
                    <td colspan="3"></td>

                    <td class="text-center">
                        {{ $supplier->total_score ?? '' }}
                    </td>
                @endforeach
            </tr>

        </tbody>
    </table>

    <!-- Score Instruction Note -->
    <table style="margin-top: -1px;">
        <tr class="bg-gray">
            <td style="font-size: 11px;">
                <strong>Note:</strong> The score ranges from 1 – 3, 1 being the lowest and 3 being the highest. The
                supplier with the highest total score should be recommended
            </td>
        </tr>
    </table>

    <!-- Decision Block -->
    <table style="margin-top: -1px;">
        <tr>
            <td style="width: 8%;" rowspan="2" class="text-center">Decision</td>
            <td style="width: 7%; top; line-height: 1.8;">Name of Supplier</td>
            <td style="width: 20%; top; line-height: 1.8;" class="text-center text-bold">
                {{ $quotationAnalysis->recommendedSupplier->supplier_name ?? '' }}
                @if (optional($quotationAnalysis->recommendedSupplier)->contact_person)
                    / {{ $quotationAnalysis->recommendedSupplier->contact_person }}
                @endif
                @if (!empty($quotationAnalysis->recommendedSupplier->phone))
                    - {{ $quotationAnalysis->recommendedSupplier->phone }}
                @endif
            </td>
            <td style="width: 65%;" rowspan="2" style="vertical-align: top; line-height: 1.5;">
                <span style="border-bottom: 1px solid #000;" class="text-bold">Explanation of Decision:</span>
                {{ $quotationAnalysis->decision_explanation }}
            </td>
        </tr>
        <tr>
            <td>Total Score</td>
            <td class="text-center text-bold">{{ $quotationAnalysis->recommendedSupplier->total_score ?? '' }}</td>
        </tr>
    </table>

    <!-- Signatures Matrix -->
    <table style="margin-top: -1px;">
        @for ($i = 0; $i < 6; $i++)
            @php $committee = $quotationAnalysis->committees->get($i); @endphp
            <tr class="">
                <td class="" style="width: 13%;">Member of Procurement:</td>
                <td class="" style="width: 25%;"></td>
                <td class=" text-left" style="width: 8%;">Name,Position:</td>
                <td class="" style="width: 40%;">

                    @if ($committee)
                        {{ optional($committee->user)->name }} @if ($committee->position)
                            ({{ $committee->position }})
                        @endif
                    @endif

                </td>
                <td class=" text-left" style="width: 4%;">Date:</td>
                <td class="" style="width: 10%;">

                </td>
            </tr>
        @endfor
    </table>

    <!-- Footer Note -->
    <table style="margin-top: -1px;">
        <tr class="">
            <td class="text-center" style="width: 75%; font-size: 11px;">
                This form is used to analyze quotations collected for the purchased request.
            </td>
            <td class=" text-center" style="width: 15%; font-size: 11px;">Appendix</td>
            <td class=" text-center" style="width: 10%; font-size: 11px;">FM02-10</td>
        </tr>
    </table>

</body>

</html>
