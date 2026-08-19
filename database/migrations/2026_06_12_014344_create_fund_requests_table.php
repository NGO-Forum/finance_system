<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_requests', function (Blueprint $table) {

            $table->id();

            $table->string('title');
            $table->date('request_date');
            $table->string('place')->nullable();

            $table->Text('fund_by')->nullable();
            $table->Text('rationale')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('expectation')->nullable();

            $table->decimal('total_budget', 15, 2)->default(0);

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('department_id')->constrained();

            $table->text('rejection_reason')->nullable();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('participant_list')->nullable();

            $table->string('requester_signature')->nullable();

            $table->string('reviewer_signature')->nullable();

            $table->string('approved_signature')->nullable();

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

    public function down(): void
    {
        Schema::dropIfExists('fund_requests');
    }
};
