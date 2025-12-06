<?php

namespace Database\Seeders;

use App\Models\ProduksiTelur;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProduksiTelursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan karyawan sudah ada
        $karyawans = Karyawan::where('user_id', '!=', 1)->pluck('id')->toArray(); // Ambil karyawan (bukan admin)

        if (count($karyawans) === 0) {
            $this->command->error('Tidak ada data karyawan! Jalankan KaryawanSeeder terlebih dahulu.');
            return;
        }

        $produksis = [];

        // Generate data produksi 14 hari terakhir
        for ($i = 13; $i >= 0; $i--) {
            // Pilih karyawan secara bergantian dari array karyawan yang ada
            $karyawanId = $karyawans[$i % count($karyawans)];

            $jumlah = rand(95, 135) + (rand(0, 9) / 10); // Random 95.0 - 135.9
            $kualitas = ($jumlah < 105) ? 'B' : 'A'; // Kualitas B jika kurang dari 105kg

            $keterangan = match(true) {
                $jumlah >= 130 => 'Produksi excellent - Kualitas sangat baik',
                $jumlah >= 120 => 'Produksi tinggi - Kualitas baik',
                $jumlah >= 110 => 'Produksi normal',
                $jumlah >= 100 => 'Produksi cukup baik',
                default => 'Produksi menurun - Perlu perhatian'
            };

            $produksis[] = [
                'karyawans_id' => $karyawanId,
                'tanggal' => Carbon::now()->subDays($i)->format('Y-m-d'),
                'jumlah' => round($jumlah, 2),
                'kualitas' => $kualitas,
                'keterangan' => $keterangan,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert semua data sekaligus
        ProduksiTelur::insert($produksis);

        $this->command->info('✓ Produksi Telur: ' . count($produksis) . ' records seeded successfully!');
    }
}
