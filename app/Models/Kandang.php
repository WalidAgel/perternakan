<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    use HasFactory;

    protected $table = 'kandangs';

    protected $fillable = [
        'nama_kandang',
        'status'
    ];

    public function operasiKandang()
    {
        return $this->hasMany(OperasiKandang::class, 'kandang_id');
    }

    public function produksiTelur()
    {
        return $this->hasMany(ProduksiTelur::class, 'kandang_id');
    }

    public function pengeluaran()
    {
        return $this->hasMany(KategoriPengeluaran::class, 'kandang_id');
    }

    public function penggunaanPakan()
    {
        return $this->hasMany(PenggunaanPakan::class, 'kandang_id');
    }

    public function pendapatan()
    {
        return $this->hasMany(PendapatanKandang::class, 'kandang_id');
    }
}
