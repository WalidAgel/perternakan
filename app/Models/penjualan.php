<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProduksiTelur;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';

    protected $fillable = [
        'produksi_id',
        'tanggal',
        'jumlah_terjual',
        'harga_per_kg',
        'total'
    ];

    // RELASI WAJIB ADA UNTUK MENGHINDARI ERROR
    public function produksiTelur()
    {
        return $this->belongsTo(ProduksiTelur::class, 'produksi_id');
    }
}
