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
        Schema::create('quotation_analyses', function (Blueprint $table) {

            $table->id();

            // Header
            $table->string('qa_no')->unique();

            $table->date('qa_date');

            $table->string('item_name');

            $table->integer('quantity')->default(1);

            // Decision
            $table->longText('decision_explanation')->nullable();

            // User
            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_analyses');
    }
};
