<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureSummaryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'expenditure_summary_id',
        'description',
        'av_amount',
        'actual_expense',
        'variance_amount',
        'variance_percent',
        'budget_code',
        'donor',
        'donor_code',
    ];

    protected $casts = [
        'av_amount' => 'decimal:2',
        'actual_expense' => 'decimal:2',
        'variance_amount' => 'decimal:2',
        'variance_percent' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function summary()
    {
        return $this->belongsTo(
            ExpenditureSummary::class,
            'expenditure_summary_id'
        );
    }

    public function attachments()
    {
        return $this->hasMany(
            ExpenditureSummaryItemAttachment::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getVarianceDisplayAttribute()
    {
        return number_format(
            $this->variance_amount,
            2
        );
    }

    public function getVariancePercentDisplayAttribute()
    {
        return number_format(
            $this->variance_percent,
            2
        ) . '%';
    }
}
