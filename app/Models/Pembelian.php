<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\Detail_pembelian;

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
        return $this->belongsTo(Supplier::class);
    }

    public function detail_pembelian()
    {
        return $this->hasMany(Detail_pembelian::class);
    }
}
