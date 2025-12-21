<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatanKandang extends Model
{
    use HasFactory;

    protected $table = 'pendapatan_kandangs';

    protected $fillable = [
        'kandang_id',
        'produksi_telur_id',
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

    public function produksiTelur()
    {
        return $this->belongsTo(ProduksiTelur::class, 'produksi_telur_id');
    }
}
