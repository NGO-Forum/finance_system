<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donor_logo_fund_request', function (Blueprint $table) {

            $table->id();

            $table->foreignId('fund_request_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('donor_logo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donor_logo_fund_request');
    }
};
