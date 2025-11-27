<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'details_pembelians';
    protected $fillable = ['pembelian_id', 'komponen_id', 'jumlah', 'subtotal'];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }
    public function komponen()
    {
        return $this->belongsTo(Komponen::class,'id_komponen');
    }
}
