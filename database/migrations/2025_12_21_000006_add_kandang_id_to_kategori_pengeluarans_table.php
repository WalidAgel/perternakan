<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategori_pengeluarans', function (Blueprint $table) {
            $table->foreignId('kandang_id')->nullable()->after('karyawans_id')->constrained('kandangs')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kategori_pengeluarans', function (Blueprint $table) {
            $table->dropForeign(['kandang_id']);
            $table->dropColumn('kandang_id');
        });
    }
};
