<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        Karyawan::create([
            'user_id' => 1,
            'nama' => 'Admin User',
            'email' => 'admin@gmail.com',
            'no_hp' => '081234567890',
        ]);

        Karyawan::create([
            'user_id' => 2,
            'nama' => 'User',
            'email' => 'user@gmail.com',
            'no_hp' => '089876543210',
        ]);
    }
}
