<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {

            $table->id();

            $table->string('po_no')->unique();
            $table->string('pr_no')->nullable();

            $table->date('po_date');

            $table->string('supplier_name');

            $table->text('supplier_address')->nullable();

            $table->string('supplier_phone')->nullable();

            $table->text('delivery_address')->nullable();

            $table->date('delivery_date')->nullable();


            $table->string('term_of_payment')->nullable();

            $table->string('mode_of_payment')->nullable();

            $table->string('term_of_delivery')->nullable();


            $table->string('currency', 10)->default('USD');


            $table->decimal('tax_percent', 8, 2)->default(0);

            $table->decimal('other_charges', 15, 2)->default(0);

            $table->string('ordered_by')->nullable();

            $table->date('ordered_date')->nullable();

            $table->string('approved_by')->nullable();

            $table->date('approved_date')->nullable();


            $table->string('vendor_name')->nullable();

            $table->string('vendor_position')->nullable();

            $table->date('vendor_date')->nullable();

            $table->string('vendor_signature')->nullable();

            $table->enum('status', [
                'Draft',
                'Pending',
                'Approved',
                'Rejected',
                'Completed',
                'Cancelled',
            ])->default('Draft');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
