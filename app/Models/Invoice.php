<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'created_by',
        'invoice_no',
        'invoice_date',
        'customer',
        'address',
        'telephone',
        'grand_total',
        'amount_in_words',
        'company',
        'issued_by',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'grand_total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class)
            ->orderBy('sort_order');
    }

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
}
