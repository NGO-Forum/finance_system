<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dsa_travels', function (Blueprint $table) {

            $table->id();

            $table->foreignId('dsa_claim_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('travel_date');

            $table->string('from_location');

            $table->string('to_location');

            $table->text('purpose');

            $table->time('departure_time')->nullable();

            $table->time('arrival_time')->nullable();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dsa_travels');
    }
};
