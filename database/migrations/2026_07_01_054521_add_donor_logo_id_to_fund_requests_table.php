<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fund_requests', function (Blueprint $table) {

            $table->foreignId('donor_logo_id')
                ->nullable()
                ->after('department_id')
                ->constrained('donor_logos')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('fund_requests', function (Blueprint $table) {
            $table->dropForeign(['donor_logo_id']);
            $table->dropColumn('donor_logo_id');
        });
    }
};
