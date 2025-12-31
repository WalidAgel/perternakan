<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Kategori;
use App\Models\KategoriPengeluaran;
use App\Models\ProduksiTelur;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class walidseeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables to avoid duplicate entry
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DetailPenjualan::truncate();
        Penjualan::truncate();
        ProduksiTelur::truncate();
        KategoriPengeluaran::truncate();
        Kategori::truncate();
        Karyawan::truncate();
        User::truncate();
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed Users
        $users = [
            [
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'admin@peternakan.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'Budi Santoso',
                'email' => 'budi@peternakan.com',
                'password' => Hash::make('password'),
                'role' => 'karyawan',
            ],
            [
                'id' => 3,
                'name' => 'Siti Aminah',
                'email' => 'siti@peternakan.com',
                'password' => Hash::make('password'),
                'role' => 'karyawan',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Seed Karyawans
        $karyawans = [
            [
                'id' => 1,
                'user_id' => 1,
                'nama' => 'Administrator',
                'email' => 'admin@peternakan.com',
                'no_hp' => '081123456789',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'nama' => 'Budi Santoso',
                'email' => 'budi@peternakan.com',
                'no_hp' => '082123456789',
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'nama' => 'Siti Aminah',
                'email' => 'siti@peternakan.com',
                'no_hp' => '083123456789',
            ],
        ];

        foreach ($karyawans as $karyawan) {
            Karyawan::create($karyawan);
        }

        // Seed Kategoris
        $kategoris = [
            [
                'id' => 1,
                'nama_kategori' => 'Pakan Ayam',
                'deskripsi' => 'Segala jenis pakan untuk ayam petelur termasuk jagung, konsentrat, dan dedak',
            ],
            [
                'id' => 2,
                'nama_kategori' => 'Obat & Vitamin',
                'deskripsi' => 'Obat-obatan, vitamin, dan suplemen untuk kesehatan ayam',
            ],
            [
                'id' => 3,
                'nama_kategori' => 'Perawatan Kandang',
                'deskripsi' => 'Biaya perbaikan, pembersihan, dan pemeliharaan kandang',
            ],
            [
                'id' => 4,
                'nama_kategori' => 'Utilitas',
                'deskripsi' => 'Biaya listrik, air, dan utilitas lainnya',
            ],
            [
                'id' => 5,
                'nama_kategori' => 'Peralatan',
                'deskripsi' => 'Pembelian dan perawatan peralatan peternakan',
            ],
            [
                'id' => 6,
                'nama_kategori' => 'Lain-lain',
                'deskripsi' => 'Pengeluaran operasional lainnya',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }

        // Seed Kategori Pengeluarans
        $kategoriPengeluarans = [
            ['id' => 1, 'kategoris_id' => 1, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-21', 'jumlah' => 450000.00, 'deskripsi' => 'Pembelian pakan jagung 100kg @ Rp 4.500/kg'],
            ['id' => 2, 'kategoris_id' => 2, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-22', 'jumlah' => 125000.00, 'deskripsi' => 'Vitamin multivitamin 2 botol'],
            ['id' => 3, 'kategoris_id' => 1, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-23', 'jumlah' => 380000.00, 'deskripsi' => 'Pakan konsentrat 80kg @ Rp 4.750/kg'],
            ['id' => 4, 'kategoris_id' => 3, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-24', 'jumlah' => 275000.00, 'deskripsi' => 'Perbaikan sistem ventilasi kandang'],
            ['id' => 5, 'kategoris_id' => 4, 'karyawans_id' => 1, 'kandang_id' => null, 'tanggal' => '2025-12-25', 'jumlah' => 520000.00, 'deskripsi' => 'Pembayaran listrik bulan November'],
            ['id' => 6, 'kategoris_id' => 1, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-26', 'jumlah' => 320000.00, 'deskripsi' => 'Dedak halus 80kg @ Rp 4.000/kg'],
            ['id' => 7, 'kategoris_id' => 2, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-27', 'jumlah' => 95000.00, 'deskripsi' => 'Obat anti stress ayam'],
            ['id' => 8, 'kategoris_id' => 5, 'karyawans_id' => 1, 'kandang_id' => null, 'tanggal' => '2025-12-28', 'jumlah' => 450000.00, 'deskripsi' => 'Pembelian tempat pakan otomatis 5 unit'],
            ['id' => 9, 'kategoris_id' => 1, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-29', 'jumlah' => 425000.00, 'deskripsi' => 'Pakan jagung giling 85kg'],
            ['id' => 10, 'kategoris_id' => 3, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-30', 'jumlah' => 180000.00, 'deskripsi' => 'Desinfektan dan pembersih kandang'],
            ['id' => 11, 'kategoris_id' => 4, 'karyawans_id' => 1, 'kandang_id' => null, 'tanggal' => '2025-12-31', 'jumlah' => 85000.00, 'deskripsi' => 'Pembayaran air PDAM'],
            ['id' => 12, 'kategoris_id' => 6, 'karyawans_id' => 1, 'kandang_id' => null, 'tanggal' => '2025-12-31', 'jumlah' => 150000.00, 'deskripsi' => 'Biaya administrasi dan operasional'],
        ];

        foreach ($kategoriPengeluarans as $pengeluaran) {
            KategoriPengeluaran::create($pengeluaran);
        }

        // Seed Produksi Telurs
        $produksiTelurs = [
            ['id' => 1, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-18', 'jumlah' => 109.10, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi cukup baik'],
            ['id' => 2, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-19', 'jumlah' => 113.50, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi normal'],
            ['id' => 3, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-20', 'jumlah' => 122.60, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi tinggi - Kualitas baik'],
            ['id' => 4, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-21', 'jumlah' => 114.40, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi normal'],
            ['id' => 5, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-22', 'jumlah' => 98.50, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'B', 'keterangan' => 'Produksi menurun - Perlu perhatian'],
            ['id' => 6, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-23', 'jumlah' => 110.70, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi normal'],
            ['id' => 7, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-24', 'jumlah' => 98.80, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'B', 'keterangan' => 'Produksi menurun - Perlu perhatian'],
            ['id' => 8, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-25', 'jumlah' => 116.10, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi normal'],
            ['id' => 9, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-26', 'jumlah' => 95.20, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'B', 'keterangan' => 'Produksi menurun - Perlu perhatian'],
            ['id' => 10, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-27', 'jumlah' => 131.50, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi excellent - Kualitas sangat baik'],
            ['id' => 11, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-28', 'jumlah' => 120.80, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi tinggi - Kualitas baik'],
            ['id' => 12, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-29', 'jumlah' => 133.60, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi excellent - Kualitas sangat baik'],
            ['id' => 13, 'karyawans_id' => 3, 'kandang_id' => null, 'tanggal' => '2025-12-30', 'jumlah' => 107.90, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi cukup baik'],
            ['id' => 14, 'karyawans_id' => 2, 'kandang_id' => null, 'tanggal' => '2025-12-31', 'jumlah' => 132.70, 'jumlah_bagus' => 0, 'jumlah_rusak' => 0, 'catatan' => null, 'kualitas' => 'A', 'keterangan' => 'Produksi excellent - Kualitas sangat baik'],
        ];

        foreach ($produksiTelurs as $produksi) {
            ProduksiTelur::create($produksi);
        }

        // Seed Penjualans
        $penjualans = [
            ['id' => 1, 'produks_id' => 1, 'tanggal' => '2025-12-19', 'jumlah_terjual' => 52.30, 'harga_per_kg' => 27400.00, 'total' => 1433020.00],
            ['id' => 2, 'produks_id' => 2, 'tanggal' => '2025-12-20', 'jumlah_terjual' => 49.70, 'harga_per_kg' => 28400.00, 'total' => 1411480.00],
            ['id' => 3, 'produks_id' => 3, 'tanggal' => '2025-12-21', 'jumlah_terjual' => 80.50, 'harga_per_kg' => 28000.00, 'total' => 2254000.00],
            ['id' => 4, 'produks_id' => 4, 'tanggal' => '2025-12-22', 'jumlah_terjual' => 75.20, 'harga_per_kg' => 27500.00, 'total' => 2068000.00],
            ['id' => 5, 'produks_id' => 5, 'tanggal' => '2025-12-23', 'jumlah_terjual' => 46.10, 'harga_per_kg' => 28600.00, 'total' => 1318460.00],
            ['id' => 6, 'produks_id' => 6, 'tanggal' => '2025-12-24', 'jumlah_terjual' => 75.90, 'harga_per_kg' => 28400.00, 'total' => 2155560.00],
            ['id' => 7, 'produks_id' => 7, 'tanggal' => '2025-12-25', 'jumlah_terjual' => 53.90, 'harga_per_kg' => 27200.00, 'total' => 1466080.00],
            ['id' => 8, 'produks_id' => 8, 'tanggal' => '2025-12-26', 'jumlah_terjual' => 65.00, 'harga_per_kg' => 27000.00, 'total' => 1755000.00],
            ['id' => 9, 'produks_id' => 9, 'tanggal' => '2025-12-27', 'jumlah_terjual' => 48.50, 'harga_per_kg' => 28600.00, 'total' => 1387100.00],
            ['id' => 10, 'produks_id' => 10, 'tanggal' => '2025-12-28', 'jumlah_terjual' => 74.70, 'harga_per_kg' => 27900.00, 'total' => 2084130.00],
            ['id' => 11, 'produks_id' => 11, 'tanggal' => '2025-12-29', 'jumlah_terjual' => 61.20, 'harga_per_kg' => 28500.00, 'total' => 1744200.00],
            ['id' => 12, 'produks_id' => 12, 'tanggal' => '2025-12-30', 'jumlah_terjual' => 61.20, 'harga_per_kg' => 27500.00, 'total' => 1683000.00],
        ];

        foreach ($penjualans as $penjualan) {
            Penjualan::create($penjualan);
        }

        // Seed Detail Penjualans
        $detailPenjualans = [
            ['id' => 1, 'penjualans_id' => 1, 'qty' => 52, 'subtotal' => 1433020.00],
            ['id' => 2, 'penjualans_id' => 2, 'qty' => 50, 'subtotal' => 1411480.00],
            ['id' => 3, 'penjualans_id' => 3, 'qty' => 81, 'subtotal' => 2254000.00],
            ['id' => 4, 'penjualans_id' => 4, 'qty' => 75, 'subtotal' => 2068000.00],
            ['id' => 5, 'penjualans_id' => 5, 'qty' => 46, 'subtotal' => 1318460.00],
            ['id' => 6, 'penjualans_id' => 6, 'qty' => 76, 'subtotal' => 2155560.00],
            ['id' => 7, 'penjualans_id' => 7, 'qty' => 54, 'subtotal' => 1466080.00],
            ['id' => 8, 'penjualans_id' => 8, 'qty' => 65, 'subtotal' => 1755000.00],
            ['id' => 9, 'penjualans_id' => 9, 'qty' => 49, 'subtotal' => 1387100.00],
            ['id' => 10, 'penjualans_id' => 10, 'qty' => 75, 'subtotal' => 2084130.00],
            ['id' => 11, 'penjualans_id' => 11, 'qty' => 61, 'subtotal' => 1744200.00],
            ['id' => 12, 'penjualans_id' => 12, 'qty' => 61, 'subtotal' => 1683000.00],
        ];

        foreach ($detailPenjualans as $detail) {
            DetailPenjualan::create($detail);
        }
    }
}