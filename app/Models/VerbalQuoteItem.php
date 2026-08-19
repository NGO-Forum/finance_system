<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerbalQuoteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'verbal_quote_id',
        'budget_line',
        'description',
        'qty',
        'unit_price',
        'extended_price',
    ];

    protected $casts = [
        'qty' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'extended_price' => 'decimal:2',
    ];

    /**
     * Parent Verbal Quote
     */
    public function verbalQuote()
    {
        return $this->belongsTo(VerbalQuote::class);
    }

    /**
     * Automatically calculate Extended Price
     */
    protected static function booted()
    {
        static::saving(function ($item) {
            $item->extended_price = $item->qty * $item->unit_price;
        });
    }
}
