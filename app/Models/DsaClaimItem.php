<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DsaClaimItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'dsa_claim_id',
        'expense_date',
        'breakfast',
        'lunch',
        'dinner',
        'accommodation',
        'transport',
        'incident',
        'total',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'breakfast' => 'decimal:2',
        'lunch' => 'decimal:2',
        'dinner' => 'decimal:2',
        'accommodation' => 'decimal:2',
        'transport' => 'decimal:2',
        'incident' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function claim()
    {
        return $this->belongsTo(DsaClaim::class, 'dsa_claim_id');
    }
}
