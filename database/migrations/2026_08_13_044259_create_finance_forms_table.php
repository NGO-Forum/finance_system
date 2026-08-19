<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance_forms', function (Blueprint $table) {
            $table->id();

            $table->string('voucher_no')->unique()->nullable();

            $table->date('voucher_date');

            $table->enum('transaction_type', [
                'cash_advance',
                'cash_advance_settlement',
                'reimbursement',
                'direct_payment',
                'journal_entry',
                'income',
                'disbursement',
                'refund',
                'receipt',
            ]);

            $table->string('received_from')->nullable();

            $table->decimal('amount', 15, 2)->default(0);

            $table->string('amount_in_words')->nullable();

            $table->enum('status', [
                'draft',
                'completed',
                'cancelled',
            ])->default('draft');

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('transaction_type');
            $table->index('voucher_date');
            $table->index('status');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_forms');
    }
};
