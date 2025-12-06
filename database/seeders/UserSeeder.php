<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@peternakan.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@peternakan.com',
                'password' => Hash::make('karyawan123'),
                'role' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@peternakan.com',
                'password' => Hash::make('karyawan123'),
                'role' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        User::insert($users);

        $this->command->info('✓ Users: ' . count($users) . ' records seeded successfully!');
    }
}
