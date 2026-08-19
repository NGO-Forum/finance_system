<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationAnalysisCriterion extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',

        'max_score',

        'sort_order',

    ];

    public function scores()
    {
        return $this->hasMany(
            QuotationAnalysisScore::class
        );
    }
}
