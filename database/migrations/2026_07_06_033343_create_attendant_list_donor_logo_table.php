<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendant_list_donor_logo', function (Blueprint $table) {

            $table->id();

            $table->foreignId('attendant_list_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('donor_logo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'attendant_list_id',
                'donor_logo_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendant_list_donor_logo');
    }
};