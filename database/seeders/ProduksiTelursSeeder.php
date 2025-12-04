<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProduksiTelur;
use Carbon\Carbon;

class ProduksiTelursSeeder extends Seeder
{
    public function run(): void
    {
        ProduksiTelur::create([
            'karyawans_id' => 1,
            'tanggal' => Carbon::parse('2025-12-01')->format('Y-m-d'),
            'jumlah' => 120,
            'kualitas' => 'A',
            'keterangan' => 'Produksi pagi',
        ]);

        ProduksiTelur::create([
            'karyawans_id' => 2,
            'tanggal' => Carbon::parse('2025-12-02')->format('Y-m-d'),
            'jumlah' => 100,
            'kualitas' => 'B',
            'keterangan' => 'Produksi siang',
        ]);
    }
}
