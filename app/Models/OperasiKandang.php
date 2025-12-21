<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperasiKandang extends Model
{
    use HasFactory;

    protected $table = 'operasi_kandangs';

    protected $fillable = [
        'kandang_id',
        'jumlah_ayam',
        'tanggal_mulai_produksi',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai_produksi' => 'date'
    ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'kandang_id');
    }
}
