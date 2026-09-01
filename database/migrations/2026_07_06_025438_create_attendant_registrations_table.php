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
        Schema::create('attendant_registrations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('attendant_list_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->string('full_name');

            $table->enum('gender', [
                'Female',
                'Male',
                'Other',
                'Prefer not to say'
            ])->nullable();

            $table->enum('age_group', [
                '<15',
                '15-30',
                '31-60',
                '>60'
            ])->nullable();

            $table->enum('indigenous', [
                'Yes',
                'No'
            ])->default('No');

            $table->enum('poor_status', [
                'ID Poor 1',
                'ID Poor 2',
                'Non Poor'
            ])->nullable();

            $table->enum('vulnerable_women', [
                'Yes',
                'No'
            ])->default('No');

            $table->enum('disability', [
                'Yes',
                'No'
            ])->default('No');

            $table->enum('residence_type', [
                'Phnom Penh',
                'Community'
            ])->nullable();

            $table->string('village')->nullable();

            $table->string('commune')->nullable();

            $table->string('district')->nullable();

            $table->string('province')->nullable();

            $table->string('institution')->nullable();

            $table->string('position')->nullable();

            $table->string('phone', 30)->nullable();

            $table->string('email')->nullable();

            $table->enum('unique_count', [
                'Yes',
                'No'
            ])->default('No');

            $table->string('allow_photos')->nullable();

            $table->text('remark')->nullable();

            $table->enum('network', [
                'RCC',
                'BWG',
                'NECCAW',
                'GGESI',
                'NRLG',
                'None',
            ])->nullable();

            $table->enum('dsa', [
                'Need',
                'Not need'
            ])->default('Not need');

            // Store signature image path
            $table->string('signature')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendant_registrations');
    }
};
