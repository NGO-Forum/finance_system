<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'phone',
        'department_id',
        'role_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function fundRequests()
    {
        return $this->hasMany(FundRequest::class);
    }

    public function reviewedFundRequests()
    {
        return $this->hasMany(FundRequest::class, 'reviewed_by');
    }

    public function approvedFundRequests()
    {
        return $this->hasMany(FundRequest::class, 'approved_by');
    }

    public function approvedExpenditureSummaries()
    {
        return $this->hasMany(
            ExpenditureSummary::class,
            'approved_by'
        );
    }

    public function createdExpenditureSummaries()
    {
        return $this->hasMany(
            ExpenditureSummary::class,
            'user_id'
        );
    }


    public function allowanceForms()
    {
        return $this->hasMany(AllowanceForm::class, 'created_by');
    }


    public function quotationAnalyses()
    {
        return $this->hasMany(
            QuotationAnalysis::class,
            'created_by'
        );
    }

    public function quotationAnalysisCommittees()
    {
        return $this->hasMany(
            QuotationAnalysisCommittee::class
        );
    }
}
