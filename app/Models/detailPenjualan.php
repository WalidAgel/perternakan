<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailPenjualan extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualan';
    protected $fillable = ['penjualan_id', 'qty', 'subtotal'];


    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
