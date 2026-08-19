<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {

            $table->id();

            // Invoice information
            $table->string('invoice_no')->unique();
            $table->date('invoice_date');

            // Customer information
            $table->string('customer')->nullable();
            $table->string('company')->nullable();
            $table->text('address')->nullable();
            $table->string('telephone')->nullable();

            // Total
            $table->decimal('grand_total', 15, 2)->default(0);

            // Amount in words
            $table->text('amount_in_words')->nullable();

            // Signature
            $table->string('issued_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};