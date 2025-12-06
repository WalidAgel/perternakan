<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Pakan Ayam',
                'deskripsi' => 'Segala jenis pakan untuk ayam petelur termasuk jagung, konsentrat, dan dedak',
            ],
            [
                'nama_kategori' => 'Obat & Vitamin',
                'deskripsi' => 'Obat-obatan, vitamin, dan suplemen untuk kesehatan ayam',
            ],
            [
                'nama_kategori' => 'Perawatan Kandang',
                'deskripsi' => 'Biaya perbaikan, pembersihan, dan pemeliharaan kandang',
            ],
            [
                'nama_kategori' => 'Utilitas',
                'deskripsi' => 'Biaya listrik, air, dan utilitas lainnya',
            ],
            [
                'nama_kategori' => 'Peralatan',
                'deskripsi' => 'Pembelian dan perawatan peralatan peternakan',
            ],
            [
                'nama_kategori' => 'Lain-lain',
                'deskripsi' => 'Pengeluaran operasional lainnya',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }

        $this->command->info('✓ Kategori: ' . count($kategoris) . ' records seeded successfully!');
    }
}
