<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Pakan Ayam',
            'deskripsi' => 'Pembelian pakan harian dan bulanan.'
        ]);

        Kategori::create([
            'nama_kategori' => 'Obat & Vitamin',
            'deskripsi' => 'Kebutuhan kesehatan ayam.'
        ]);
    }
}
