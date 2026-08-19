<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendant_lists', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->date('activity_date');

            // Activity time
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->string('venue')->nullable();

            $table->boolean('registration_enabled')
                ->default(false);

            $table->string('registration_token')
                ->nullable()
                ->unique();

            $table->string('registration_link')
                ->nullable();

            $table->string('qr_code_path')
                ->nullable();

            $table->integer('max_participants')
                ->nullable();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendant_lists');
    }
};
