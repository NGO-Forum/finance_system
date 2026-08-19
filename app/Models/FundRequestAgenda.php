<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundRequestAgenda extends Model
{
    protected $fillable = [
        'fund_request_id',
        'start_time',
        'end_time',
        'activity',
        'responsible_person',
        'remarks',
    ];

    public function fundRequest()
    {
        return $this->belongsTo(FundRequest::class);
    }
}