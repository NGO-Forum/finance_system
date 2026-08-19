<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [

        'po_no',
        'pr_no',
        'po_date',

        'supplier_name',
        'supplier_address',
        'supplier_phone',

        'delivery_address',
        'delivery_date',

        'term_of_payment',
        'mode_of_payment',
        'term_of_delivery',
        'currency',

        'tax_percent',
        'other_charges',

        'ordered_by',
        'ordered_date',
        'approved_by',
        'approved_date',

        'vendor_name',
        'vendor_position',
        'vendor_date',
        'vendor_signature',

        'status',
        'notes',
    ];


    protected $casts = [

        'po_date' => 'date',

        'delivery_date' => 'date',

        'ordered_date' => 'date',

        'approved_date' => 'date',

        'vendor_date' => 'date',

        'tax_percent' => 'decimal:2',

        'other_charges' => 'decimal:2',
    ];


    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class)
            ->orderBy('sort_order');
    }


    public function getSubtotalAttribute()
    {
        return $this->items->sum(function ($item) {

            return (float) $item->total;

        });
    }


    public function getTaxAmountAttribute()
    {
        return $this->subtotal *
            ((float) $this->tax_percent / 100);
    }

    public function getGrandTotalAttribute()
    {
        return $this->subtotal
            + $this->taxAmount
            + (float) $this->other_charges;
    }
}