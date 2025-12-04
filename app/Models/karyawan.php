<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'no_hp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengeluaran()
    {
        return $this->hasMany(KategoriPengeluaran::class, 'karyawans_id');
    }

    public function produksiTelur()
    {
        return $this->hasMany(ProduksiTelur::class, 'karyawans_id');
    }
}
