<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendant_registrations', function (Blueprint $table) {

            $table->enum('dsa_status', [
                'Pending',
                'Approved',
                'Rejected',
            ])
                ->default('Pending')
                ->after('dsa');

            $table->foreignId('dsa_approved_by')
                ->nullable()
                ->after('dsa_status')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('dsa_approved_at')
                ->nullable()
                ->after('dsa_approved_by');

            $table->text('dsa_rejection_reason')
                ->nullable()
                ->after('dsa_approved_at');
        });
    }

    public function down(): void
    {
        Schema::table('attendant_registrations', function (Blueprint $table) {

            $table->dropForeign([
                'dsa_approved_by',
            ]);

            $table->dropColumn([
                'dsa_status',
                'dsa_approved_by',
                'dsa_approved_at',
                'dsa_rejection_reason',
            ]);
        });
    }
};
