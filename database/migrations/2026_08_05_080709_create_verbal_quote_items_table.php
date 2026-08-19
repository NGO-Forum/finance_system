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
        Schema::create('verbal_quote_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('verbal_quote_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('budget_line')->nullable();

            $table->text('description');

            $table->decimal('qty', 10, 2)->default(1);

            $table->decimal('unit_price', 15, 2)->default(0);

            $table->decimal('extended_price', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verbal_quote_items');
    }
};
