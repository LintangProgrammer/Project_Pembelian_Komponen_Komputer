<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\DetailPembelian;
class Pembelian extends Model
{
    protected $table = 'pembelians';
    protected $fillable = [
        'kode_pembelian',
        'tanggal',
        'supplier_id'
        
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function detailpembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'pembelian_id');
    }

    public function komponen()
    {
        return $this->hasMany(DetailPembelian::class, 'pembelian_id');
    }
}