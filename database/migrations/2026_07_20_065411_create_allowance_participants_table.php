<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('allowance_participants', function (Blueprint $table) {

            $table->id();

            $table->foreignId('allowance_form_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('gender')->nullable();

            $table->string('organization')->nullable();

            $table->string('position')->nullable();

            $table->string('province')->nullable();

            $table->decimal('distance', 8, 2)->default(0);

            $table->json('costs')->nullable();

            $table->decimal('breakfast',10,2)->default(0);

            $table->decimal('lunch',10,2)->default(0);

            $table->decimal('dinner',10,2)->default(0);

            $table->decimal('accommodation',10,2)->default(0);

            $table->decimal('taxi',10,2)->default(0);

            $table->decimal('local_transport',10,2)->default(0);

            $table->decimal('other',10,2)->default(0);

            $table->decimal('total',10,2)->default(0);

            $table->text('remarks')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('allowance_participants');
    }
};