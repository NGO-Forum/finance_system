<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DsaClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_no',
        'date_requested',
        'user_id',
        'department_id',
        'donor_code',
        'budget_code',
        'donor',
        'purpose_of_travel',
        'note',
        'grand_total',
        'status',
        'verified_by',
        'paid_by',
        'received_by',
    ];

    protected $casts = [
        'date_requested' => 'date',
        'grand_total' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function travels()
    {
        return $this->hasMany(DsaTravel::class);
    }

    public function items()
    {
        return $this->hasMany(DsaClaimItem::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'paid_by');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
