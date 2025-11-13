<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'detail_pembelian';
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
