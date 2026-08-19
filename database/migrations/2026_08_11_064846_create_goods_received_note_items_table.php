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
        Schema::create('goods_received_note_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('goods_received_note_id')
                ->constrained('goods_received_notes')
                ->cascadeOnDelete();

            $table->integer('sort_order')
                ->default(0);

            $table->text('description');

            $table->text('inspection_criteria')->nullable();

            $table->decimal('ordered_quantity', 12, 2)
                ->default(0);


            $table->boolean('received')
                ->default(false);

            $table->boolean('inspected')
                ->default(false);

            $table->boolean('accepted')
                ->default(false);

            $table->boolean('rejected')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_received_note_items');
    }
};
