<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produksiTelur extends Model
{
    use HasFactory;
    protected $table = 'produksi_telurs';
    protected $fillable = ['karyawan_id', 'tanggal', 'jumlah', 'kualitas', 'keterangan'];


    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }
}
