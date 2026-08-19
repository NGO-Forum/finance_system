<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_request_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('fund_request_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('description');

            $table->decimal('cost', 12, 2)->default(0);

            $table->integer('quantity')->default(1);

            $table->integer('time')->default(1);

            $table->decimal('budget', 15, 2)->default(0);

            $table->string('budget_code')->nullable();

            $table->string('donor_code')->nullable();

            $table->string('donor')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_request_items');
    }
};
