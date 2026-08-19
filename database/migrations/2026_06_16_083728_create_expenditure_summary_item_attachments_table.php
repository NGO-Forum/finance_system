<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'expenditure_summary_item_attachments',
            function (Blueprint $table) {

                $table->id();

                $table->unsignedBigInteger(
                    'expenditure_summary_item_id'
                );

                $table->foreign(
                    'expenditure_summary_item_id',
                    'esi_attachment_fk'
                )
                    ->references('id')
                    ->on('expenditure_summary_items')
                    ->cascadeOnDelete();

                $table->string('file');

                $table->string('original_name');

                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'expenditure_summary_item_attachments'
        );
    }
};
