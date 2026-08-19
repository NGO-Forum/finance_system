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
        Schema::create('verbal_quotes', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('quote_no')->nullable();      // QF #
            $table->date('quote_date');                // Date

            $table->foreignId('requested_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('supplier_name');
            $table->string('contact_information')->nullable();

            $table->date('validity_date')->nullable();

            $table->date('contact_date')->nullable();
            $table->time('contact_time')->nullable();

            // Footer
            $table->text('additional_specifications')->nullable();

            $table->foreignId('prepared_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->date('prepared_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verbal_quotes');
    }
};
