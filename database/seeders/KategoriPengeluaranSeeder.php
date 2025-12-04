<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriPengeluaran;

class KategoriPengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        KategoriPengeluaran::create([
            'kategoris_id' => 1,
            'karyawans_id' => 2,
            'tanggal' => now(),
            'jumlah' => 250000,
            'deskripsi' => 'Pembelian pakan jagung 50kg'
        ]);

        KategoriPengeluaran::create([
            'kategoris_id' => 2,
            'karyawans_id' => 2,
            'tanggal' => now(),
            'jumlah' => 95000,
            'deskripsi' => 'Vitamin ayam'
        ]);
    }
}
