<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduksiTelur extends Model
{
    use HasFactory;

    protected $table = 'produksi_telurs';

    protected $fillable = [
        'karyawans_id',
        'kandang_id',
        'tanggal',
        'jumlah',
        'jumlah_bagus',
        'jumlah_rusak',
        'catatan',
        'kualitas',
        'keterangan'
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'jumlah_bagus' => 'integer',
        'jumlah_rusak' => 'integer',
        'tanggal' => 'date:Y-m-d',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'kandang_id');
    }

    public function pendapatan()
    {
        return $this->hasOne(PendapatanKandang::class, 'produksi_telur_id');
    }
}
