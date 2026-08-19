<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fund_requests', function (Blueprint $table) {
            $table->dropForeign(['donor_logo_id']);
            $table->dropColumn('donor_logo_id');
        });
    }

    public function down()
    {
        Schema::table('fund_requests', function (Blueprint $table) {
            $table->foreignId('donor_logo_id')
                ->nullable()
                ->constrained('donor_logos')
                ->nullOnDelete();
        });
    }
};
