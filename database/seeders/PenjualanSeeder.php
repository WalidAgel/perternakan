<?php

namespace Database\Seeders;

use App\Models\Penjualan;
use App\Models\ProduksiTelur;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua produksi telur yang ada
        $produksiTelurs = ProduksiTelur::orderBy('tanggal', 'asc')->get();

        if ($produksiTelurs->count() === 0) {
            $this->command->error('Tidak ada data produksi telur! Jalankan ProduksiTelurSeeder terlebih dahulu.');
            return;
        }

        $penjualans = [];

        // Buat penjualan untuk 12 produksi pertama
        foreach ($produksiTelurs->take(12) as $index => $produksi) {
            // Jumlah terjual 40-70% dari jumlah produksi
            $persentaseTerjual = rand(40, 70) / 100;
            $jumlahTerjual = round($produksi->jumlah * $persentaseTerjual, 1);

            // Harga bervariasi Rp 27.000 - 29.000
            $hargaPerKg = rand(270, 290) * 100;

            $total = $jumlahTerjual * $hargaPerKg;

            $penjualans[] = [
                'produks_id' => $produksi->id,
                'tanggal' => Carbon::parse($produksi->tanggal)->addDay()->format('Y-m-d'),
                'jumlah_terjual' => $jumlahTerjual,
                'harga_per_kg' => $hargaPerKg,
                'total' => $total,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert semua data sekaligus
        Penjualan::insert($penjualans);

        $this->command->info('✓ Penjualan: ' . count($penjualans) . ' records seeded successfully!');
    }
}
