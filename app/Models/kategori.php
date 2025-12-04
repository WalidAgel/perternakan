<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];

    public function pengeluaran()
    {
        return $this->hasMany(KategoriPengeluaran::class, 'kategoris_id');
    }
}
