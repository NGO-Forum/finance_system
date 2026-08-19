<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('allowance_forms', function (Blueprint $table) {

            $table->id();

            $table->string('allowance_no')->unique();

            $table->string('activity');

            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            $table->string('program')->nullable();

            $table->string('venue')->nullable();

            $table->string('donor')->nullable();

            $table->string('donor_code')->nullable();

            $table->string('budget_code')->nullable();

            $table->json('dates')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('allowance_forms');
    }
};
