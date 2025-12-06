<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables
        DB::table('detail_penjualans')->truncate();
        DB::table('penjualans')->truncate();
        DB::table('kategori_pengeluarans')->truncate();
        DB::table('produksi_telurs')->truncate();
        DB::table('kategoris')->truncate();
        DB::table('karyawans')->truncate();
        DB::table('users')->truncate();

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Jalankan seeder dengan urutan yang benar
        $this->call([
            UserSeeder::class,
            KaryawanSeeder::class,
            KategoriSeeder::class,
            ProduksiTelursSeeder::class,
            KategoriPengeluaranSeeder::class,
            PenjualanSeeder::class,
            DetailPenjualanSeeder::class,
        ]);

        $this->command->info('🎉 Database seeding completed successfully!');
    }
}
