<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinanceFormItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'finance_form_id',
        'sort_order',
        'date',
        'line_type',
        'description',
        'account_code',
        'donor',
        'amount',
        'debit',
        'credit',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
    ];

    public function financeForm(): BelongsTo
    {
        return $this->belongsTo(FinanceForm::class);
    }
}
