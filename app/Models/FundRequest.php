<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'request_date',
        'place',
        'fund_by',
        'objectives',
        'rationale',
        'expectation',
        'total_budget',
        'user_id',
        'department_id',
        'donor_logo_id',

        'reviewed_by',
        'approved_by',

        'participant_list',

        'requester_signature',
        'reviewer_signature',
        'approved_signature',

        'rejection_reason',

        'status',

        'reviewed_at',
        'approved_at',
    ];

    protected $casts = [
        'request_date' => 'date',
        'reviewed_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(FundRequestItem::class);
    }

    public function donorLogos()
    {
        return $this->belongsToMany(DonorLogo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function agendas()
    {
        return $this->hasMany(FundRequestAgenda::class);
    }

    public function expenditureSummary()
    {
        return $this->hasOne(
            ExpenditureSummary::class,
            'fund_request_id'
        );
    }
}
