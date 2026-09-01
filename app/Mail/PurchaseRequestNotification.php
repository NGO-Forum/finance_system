<?php

namespace App\Mail;

use App\Models\PurchaseRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $purchaseRequest;
    public $user;
    public $type;

    public function __construct(
        PurchaseRequest $purchaseRequest,
        User $user,
        string $type
    ) {
        $this->purchaseRequest = $purchaseRequest;
        $this->user = $user;
        $this->type = $type;
    }

    public function build()
    {
        $subject = match ($this->type) {

            'reviewer' =>
                'Purchase Request Requires Manager Review - '
                . $this->purchaseRequest->purchase_no,

            'approver' =>
                'Purchase Request Requires Final Approval - '
                . $this->purchaseRequest->purchase_no,

            'finance' =>
                'Purchase Request Requires Finance Review - '
                . $this->purchaseRequest->purchase_no,

            'approved' =>
                'Purchase Request Approved - '
                . $this->purchaseRequest->purchase_no,

            'rejected' =>
                'Purchase Request Rejected - '
                . $this->purchaseRequest->purchase_no,

            default =>
                'Purchase Request Notification - '
                . $this->purchaseRequest->purchase_no,
        };

        return $this
            ->subject($subject)
            ->view('emails.purchase-request-notification');
    }
}