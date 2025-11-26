<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Pembelian extends Model
{
    protected $fillable = ['pembelian_id', 'komponen_id', 'jumlah', 'subtotal'];
    public function komponen()
    {
        return $this->belongsToMany(Komponen::class, 'komponen_id');
    }
}
