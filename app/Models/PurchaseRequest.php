<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $fillable = [

        'purchase_no',

        'request_date',

        'donor',

        'donor_code',

        'budget_line',

        'purpose',

        'grand_total',

        'status',

        'prepared_by',

        'reviewed_by',

        'approved_by',

        'reviewed_at',

        'approved_at',

        'prepared_signature',

        'reviewer_signature',

        'approver_signature'

    ];

    public function items()
    {
        return $this->hasMany(PurchaseRequestItem::class);
    }

    public function preparer()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
