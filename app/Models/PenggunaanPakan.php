<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanPakan extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_pakans';

    protected $fillable = [
        'kandang_id',
        'pakan_id',
        'karyawans_id',
        'tanggal',
        'jumlah',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2'
    ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'kandang_id');
    }

    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'pakan_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }
}
