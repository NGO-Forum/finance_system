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
        Schema::create('goods_received_notes', function (Blueprint $table) {

            $table->id();

            $table->string('grn_no')->unique();

            $table->date('grn_date');

            $table->string('supplier_name');

            $table->text('supplier_address')->nullable();

            $table->string('supplier_tel')->nullable();

            $table->string('po_no')->nullable();

            $table->string('vendor_invoice_no')->nullable();

            $table->string('delivery_note_no')->nullable();

            $table->string('delivered_by')->nullable();

            $table->date('delivered_date')->nullable();

            $table->time('delivered_time')->nullable();

            $table->string('received_by')->nullable();

            $table->date('received_date')->nullable();

            $table->time('received_time')->nullable();

            $table->string('inspected_by')->nullable();

            $table->date('inspected_date')->nullable();

            $table->time('inspected_time')->nullable();

            $table->text('comments')->nullable();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_received_notes');
    }
};
