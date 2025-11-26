<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
class Pembelian extends Model
{
    protected $table = 'pembelians';
    protected $fillable = [
        'kode_pembelian',
        'tanggal',
        'supplier_id',
        'jumlah',
    ];

public function komponen()
{
    return $this->belongsToMany(Komponen::class, 'detail_pembelians', 'pembelian_id', 'komponen_id')
                ->withPivot('jumlah', 'subtotal');
}


    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
