<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotation_analyses', function (Blueprint $table) {

            $table->foreignId('recommended_supplier_id')
                ->nullable()
                ->after('quantity')
                ->constrained('quotation_analysis_suppliers')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('quotation_analyses', function (Blueprint $table) {

            $table->dropConstrainedForeignId('recommended_supplier_id');
        });
    }
};
