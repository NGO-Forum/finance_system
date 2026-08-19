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
        Schema::create('allowance_form_donor_logo', function (Blueprint $table) {

            $table->id();

            $table->foreignId('allowance_form_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('donor_logo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowance_form_donor_logo');
    }
};
