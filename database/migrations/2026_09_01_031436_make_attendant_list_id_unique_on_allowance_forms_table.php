<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('allowance_forms', function (Blueprint $table) {
            $table->unique(
                'attendant_list_id',
                'allowance_forms_attendant_list_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('allowance_forms', function (Blueprint $table) {
            $table->dropUnique(
                'allowance_forms_attendant_list_unique'
            );
        });
    }
};
