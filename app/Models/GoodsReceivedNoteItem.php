<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoodsReceivedNoteItem extends Model
{
    protected $fillable = [

        'goods_received_note_id',

        'sort_order',

        'description',

        'inspection_criteria',

        'ordered_quantity',

        'received',

        'inspected',

        'accepted',

        'rejected',
    ];


    protected $casts = [

        'received' => 'boolean',

        'inspected' => 'boolean',

        'accepted' => 'boolean',

        'rejected' => 'boolean',
    ];


    public function goodsReceivedNote(): BelongsTo
    {
        return $this->belongsTo(
            GoodsReceivedNote::class
        );
    }
}
