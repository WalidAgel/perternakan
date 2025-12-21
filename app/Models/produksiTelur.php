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
        'tanggal',
        'jumlah',
        'kualitas',
        'keterangan'
    ];

    // TAMBAHKAN INI - Cast jumlah sebagai integer
    protected $casts = [
        'jumlah' => 'integer',
        'tanggal' => 'date:Y-m-d',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }
}
