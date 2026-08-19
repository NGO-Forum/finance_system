<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Expenditure Summary</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; background:#f5f7fa; padding:20px;">

    <div style="max-width:700px; margin:auto; background:#ffffff; border-radius:10px; padding:30px;">

        {{-- Title --}}
        <h2 style="color:#2563eb; margin-top:0;">

            @switch($recipientType)
                @case('reviewer')
                    Expenditure Summary Review Required
                @break

                @case('approver')
                    Expenditure Summary Final Approval Required
                @break

                @case('finance')
                    Expenditure Summary Approved
                @break

                @case('requester')
                    Your Expenditure Summary Has Been Approved
                @break

                @default
                    Expenditure Summary Notification
            @endswitch

        </h2>

        <p>
            Dear <strong>{{ $approver->name }}</strong>,
        </p>

        {{-- Message --}}
        @switch($recipientType)
            @case('reviewer')
                <p>
                    A new Expenditure Summary has been submitted and requires your review.
                    Please review the information and approve it to continue the workflow.
                </p>
            @break

            @case('approver')
                <p>
                    The Expenditure Summary has been reviewed and now requires your final approval.
                </p>
            @break

            @case('finance')
                <p>
                    An Expenditure Summary has completed the approval process.
                    Please continue with the finance process.
                </p>
            @break

            @case('requester')
                <p>
                    Your Expenditure Summary has been fully approved successfully.
                </p>
            @break
        @endswitch

        <table width="100%" cellpadding="10"
            style="border-collapse:collapse; margin-top:20px; border:1px solid #e5e7eb;">

            <tr>
                <td style="background:#f3f4f6;"><strong>Activity</strong></td>
                <td>{{ $summary->activity }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Date</strong></td>
                <td>{{ \Carbon\Carbon::parse($summary->date)->format('d M Y') }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Place</strong></td>
                <td>{{ $summary->place }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Submitted By</strong></td>
                <td>{{ $summary->user?->name }}</td>
            </tr>

            <tr>
                <td style="background:#f3f4f6;"><strong>Status</strong></td>
                <td>{{ $summary->status }}</td>
            </tr>

        </table>

        <div style="margin-top:30px;">
            <a href="{{ route('expenditure-summaries.show', $summary) }}"
                style="
                        background:#2563eb;
                        color:#ffffff;
                        text-decoration:none;
                        padding:12px 20px;
                        border-radius:6px;
                        display:inline-block;
                    ">

                @if ($recipientType == 'reviewer')
                    Review Expenditure Summary
                @elseif ($recipientType == 'approver')
                    Final Approve Expenditure Summary
                @else
                    View Expenditure Summary
                @endif
            </a>
        </div>

        <p style="margin-top:30px; color:#6b7280; font-size:14px;">
            This is an automated notification from the Expenditure Summary Management System.
            Please do not reply to this email.
        </p>

    </div>

</body>

</html>
