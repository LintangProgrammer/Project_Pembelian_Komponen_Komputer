<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_pembelian extends Model
{
    protected $table = 'detail_pembelians';
    protected $fillable = ['pembelian_id', 'komponen_id', 'jumlah', 'subtotal'];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }

    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'komponen_id');
    }
}
