<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureSummaryItemAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'expenditure_summary_item_id',
        'file',
        'original_name',
    ];

    public function item()
    {
        return $this->belongsTo(
            ExpenditureSummaryItem::class,
            'expenditure_summary_item_id'
        );
    }
}
