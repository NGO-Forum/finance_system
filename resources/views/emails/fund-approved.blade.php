blade
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Fund Request Approved</title>
</head>

<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fb;padding:40px 0;">

        <tr>
            <td align="center">

                <table width="700" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.08);">

                    <!-- Content -->
                    <tr>
                        <td style="padding:35px;">

                            @if ($recipientType == 'finance')
                                <p style="font-size:16px;color:#374151;">
                                    Dear Finance Team,
                                </p>

                                <p style="font-size:15px;color:#6b7280;line-height:1.8;">
                                    A fund request has completed the approval workflow and is now ready
                                    for financial processing.
                                </p>
                            @else
                                <p style="font-size:16px;color:#374151;">
                                    Dear {{ $fundRequest->user->name }},
                                </p>

                                <p style="font-size:15px;color:#6b7280;line-height:1.8;">
                                    Congratulations!
                                    Your Fund Request has been approved successfully.

                                    Your request has now been forwarded to the Finance Department for financial
                                    processing.
                                    You will be notified if any further action is required.
                                </p>
                            @endif

                            <!-- Budget Card -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin:25px 0;background:#f0fdf4;border-left:5px solid #16a34a;border-radius:10px;">

                                <tr>
                                    <td style="padding:20px;">

                                        <div style="font-size:13px;color:#6b7280;">
                                            @if ($recipientType == 'finance')
                                                TOTAL APPROVED BUDGET
                                            @else
                                                YOUR APPROVED BUDGET
                                            @endif
                                        </div>

                                        <div style="font-size:32px;font-weight:bold;color:#16a34a;margin-top:8px;">
                                            ${{ number_format($fundRequest->total_budget, 2) }}
                                        </div>

                                    </td>
                                </tr>

                            </table>

                            <!-- Details -->
                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="border-collapse:collapse;border:1px solid #e5e7eb;">

                                <tr>
                                    <td><strong>Title</strong></td>
                                    <td>{{ $fundRequest->title }}</td>
                                </tr>

                                <tr style="background:#f9fafb;">
                                    <td><strong>Department</strong></td>
                                    <td>{{ $fundRequest->department?->name }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Requested By</strong></td>
                                    <td>{{ $fundRequest->user?->name }}</td>
                                </tr>

                                <tr style="background:#f9fafb;">
                                    <td><strong>Request Date</strong></td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($fundRequest->request_date)->format('d M Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong>Approved Date</strong></td>
                                    <td>
                                        {{ now()->format('d M Y') }}
                                    </td>
                                </tr>

                            </table>

                            <!-- Button -->
                            <div style="text-align:center;margin-top:35px;">

                                <a href="{{ route('fund-requests.index', $fundRequest) }}"
                                    style="
                                        background:#16a34a;
                                        color:#ffffff;
                                        text-decoration:none;
                                        padding:14px 28px;
                                        border-radius:8px;
                                        display:inline-block;
                                        font-weight:bold;
                                    ">
                                    @if ($recipientType == 'finance')
                                        Review Fund Request
                                    @else
                                        View Your Fund Request
                                    @endif
                                </a>

                            </div>

                            @if ($recipientType == 'finance')
                                <div
                                    style="
                                        margin-top:25px;
                                        background:#eff6ff;
                                        border-left:5px solid #2563eb;
                                        padding:18px;
                                        border-radius:8px;
                                    ">
                                    <strong>Finance Action Required</strong>

                                    <p style="margin-top:10px;color:#555;line-height:1.7;">
                                        Please review the approved Fund Request and continue with
                                        the financial verification and payment procedures.
                                    </p>
                                </div>
                            @else
                                <div
                                    style="
                                        margin-top:25px;
                                        background:#ecfdf5;
                                        border-left:5px solid #16a34a;
                                        padding:18px;
                                        border-radius:8px;
                                    ">
                                    <strong>Approval Successful</strong>

                                    <p style="margin-top:10px;color:#555;line-height:1.7;">
                                        Your Fund Request has successfully completed the approval process.
                                        It has now been forwarded to the Finance Department for processing.
                                        No further action is required from you at this stage unless contacted by
                                        Finance.
                                    </p>
                                </div>
                            @endif

                        </td>
                    </tr>
                </table>

            </td>
        </tr>

    </table>

</body>

</html>
