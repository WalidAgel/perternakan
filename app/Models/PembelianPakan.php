<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianPakan extends Model
{
    use HasFactory;

    protected $table = 'pembelian_pakans';

    protected $fillable = [
        'pakan_id',
        'karyawans_id',
        'tanggal',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2'
    ];

    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'pakan_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }
}
