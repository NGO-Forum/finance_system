<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {

            $table->decimal('service_charge', 15, 2)
                ->default(0)
                ->after('currency');

            $table->decimal('other_tax_charge', 15, 2)
                ->default(0)
                ->after('service_charge');
        });
    }

    public function down(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {

            $table->dropColumn([
                'service_charge',
                'other_tax_charge',
            ]);
        });
    }
};
