<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = ['produk_id', 'tanggal', 'jumlah_terjual', 'harga_per_kg', 'total'];


    public function produk()
    {
        return $this->belongsTo(ProduksiTelur::class, 'produk_id');
    }
    public function details()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
}
