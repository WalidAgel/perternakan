<?php

namespace Database\Seeders;

use App\Models\DetailPenjualan;
use Illuminate\Database\Seeder;

class DetailPenjualanSeeder extends Seeder
{
    public function run(): void
    {
        DetailPenjualan::create([
            'penjualans_id' => 1,
            'qty' => 50,
            'subtotal' => 1400000
        ]);

        DetailPenjualan::create([
            'penjualans_id' => 2,
            'qty' => 40,
            'subtotal' => 1100000
        ]);
    }
}
