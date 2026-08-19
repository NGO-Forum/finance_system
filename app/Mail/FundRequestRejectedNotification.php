<?php

namespace App\Mail;

use App\Models\FundRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FundRequestRejectedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $fundRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(FundRequest $fundRequest)
    {
        $this->fundRequest = $fundRequest;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Fund Request Rejected')
            ->view('emails.fund-request-rejected');
    }
}