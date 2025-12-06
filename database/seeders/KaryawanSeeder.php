<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan user sudah ada
        $users = User::all();

        if ($users->count() === 0) {
            $this->command->error('Tidak ada data user! Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        $karyawans = [];

        foreach ($users as $user) {
            $karyawans[] = [
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'no_hp' => '08' . str_pad($user->id, 10, '1234567890', STR_PAD_RIGHT),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Karyawan::insert($karyawans);

        $this->command->info('✓ Karyawan: ' . count($karyawans) . ' records seeded successfully!');
    }
}
