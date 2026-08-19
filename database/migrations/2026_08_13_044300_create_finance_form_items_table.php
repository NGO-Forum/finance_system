<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance_form_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('finance_form_id')
                ->constrained('finance_forms')
                ->cascadeOnDelete();

            $table->unsignedInteger('sort_order')->default(0);

            $table->date('date')->nullable();

            $table->enum('line_type', [
                'advance',
                'expense',
                'settlement',
                'income',
                'tax',
                'payable',
                'bank',
                'other',
            ])->default('other');

            $table->text('description')->nullable();

            $table->string('account_code')->nullable();

            $table->string('donor')->nullable();

            $table->decimal('amount', 15, 2)->default(0);

            $table->decimal('debit', 15, 2)->default(0);

            $table->decimal('credit', 15, 2)->default(0);

            $table->timestamps();

            $table->index('finance_form_id');
            $table->index('line_type');
            $table->index('account_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_form_items');
    }
};
