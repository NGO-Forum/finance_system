<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_order_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('purchase_order_id')
                ->constrained('purchase_orders')
                ->cascadeOnDelete();

            $table->unsignedInteger('sort_order')->default(1);

            $table->text('description');

            $table->date('required_date')->nullable();

            $table->string('unit')->nullable();

            $table->decimal('quantity', 15, 2)->default(1);

            $table->decimal('unit_price', 15, 2)->default(0);

            $table->decimal('total', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
