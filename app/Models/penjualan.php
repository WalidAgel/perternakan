<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'produks_id',
        'tanggal',
        'harga_per_kg',
        'jumlah_terjual', // Sesuai dengan migration
        'total'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'harga_per_kg' => 'decimal:2',
        'jumlah_terjual' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    // Sesuaikan nama method dengan penggunaan di view
    public function produksiTelur()
    {
        return $this->belongsTo(ProduksiTelur::class, 'produks_id');
    }
}
