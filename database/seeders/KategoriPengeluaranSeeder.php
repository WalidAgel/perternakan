<?php

namespace Database\Seeders;

use App\Models\KategoriPengeluaran;
use App\Models\Karyawan;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KategoriPengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan karyawan dan kategori sudah ada
        $karyawans = Karyawan::pluck('id')->toArray();
        $totalKategori = Kategori::count();

        if (count($karyawans) === 0) {
            $this->command->error('Tidak ada data karyawan! Jalankan KaryawanSeeder terlebih dahulu.');
            return;
        }

        if ($totalKategori === 0) {
            $this->command->error('Tidak ada data kategori! Jalankan KategoriSeeder terlebih dahulu.');
            return;
        }

        // Ambil kategori berdasarkan nama untuk memastikan ID yang benar
        $pakanAyam = Kategori::where('nama_kategori', 'Pakan Ayam')->first();
        $obatVitamin = Kategori::where('nama_kategori', 'Obat & Vitamin')->first();
        $perawatanKandang = Kategori::where('nama_kategori', 'Perawatan Kandang')->first();
        $utilitas = Kategori::where('nama_kategori', 'Utilitas')->first();
        $peralatan = Kategori::where('nama_kategori', 'Peralatan')->first();
        $lainLain = Kategori::where('nama_kategori', 'Lain-lain')->first();

        // Validasi semua kategori ada
        if (!$pakanAyam || !$obatVitamin || !$perawatanKandang || !$utilitas || !$peralatan || !$lainLain) {
            $this->command->error('Kategori tidak lengkap! Pastikan semua kategori tersedia.');
            return;
        }

        $pengeluarans = [
            // Pengeluaran minggu lalu
            [
                'kategoris_id' => $pakanAyam->id,
                'karyawans_id' => $karyawans[1] ?? $karyawans[0],
                'tanggal' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'jumlah' => 450000,
                'deskripsi' => 'Pembelian pakan jagung 100kg @ Rp 4.500/kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $obatVitamin->id,
                'karyawans_id' => $karyawans[2] ?? $karyawans[0],
                'tanggal' => Carbon::now()->subDays(9)->format('Y-m-d'),
                'jumlah' => 125000,
                'deskripsi' => 'Vitamin multivitamin 2 botol',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $pakanAyam->id,
                'karyawans_id' => $karyawans[1] ?? $karyawans[0],
                'tanggal' => Carbon::now()->subDays(8)->format('Y-m-d'),
                'jumlah' => 380000,
                'deskripsi' => 'Pakan konsentrat 80kg @ Rp 4.750/kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $perawatanKandang->id,
                'karyawans_id' => $karyawans[1] ?? $karyawans[0],
                'tanggal' => Carbon::now()->subDays(7)->format('Y-m-d'),
                'jumlah' => 275000,
                'deskripsi' => 'Perbaikan sistem ventilasi kandang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $utilitas->id,
                'karyawans_id' => $karyawans[0],
                'tanggal' => Carbon::now()->subDays(6)->format('Y-m-d'),
                'jumlah' => 520000,
                'deskripsi' => 'Pembayaran listrik bulan November',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Pengeluaran minggu ini
            [
                'kategoris_id' => $pakanAyam->id,
                'karyawans_id' => $karyawans[2] ?? $karyawans[0],
                'tanggal' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'jumlah' => 320000,
                'deskripsi' => 'Dedak halus 80kg @ Rp 4.000/kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $obatVitamin->id,
                'karyawans_id' => $karyawans[1] ?? $karyawans[0],
                'tanggal' => Carbon::now()->subDays(4)->format('Y-m-d'),
                'jumlah' => 95000,
                'deskripsi' => 'Obat anti stress ayam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $peralatan->id,
                'karyawans_id' => $karyawans[0],
                'tanggal' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'jumlah' => 450000,
                'deskripsi' => 'Pembelian tempat pakan otomatis 5 unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $pakanAyam->id,
                'karyawans_id' => $karyawans[2] ?? $karyawans[0],
                'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'jumlah' => 425000,
                'deskripsi' => 'Pakan jagung giling 85kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $perawatanKandang->id,
                'karyawans_id' => $karyawans[1] ?? $karyawans[0],
                'tanggal' => Carbon::now()->subDay()->format('Y-m-d'),
                'jumlah' => 180000,
                'deskripsi' => 'Desinfektan dan pembersih kandang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $utilitas->id,
                'karyawans_id' => $karyawans[0],
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'jumlah' => 85000,
                'deskripsi' => 'Pembayaran air PDAM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategoris_id' => $lainLain->id,
                'karyawans_id' => $karyawans[0],
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'jumlah' => 150000,
                'deskripsi' => 'Biaya administrasi dan operasional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        KategoriPengeluaran::insert($pengeluarans);

        $this->command->info('✓ Kategori Pengeluaran: ' . count($pengeluarans) . ' records seeded successfully!');
    }
}
