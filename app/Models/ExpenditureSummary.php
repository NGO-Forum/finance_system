<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'fund_request_id',
        'activity',
        'date',
        'place',
        'transaction_type',
        'payment_type',
        'advance_voucher_no',
        'advance_date',
        'variance_required',
        'variance_explanation',
        'late_liquidation',
        'late_liquidation_explanation',
        'prepared_signature',
        'reviewer_signature',
        'approved_signature',
        'reviewed_by',
        'approved_by',
        'user_id',
        'reviewed_at',
        'approved_at',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'advance_date' => 'date',

        'variance_required' => 'boolean',
        'late_liquidation' => 'boolean',

        'reviewed_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function fundRequest()
    {
        return $this->belongsTo(
            FundRequest::class,
            'fund_request_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function reviewer()
    {
        return $this->belongsTo(
            User::class,
            'reviewed_by'
        );
    }

    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }

    public function items()
    {
        return $this->hasMany(
            ExpenditureSummaryItem::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getTotalAvAmountAttribute()
    {
        return $this->items->sum('av_amount');
    }

    public function getTotalActualExpenseAttribute()
    {
        return $this->items->sum('actual_expense');
    }

    public function getTotalVarianceAmountAttribute()
    {
        return $this->items->sum('variance_amount');
    }

    public function getTotalVariancePercentAttribute()
    {
        if ($this->total_av_amount <= 0) {
            return 0;
        }

        return round(
            ($this->total_variance_amount / $this->total_av_amount) * 100,
            2
        );
    }
}
