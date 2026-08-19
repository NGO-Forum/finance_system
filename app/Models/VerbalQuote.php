<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerbalQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_no',
        'quote_date',
        'requested_by',
        'supplier_name',
        'contact_information',
        'validity_date',
        'contact_date',
        'contact_time',
        'additional_specifications',
        'prepared_by',
        'prepared_date',
    ];

    protected $casts = [
        'quote_date' => 'date',
        'validity_date' => 'date',
        'contact_date' => 'date',
        'contact_time' => 'datetime:H:i',
        'prepared_date' => 'date',
    ];

    /**
     * Requested By
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    /**
     * Prepared By
     */
    public function preparer()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    /**
     * Quote Items
     */
    public function items()
    {
        return $this->hasMany(VerbalQuoteItem::class);
    }

    /**
     * Grand Total
     */
    public function getGrandTotalAttribute()
    {
        return $this->items->sum('extended_price');
    }
}
