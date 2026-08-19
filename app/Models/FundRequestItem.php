<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'fund_request_id',
        'description',
        'cost',
        'quantity',
        'time',
        'budget',
        'budget_code',
        'donor_code',
        'donor',
        'remarks',
    ];

    public function fundRequest()
    {
        return $this->belongsTo(FundRequest::class);
    }
}
