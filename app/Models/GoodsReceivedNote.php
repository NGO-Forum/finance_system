<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GoodsReceivedNote extends Model
{
    protected $fillable = [

        'grn_no',
        'grn_date',

        'supplier_name',
        'supplier_address',
        'supplier_tel',

        'po_no',
        'vendor_invoice_no',
        'delivery_note_no',

        'delivered_by',
        'delivered_date',
        'delivered_time',

        'received_by',
        'received_date',
        'received_time',

        'inspected_by',
        'inspected_date',
        'inspected_time',

        'comments',

        'created_by',
    ];

    protected $casts = [

        'grn_date' => 'date',

        'delivered_date' => 'date',
        'received_date' => 'date',
        'inspected_date' => 'date',
    ];


    public function items(): HasMany
    {
        return $this->hasMany(
            GoodsReceivedNoteItem::class
        )->orderBy('sort_order');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
}
