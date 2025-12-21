<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produksi_telurs', function (Blueprint $table) {
            $table->foreignId('kandang_id')->nullable()->after('karyawans_id')->constrained('kandangs')->nullOnDelete();
            $table->integer('jumlah_bagus')->default(0)->after('jumlah');
            $table->integer('jumlah_rusak')->default(0)->after('jumlah_bagus');
            $table->text('catatan')->nullable()->after('jumlah_rusak');
        });
    }

    public function down(): void
    {
        Schema::table('produksi_telurs', function (Blueprint $table) {
            $table->dropForeign(['kandang_id']);
            $table->dropColumn(['kandang_id', 'jumlah_bagus', 'jumlah_rusak', 'catatan']);
        });
    }
};
