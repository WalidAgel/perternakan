<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakan extends Model
{
    use HasFactory;

    protected $table = 'pakans';

    protected $fillable = [
        'nama_pakan',
        'harga_pakan',
        'stok'
    ];

    protected $casts = [
        'harga_pakan' => 'decimal:2',
        'stok' => 'decimal:2'
    ];

    public function pembelian()
    {
        return $this->hasMany(PembelianPakan::class, 'pakan_id');
    }

    public function penggunaan()
    {
        return $this->hasMany(PenggunaanPakan::class, 'pakan_id');
    }
}
