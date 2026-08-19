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
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();

            $table->string('purchase_no')->unique();

            $table->date('request_date');

            $table->string('donor')->nullable();
            $table->string('donor_code')->nullable();
            $table->string('budget_line')->nullable();

            $table->text('purpose');

            $table->decimal('grand_total', 15, 2)->default(0);

            $table->enum('status', [
                'Draft',
                'Pending Manager Approval',
                'Pending Finance Approval',
                'Approved',
                'Rejected',
                'Cancelled'
            ])->default('Draft');

            $table->foreignId('prepared_by')->constrained('users');

            $table->foreignId('reviewed_by')->nullable()->constrained('users');

            $table->foreignId('approved_by')->nullable()->constrained('users');

            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->string('prepared_signature')->nullable();
            $table->string('reviewer_signature')->nullable();
            $table->string('approver_signature')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
