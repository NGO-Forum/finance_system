<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dsa_claims', function (Blueprint $table) {

            $table->id();

            $table->string('claim_no')->unique();

            $table->date('date_requested');

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('donor_code')->nullable();

            $table->string('budget_code')->nullable();

            $table->string('donor')->nullable();

            $table->text('purpose_of_travel')->nullable();

            $table->text('note')->nullable();

            $table->decimal('grand_total', 12, 2)
                ->default(0);

            $table->enum('status', [
                'Draft',
                'Pending Manager',
                'Pending Finance',
                'Approved',
                'Rejected'
            ])->default('Draft');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('paid_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('received_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dsa_claims');
    }
};
