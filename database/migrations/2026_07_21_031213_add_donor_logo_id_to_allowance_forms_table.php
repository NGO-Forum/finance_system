<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('allowance_forms', function (Blueprint $table) {

            $table->foreignId('donor_logo_id')
                ->nullable()
                ->after('venue')
                ->constrained('donor_logos')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('allowance_forms', function (Blueprint $table) {

            $table->dropConstrainedForeignId('donor_logo_id');
        });
    }
};
