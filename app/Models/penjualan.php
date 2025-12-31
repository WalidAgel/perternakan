<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';

    protected $fillable = [
        'kandang_id',
        'tanggal',
        'harga_per_kg',
        'jumlah_terjual',
        'total'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'harga_per_kg' => 'decimal:2',
        'jumlah_terjual' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    // Relasi ke kandang
    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'kandang_id');
    }
}