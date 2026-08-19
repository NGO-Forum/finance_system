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
        Schema::create('quotation_analysis_scores', function (Blueprint $table) {

            $table->id();

            // Supplier
            $table->unsignedBigInteger('quotation_analysis_supplier_id');

            // Criterion
            $table->unsignedBigInteger('quotation_analysis_criterion_id');

            $table->text('description')->nullable();

            $table->tinyInteger('score');

            $table->timestamps();

            // Foreign Keys (Short Names)
            $table->foreign(
                'quotation_analysis_supplier_id',
                'qa_score_supplier_fk'
            )
                ->references('id')
                ->on('quotation_analysis_suppliers')
                ->cascadeOnDelete();

            $table->foreign(
                'quotation_analysis_criterion_id',
                'qa_score_criterion_fk'
            )
                ->references('id')
                ->on('quotation_analysis_criteria')
                ->cascadeOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_analysis_scores');
    }
};
