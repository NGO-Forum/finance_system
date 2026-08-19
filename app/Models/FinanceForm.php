<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FinanceForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_no',
        'voucher_date',
        'transaction_type',
        'received_from',
        'amount',
        'amount_in_words',
        'status',
        'created_by',
    ];

    protected $casts = [
        'voucher_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(FinanceFormItem::class)
            ->orderBy('sort_order');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function settlements(): HasMany
    {
        return $this->hasMany(
            FinanceForm::class,
            'advance_finance_form_id'
        );
    }

    public function getTransactionTypeLabelAttribute(): string
    {
        return match ($this->transaction_type) {

            'cash_advance'
            => 'Cash Advance',

            'cash_advance_settlement'
            => 'Cash Advance Settlement',

            'reimbursement'
            => 'Reimbursement',

            'direct_payment'
            => 'Direct Pay',

            'journal_entry'
            => 'Jurnal Entry',

            'income'
            => 'Income',

            'disbursement'
            => 'Disbursement',

            'refund'
            => 'Refund',

            'receipt'
            => 'Receipt',

            default
            => ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $this->transaction_type
                )
            ),
        };
    }
}
