<?php

namespace Database\Seeders;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Database\Seeder;

class DetailPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua penjualan yang ada
        $penjualans = Penjualan::all();

        if ($penjualans->count() === 0) {
            $this->command->error('Tidak ada data penjualan! Jalankan PenjualanSeeder terlebih dahulu.');
            return;
        }

        $details = [];

        foreach ($penjualans as $penjualan) {
            $details[] = [
                'penjualans_id' => $penjualan->id,
                'qty' => round($penjualan->jumlah_terjual),
                'subtotal' => $penjualan->total,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert semua data sekaligus
        DetailPenjualan::insert($details);

        $this->command->info('✓ Detail Penjualan: ' . count($details) . ' records seeded successfully!');
    }
}
