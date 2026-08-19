<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dsa_claim_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('dsa_claim_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('expense_date');

            $table->decimal('breakfast', 8, 2)
                ->default(0);

            $table->decimal('lunch', 8, 2)
                ->default(0);

            $table->decimal('dinner', 8, 2)
                ->default(0);

            $table->decimal('accommodation', 8, 2)
                ->default(0);

            $table->decimal('transport', 8, 2)
                ->default(0);

            $table->decimal('incident', 8, 2)
                ->default(0);

            $table->decimal('total', 10, 2)
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dsa_claim_items');
    }
};
