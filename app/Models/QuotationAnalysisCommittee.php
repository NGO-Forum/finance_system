<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationAnalysisCommittee extends Model
{
    use HasFactory;

    protected $fillable = [

        'quotation_analysis_id',

        'user_id',

        'position',

        'signed_date',

    ];

    protected $casts = [

        'signed_date' => 'date',

    ];


    public function quotationAnalysis()
    {
        return $this->belongsTo(
            QuotationAnalysis::class
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
