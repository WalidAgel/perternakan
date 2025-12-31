<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->foreignId('produks_id')
                ->nullable()
                ->after('id')
                ->constrained('produksi_telurs')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->dropForeign(['produks_id']);
            $table->dropColumn('produks_id');
        });
    }
};