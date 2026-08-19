<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PURCHASE REQUEST - FM02-04</title>

    <style>
        body {
            font-family: dejavusans, Arial, sans-serif;
            color: #000;
            line-height: 1.8;
            margin: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Border Utility Classes */
        .border-none {
            border: none !important;
        }

        .border-outer {
            border: 1px solid #000;
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

        .fw-bold {
            font-weight: bold;
        }

        .italic {
            font-style: italic;
        }

        /* Header Styling */
        .logo {
            height: 55px;
            margin-bottom: 6px;
        }

        .header-address {
            font-size: 11px;
            color: #000;
            margin-top: 10px;
        }

        .doc-code {
            font-size: 10px;
            font-weight: bold;
            color: #555;
            text-align: right;
            vertical-align: top;
        }

        .doc-title {
            font-size: 16px;
            font-weight: bold;
            color: #1e3a8a;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .doc-title-khmer {
            font-size: 20px;
            margin-top: 15px;
            color: #0a8f3d;
            font-weight: bold;
            text-align: center;
        }

        /* Meta Information Table */
        .meta-table td {
            padding: 5px 5px;
            vertical-align: top;
            border: none;
        }

        .meta-label-khmer {
            font-size: 14px;
            font-weight: bold;
            display: block;
        }

        .meta-label-en {
            font-size: 14px;
        }

        /* Items Table Styling */
        .items-table {
            border: 1px solid #000;
            margin-top: 10px;
        }

        .items-table th {
            border: 1px solid #000;
            padding: 5px;
            font-weight: bold;
            color: #1e3a8a;
            font-size: 13px;
            vertical-align: middle;
            background-color: #ffffff;
        }

        .items-table td {
            border-right: 1px dotted #888;
            border-left: 1px dotted #888;
            border-bottom: 1px dotted #ccc;
            padding: 10px;
            font-size: 12px;
            vertical-align: middle;
        }

        .total-row td {
            border-top: 1px solid #000 !important;
            border-bottom: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
            border-left: 1px solid #000 !important;
            font-weight: bold;
            padding: 10px;
        }

        /* Signatures Layout */
        .signature-table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
            border: none;
            line-height: 2;
        }

        .signature-table td {
            border: none;
            vertical-align: top;
        }

        .signature-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .signature-subtitle {
            font-style: italic;
            font-size: 12px;
            margin-top: 2px;
        }


        .signature-note {
            font-size: 12px;
            color: #999;
            font-style: italic;
        }

        .signature-footer {
            margin-top: 6px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <!-- ================= HEADER ================= -->
    <table class="border-none">
        <tr>
            <td class="border-none" style="width: 25%; vertical-align: top;">
                @if (file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" class="logo" style="width: 20%;">
                @endif
            </td>
            <td class="border-none text-center" style="vertical-align: top;">
                @if (file_exists(public_path('images/exp.jpg')))
                    <img src="{{ public_path('images/exp.jpg') }}" class="logo">
                @endif
            </td>
            <td class="border-none doc-code" style="width: 15%;">
                FM02-04
            </td>
        </tr>
    </table>

    <div class="header-address">
        <span>
            #9-11, St. 476, Sangkat Toul Tompoung I, Khan Chamkarmon, Phnom Penh. Tel: (+855) 78 550 449
        </span>
    </div>

    <!-- ================= TITLE ================= -->
    <div>
        <div class="doc-title-khmer">ប័ណ្ណស្នើសុំទិញ</div>
        <div class="doc-title">PURCHASE REQUEST</div>
    </div>

    <!-- ================= purchaseRequest INFORMATION ================= -->
    <table class="meta-table">
        <tr>
            <td style="width: 60%;">
                <span class="meta-label-khmer">កាលបរិច្ឆេទ / </span>
                <span class="meta-label-en">Date:
                    {{ \Carbon\Carbon::parse($purchaseRequest->request_date)->format('d M Y') }}</span>
            </td>
            <td style="width: 40%;">
                <span class="meta-label-khmer">សំរាប់កម្មវិធី / </span>
                <span class="meta-label-en">Program: {{ $purchaseRequest->preparer?->department?->name ?? '-' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="meta-label-khmer">ម្ចាស់ជំនួយ / </span>
                <span class="meta-label-en">Donor: {{ $purchaseRequest->donor }} / Donor Code
                    {{ $purchaseRequest->donor_code }}</span>
            </td>
            <td>
                <span class="meta-label-khmer">កូដចំណាយ / </span>
                <span class="meta-label-en">Budget Line: {{ $purchaseRequest->budget_line }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 6px;">
                <span class="meta-label-khmer">គោលបំណង / </span>
                <span class="meta-label-en">Purpose: {{ $purchaseRequest->purpose }}</span>
            </td>
        </tr>
    </table>

    <!-- ================= PURCHASE ITEMS ================= -->
    <table class="items-table">
        <thead>
            <tr>
                <th width="5%">
                    <span class="khmer-head">ល.រ</span>
                    <hr>
                    <span class="en-head">No</span>
                </th>
                <th width="54%">
                    <span class="khmer-head">មុខទំនិញ (ពត៌មានលម្អិត)</span>
                    <hr>
                    <span class="en-head">Items with specification</span>
                </th>
                <th width="8%">
                    <span class="khmer-head">ឯកតា</span>
                    <hr>
                    <span class="en-head">Unit</span>
                </th>
                <th width="11%">
                    <span class="khmer-head">តម្លៃ</span>
                    <hr>
                    <span class="en-head">Unit cost</span>
                </th>
                <th width="10%">
                    <span class="khmer-head">បរិមាណ</span>
                    <hr>
                    <span class="en-head">Qty</span>
                </th>
                <th width="12%">
                    <span class="khmer-head">សរុប</span>
                    <hr>
                    <span class="en-head">Total</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @php $rowCount = 0; @endphp
            @forelse($purchaseRequest->items as $item)
                @php $rowCount++; @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        {{ $item->item_name }}
                        @if (!empty($item->specification))
                            ({{ $item->specification }})
                        @endif
                    </td>
                    <td class="text-center">{{ $item->unit }}</td>
                    <td class="text-right">${{ number_format($item->unit_cost, 2) }}</td>
                    <td class="text-center">
                        {{ (int) $item->quantity == $item->quantity ? (int) $item->quantity : number_format($item->quantity, 2) }}
                    </td>
                    <td class="text-right">${{ number_format($item->total, 2) }}</td>
                </tr>
            @empty
            @endforelse

            {{-- Fill empty rows to keep uniform height (minimum 9 rows total) --}}
            @for ($i = $rowCount + 1; $i <= 10; $i++)
                <tr>
                    <td class="text-center" style="color: #444;">{{ $i }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right">
                    <div style="font-size: 16px;">សរុប</div>
                    <div style="margin-top: 4px;">TOTAL</div>
                </td>
                <td class="text-right">
                    ${{ number_format($purchaseRequest->grand_total, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- ================= APPROVAL & SIGNATURES ================= -->
    <table class="signature-table">
        <tr>

            <!-- Prepared By -->
            <td width="75%">

                <div class="signature-title">រៀបចំដោយ</div>
                <div class="signature-subtitle">Prepared by</div>

                <br> <br> <br> <br>

                <div class="signature-note">(Signature &amp; name)</div>

                <div class="signature-footer">
                    <strong>Date:</strong>

                </div>

            </td>

            <!-- Reviewed By -->
            <td width="25%">

                <div class="signature-title">ពិនិត្យដោយ</div>
                <div class="signature-subtitle">Reviewed by</div>

                <br> <br> <br> <br>

                <div class="signature-note">(Signature &amp; name)</div>

                <div class="signature-footer">
                    <strong>Date:</strong>

                </div>

            </td>

        </tr>
    </table>

</body>

</html>
