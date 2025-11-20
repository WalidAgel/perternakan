<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriPengeluaran extends Model
{
    use HasFactory;
    protected $table = 'kategori_pengeluaran';
    protected $fillable = ['kategori_id', 'karyawan_id', 'tanggal', 'jumlah', 'deskripsi'];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
