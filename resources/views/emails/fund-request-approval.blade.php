<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Fund Request Approval</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; background:#f5f7fa; padding:20px;">

    <div style="max-width:700px; margin:auto; background:#ffffff; border-radius:10px; padding:30px;">

        <h2 style="color:#16a34a; margin-top:0;">

            @if ($recipientType === 'reviewer')
                Fund Request Review Required
            @else
                Fund Request Final Approval Required
            @endif

        </h2>

        <p>
            Dear <strong>{{ $approver->name }}</strong>,
        </p>

        @if ($recipientType === 'reviewer')
            <p>
                A new Fund Request has been submitted and requires your review.
                Please review, edit if necessary, and approve the request.
            </p>
        @else
            <p>
                The Manager has completed the review of this Fund Request.
                It now requires your final approval.
            </p>
        @endif

        <table width="100%" cellpadding="10" cellspacing="0"
            style="border-collapse:collapse; margin-top:20px; border:1px solid #e5e7eb;">

            <tr>
                <td style="background:#f3f4f6;"><strong>Title</strong></td>
                <td>{{ $fundRequest->title }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Department</strong></td>
                <td>{{ $fundRequest->department?->name }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Requested By</strong></td>
                <td>{{ $fundRequest->user?->name }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Total Budget</strong></td>
                <td>${{ number_format($fundRequest->total_budget, 2) }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Request Date</strong></td>
                <td>{{ \Carbon\Carbon::parse($fundRequest->request_date)->format('d M Y') }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Status</strong></td>
                <td>{{ $fundRequest->status }}</td>
            </tr>

        </table>

        <div style="margin-top:30px;">

            <a href="{{ route('fund-requests.edit', $fundRequest) }}"
                style="
                    background:#16a34a;
                    color:#ffffff;
                    text-decoration:none;
                    padding:12px 24px;
                    border-radius:6px;
                    display:inline-block;
                    font-weight:bold;">

                @if ($recipientType === 'reviewer')
                    Review Fund Request
                @else
                    Final Approve Fund Request
                @endif

            </a>

        </div>

        <p style="margin-top:30px; color:#6b7280; font-size:14px;">
            This is an automated notification from the Fund Request Management System.
            Please do not reply to this email.
        </p>

    </div>

</body>

</html>
