<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>
        Purchase Request Notification
    </title>

</head>


<body
    style="
        font-family:Arial,Helvetica,sans-serif;
        background:#f4f6f9;
        padding:30px;
        margin:0;
    ">


    @php

        $purchaseRequestUrl = route('purchase-requests.show', $purchaseRequest->id);

        if ($type === 'reviewer') {
            $headerColor = '#198754';
            $buttonColor = '#198754';
        } elseif ($type === 'approver') {
            $headerColor = '#0d6efd';
            $buttonColor = '#0d6efd';
        } elseif ($type === 'finance') {
            $headerColor = '#6f42c1';
            $buttonColor = '#6f42c1';
        } elseif ($type === 'rejected') {
            $headerColor = '#dc3545';
            $buttonColor = '#198754';
        } else {
            $headerColor = '#198754';
            $buttonColor = '#198754';
        }

    @endphp


    <table width="650" align="center" cellpadding="0" cellspacing="0"
        style="
        background:#ffffff;
        border-radius:8px;
        overflow:hidden;
        border:1px solid #dddddd;
        max-width:650px;
        width:100%;
    ">


        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <tr>

            <td
                style="
                background:{{ $headerColor }};
                color:#ffffff;
                padding:20px;
                text-align:center;
            ">

                <h2 style="margin:0;font-size:22px;">

                    @if ($type === 'reviewer')
                        Purchase Request Requires Review
                    @elseif ($type === 'approver')
                        Purchase Request Requires Approval
                    @elseif ($type === 'finance')
                        Purchase Request Requires Finance Review
                    @elseif ($type === 'approved')
                        Purchase Request Approved
                    @elseif ($type === 'rejected')
                        Purchase Request Rejected
                    @else
                        Purchase Request Notification
                    @endif

                </h2>

            </td>

        </tr>


        {{-- ========================================================= --}}
        {{-- MAIN CONTENT --}}
        {{-- ========================================================= --}}

        <tr>

            <td
                style="
                padding:30px;
                color:#333333;
                font-size:14px;
                line-height:1.6;
            ">


                {{-- ================================================= --}}
                {{-- GREETING --}}
                {{-- ================================================= --}}

                <p style="margin-top:0;">

                    Dear

                    <strong>
                        {{ $user->name }}
                    </strong>,

                </p>



                {{-- ================================================= --}}
                {{-- REVIEWER MESSAGE --}}
                {{-- ================================================= --}}

                @if ($type === 'reviewer')
                    <p>

                        A Purchase Request has been submitted
                        and requires your review.

                    </p>


                    {{-- ================================================= --}}
                    {{-- APPROVER MESSAGE --}}
                    {{-- ================================================= --}}
                @elseif ($type === 'approver')
                    <p>

                        A Purchase Request has been reviewed
                        and now requires your final approval.

                    </p>


                    {{-- ================================================= --}}
                    {{-- FINANCE MESSAGE --}}
                    {{-- ================================================= --}}
                @elseif ($type === 'finance')
                    <p>

                        A Purchase Request has completed
                        the required approval process and
                        is now ready for Finance review.

                    </p>


                    {{-- ================================================= --}}
                    {{-- APPROVED MESSAGE --}}
                    {{-- ================================================= --}}
                @elseif ($type === 'approved')
                    <p>

                        Your Purchase Request has been

                        <strong style="color:#198754;">
                            approved
                        </strong>.

                    </p>


                    {{-- ================================================= --}}
                    {{-- REJECTED MESSAGE --}}
                    {{-- ================================================= --}}
                @elseif ($type === 'rejected')
                    <p>

                        Your Purchase Request has been

                        <strong style="color:#dc3545;">
                            rejected
                        </strong>.

                    </p>
                @endif


                <table width="100%" cellpadding="8" cellspacing="0"
                    style="
                    border-collapse:collapse;
                    margin:25px 0;
                    border:1px solid #dddddd;
                ">


                    {{-- Purchase No --}}
                    <tr style="background:#f8f9fa;">

                        <td width="180"
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Purchase No.
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            {{ $purchaseRequest->purchase_no }}

                        </td>

                    </tr>


                    {{-- Request Date --}}
                    <tr>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Request Date
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            {{ \Carbon\Carbon::parse($purchaseRequest->request_date)->format('d/m/Y') }}

                        </td>

                    </tr>


                    {{-- Purpose --}}
                    <tr style="background:#f8f9fa;">

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Purpose
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            {{ $purchaseRequest->purpose }}

                        </td>

                    </tr>


                    {{-- Donor --}}
                    <tr>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Donor
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            {{ $purchaseRequest->donor ?? '-' }}

                        </td>

                    </tr>


                    {{-- Donor Code --}}
                    <tr style="background:#f8f9fa;">

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Donor Code
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            {{ $purchaseRequest->donor_code ?? '-' }}

                        </td>

                    </tr>


                    {{-- Reviewed By --}}
                    <tr>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Reviewed By
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            {{ $purchaseRequest->reviewer?->name ?? '-' }}

                        </td>

                    </tr>


                    {{-- Approved By --}}
                    <tr style="background:#f8f9fa;">

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Approved By
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            {{ $purchaseRequest->approver?->name ?? '-' }}

                        </td>

                    </tr>


                    {{-- Grand Total --}}
                    <tr>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Grand Total
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>

                                ${{ number_format($purchaseRequest->grand_total, 2) }}

                            </strong>

                        </td>

                    </tr>


                    {{-- Status --}}
                    <tr style="background:#f8f9fa;">

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            <strong>
                                Status
                            </strong>

                        </td>

                        <td
                            style="
                            border:1px solid #dddddd;
                            padding:10px;
                        ">

                            @if ($type === 'reviewer')
                                <span
                                    style="
                                    color:#198754;
                                    font-weight:bold;
                                ">
                                    Pending Manager Review
                                </span>
                            @elseif ($type === 'approver')
                                <span
                                    style="
                                    color:#0d6efd;
                                    font-weight:bold;
                                ">
                                    Pending Final Approval
                                </span>
                            @elseif ($type === 'finance')
                                <span
                                    style="
                                    color:#6f42c1;
                                    font-weight:bold;
                                ">
                                    Pending Finance Review
                                </span>
                            @elseif ($type === 'approved')
                                <span
                                    style="
                                    color:#198754;
                                    font-weight:bold;
                                ">
                                    Approved
                                </span>
                            @elseif ($type === 'rejected')
                                <span
                                    style="
                                    color:#dc3545;
                                    font-weight:bold;
                                ">
                                    Rejected
                                </span>
                            @else
                                {{ $purchaseRequest->status }}
                            @endif

                        </td>

                    </tr>


                </table>


                @if ($type === 'rejected' && $purchaseRequest->rejection_reason)
                    <div
                        style="
                        background:#fff4e5;
                        border-left:5px solid #ffc107;
                        padding:15px;
                        margin:20px 0;
                    ">

                        <strong>
                            Reason for Rejection
                        </strong>

                        <p style="margin:10px 0 0 0;">

                            {{ $purchaseRequest->rejection_reason }}

                        </p>

                    </div>
                @endif

                @if ($type === 'reviewer')
                    <p>

                        Please review the Purchase Request
                        and take the appropriate action.

                    </p>
                @elseif ($type === 'approver')
                    <p>

                        Please review the Purchase Request
                        and provide your final approval.

                    </p>
                @elseif ($type === 'finance')
                    <p>

                        Please review the Purchase Request,
                        verify the budget and supporting information,
                        and take the appropriate Finance action.

                    </p>
                @elseif ($type === 'approved')
                    <p>

                        The Purchase Request has completed
                        the approval process successfully.

                    </p>
                @elseif ($type === 'rejected')
                    <p>

                        Please review the comments above,
                        make the necessary revisions,
                        and resubmit the Purchase Request
                        if required.

                    </p>
                @endif


                @if (in_array($type, ['reviewer', 'approver', 'finance', 'rejected']))

                    <div
                        style="
                        text-align:center;
                        margin:35px 0 20px 0;
                    ">

                        <a href="{{ $purchaseRequestUrl }}"
                            style="
                            background:{{ $buttonColor }};
                            color:#ffffff;
                            text-decoration:none;
                            padding:12px 25px;
                            border-radius:6px;
                            display:inline-block;
                            font-weight:bold;
                        ">

                            @if ($type === 'reviewer')
                                Review Purchase Request
                            @elseif ($type === 'approver')
                                Review &amp; Approve
                            @elseif ($type === 'finance')
                                Review Purchase Request
                            @elseif ($type === 'rejected')
                                View Purchase Request
                            @endif

                        </a>

                    </div>

                @endif


                @if (in_array($type, ['approved']))
                    <div
                        style="
                        text-align:center;
                        margin:35px 0;
                    ">

                        <a href="{{ $purchaseRequestUrl }}"
                            style="
                            background:#198754;
                            color:#ffffff;
                            text-decoration:none;
                            padding:12px 25px;
                            border-radius:6px;
                            display:inline-block;
                            font-weight:bold;
                        ">

                            View Purchase Request

                        </a>

                    </div>


                    <div
                        style="
                        margin-top:20px;
                        padding:15px;
                        background:#f8f9fa;
                        border:1px solid #e5e7eb;
                        border-radius:6px;
                    ">

                        <p
                            style="
                            margin:0 0 8px 0;
                            color:#555555;
                            font-size:13px;
                        ">

                            Direct link:

                        </p>


                        <a href="{{ $purchaseRequestUrl }}"
                            style="
                            color:#0d6efd;
                            text-decoration:underline;
                            word-break:break-all;
                            font-size:13px;
                        ">

                            {{ $purchaseRequestUrl }}

                        </a>

                    </div>
                @endif



                {{-- ================================================= --}}
                {{-- KIND REGARDS --}}
                {{-- ================================================= --}}

                <p style="margin-top:35px;">

                    Kind regards,<br>

                    <strong>
                        NGO Forum on Cambodia
                    </strong><br>

                    Purchase Request Management System

                </p>

            </td>

        </tr>

    </table>

</body>

</html>
