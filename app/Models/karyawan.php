<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'nama', 'email', 'no_hp'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produksiTelur()
    {
        return $this->hasMany(ProduksiTelur::class);
    }
    public function kategoriPengeluaran()
    {
        return $this->hasMany(KategoriPengeluaran::class);
    }
}
