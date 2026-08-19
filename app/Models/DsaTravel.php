<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DsaTravel extends Model
{
    use HasFactory;

    protected $table = 'dsa_travels';
    
    protected $fillable = [
        'dsa_claim_id',
        'travel_date',
        'from_location',
        'to_location',
        'purpose',
        'departure_time',
        'arrival_time',
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];


    public function claim()
    {
        return $this->belongsTo(DsaClaim::class);
    }
}