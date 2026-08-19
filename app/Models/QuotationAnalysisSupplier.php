<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationAnalysisSupplier extends Model
{
    use HasFactory;

    protected $fillable = [

        'quotation_analysis_id',

        'supplier_no',

        'supplier_name',

        'contact_person',

        'phone',

        'total_score',

    ];

    public function quotationAnalysis()
    {
        return $this->belongsTo(QuotationAnalysis::class);
    }

    public function scores()
    {
        return $this->hasMany(QuotationAnalysisScore::class);
    }
}
