<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penjualan;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        Penjualan::create([
            'produks_id' => 1,
            'tanggal' => now(),
            'jumlah_terjual' => 50,
            'harga_per_kg' => 28000,
            'total' => 1400000,
        ]);

        Penjualan::create([
            'produks_id' => 2,
            'tanggal' => now(),
            'jumlah_terjual' => 40,
            'harga_per_kg' => 27500,
            'total' => 1100000,
        ]);
    }
}
