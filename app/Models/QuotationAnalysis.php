<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [

        'qa_no',

        'qa_date',

        'item_name',

        'quantity',

        'recommended_supplier_id',

        'decision_explanation',

        'created_by',

    ];

    protected $casts = [

        'qa_date' => 'date',

    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function suppliers()
    {
        return $this->hasMany(QuotationAnalysisSupplier::class);
    }

    public function committees()
    {
        return $this->hasMany(QuotationAnalysisCommittee::class);
    }

    public function recommendedSupplier()
    {
        return $this->belongsTo(
            QuotationAnalysisSupplier::class,
            'recommended_supplier_id'
        );
    }
}
