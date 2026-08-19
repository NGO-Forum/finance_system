<?php

namespace App\Mail;

use App\Models\ExpenditureSummary;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpenditureSummaryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public ExpenditureSummary $summary;
    public User $approver;
    public string $recipientType;

    /**
     * recipientType:
     * reviewer  = Manager Review
     * approver  = Final Approval
     * finance   = Notify Finance
     * requester = Notify Requester
     */
    public function __construct(
        ExpenditureSummary $summary,
        User $approver,
        string $recipientType
    ) {
        $this->summary = $summary->load([
            'user',
            'fundRequest',
            'reviewer',
            'approver',
        ]);

        $this->approver = $approver;
        $this->recipientType = $recipientType;
    }

    public function build()
    {
        $subject = match ($this->recipientType) {

            'reviewer' =>
            'Expenditure Summary Review Required',

            'approver' =>
            'Expenditure Summary Final Approval Required',

            'finance' =>
            'Expenditure Summary Approved',

            'requester' =>
            'Your Expenditure Summary Has Been Approved',

            default =>
            'Expenditure Summary Notification',
        };

        return $this
            ->subject($subject)
            ->view('emails.expenditure-summary');
    }
}
