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
        Schema::create('expenditure_summary_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('expenditure_summary_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('description');

            $table->decimal('av_amount', 12, 2)->default(0);

            $table->decimal('actual_expense', 12, 2)->default(0);

            $table->decimal('variance_amount', 12, 2)->default(0);

            $table->decimal('variance_percent', 8, 2)->default(0);

            $table->string('budget_code')->nullable();

            $table->string('donor')->nullable();

            $table->string('donor_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenditure_summary_items');
    }
};
