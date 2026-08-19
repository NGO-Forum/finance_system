<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationAnalysisScore extends Model
{
    use HasFactory;

    protected $fillable = [

        'quotation_analysis_supplier_id',

        'quotation_analysis_criterion_id',

        'description',

        'score',

    ];


    public function supplier()
    {
        return $this->belongsTo(
            QuotationAnalysisSupplier::class,
            'quotation_analysis_supplier_id'
        );
    }

    public function criterion()
    {
        return $this->belongsTo(
            QuotationAnalysisCriterion::class,
            'quotation_analysis_criterion_id'
        );
    }
}
