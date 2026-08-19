<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenditure_summaries', function (Blueprint $table) {

            $table->id();
            $table->string('activity')->nullable();

            $table->date('date');
            $table->string('place')->nullable();

            $table->enum('transaction_type', [
                'Advance Settlement',
                'Reimbursement',
                'Direct Pay',
            ])->nullable();

            $table->enum('payment_type', [
                'Cash/QR Code',
                'Check/Bank Transfer',
                'Internet Banking',
            ])->nullable();

            $table->string('advance_voucher_no')->nullable();

            $table->date('advance_date')->nullable();

            $table->boolean('variance_required')->default(false);
            $table->text('variance_explanation')->nullable();

            $table->boolean('late_liquidation')->default(false);
            $table->text('late_liquidation_explanation')->nullable();

            $table->string('prepared_signature')->nullable();
            $table->string('reviewer_signature')->nullable();
            $table->string('approved_signature')->nullable();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('fund_request_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->enum('status', [
                'Pending',
                'Pending Manager Approval',
                'Pending ED Approval',
                'Approved',
                'Rejected'
            ])->default('Pending');

            $table->timestamp('reviewed_at')->nullable();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenditure_summaries');
    }
};
