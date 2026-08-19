<?php

namespace App\Mail;

use App\Models\FundRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class FundRequestApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public FundRequest $fundRequest;

    public string $recipientType;

    public function __construct(
        FundRequest $fundRequest,
        string $recipientType
    ) {
        $this->fundRequest = $fundRequest;
        $this->recipientType = $recipientType;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Fund Request Approved - ' . $this->fundRequest->title
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.fund-approved'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
