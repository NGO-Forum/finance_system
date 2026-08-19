<?php

namespace App\Mail;

use App\Models\User;
use App\Models\FundRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FundRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $fundRequest;
    public $approver;
    public $recipientType;

    public function __construct(
        FundRequest $fundRequest,
        User $approver,
        string $recipientType
    ) {
        $this->fundRequest = $fundRequest;
        $this->approver = $approver;
        $this->recipientType = $recipientType;
    }

    public function build()
    {
        return $this
            ->subject('Fund Request Approval Required')
            ->view('emails.fund-request-approval');
    }
}
