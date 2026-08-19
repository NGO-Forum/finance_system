<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [

        'purchase_order_id',

        'sort_order',

        'description',

        'required_date',

        'unit',

        'quantity',

        'unit_price',

        'total',
    ];


    protected $casts = [

        'required_date' => 'date',

        'quantity' => 'decimal:2',

        'unit_price' => 'decimal:2',

        'total' => 'decimal:2',
    ];


    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
