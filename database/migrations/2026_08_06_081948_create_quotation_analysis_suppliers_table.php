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
        Schema::create('quotation_analysis_suppliers', function (Blueprint $table) {

            $table->id();

            $table->foreignId('quotation_analysis_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->tinyInteger('supplier_no');

            $table->string('supplier_name');

            $table->string('contact_person')->nullable();

            $table->string('phone')->nullable();

            $table->integer('total_score')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_analysis_suppliers');
    }
};
