<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendapatan_kandangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kandang_id')->constrained('kandangs')->cascadeOnDelete();
            $table->foreignId('produksi_telur_id')->nullable()->constrained('produksi_telurs')->nullOnDelete();
            $table->date('tanggal');
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendapatan_kandangs');
    }
};
