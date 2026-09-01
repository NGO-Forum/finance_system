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
        Schema::table('allowance_forms', function (Blueprint $table) {

            $table->foreignId('attendant_list_id')
                ->nullable()
                ->after('id')
                ->constrained('attendant_lists')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('allowance_forms', function (Blueprint $table) {

            $table->dropForeign([
                'attendant_list_id'
            ]);

            $table->dropColumn('attendant_list_id');
        });
    }
};
