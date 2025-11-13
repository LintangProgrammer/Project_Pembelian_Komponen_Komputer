<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $fillable = ['kode_pembelian', 'tanggal', 'supplier_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailPembelian::class, 'pembelian_id');
    }

    public function komponen()
    {
        return $this->belongsToMany(Komponen::class, 'detail_pembelian')
                    ->withPivot('jumlah', 'subtotal')
                    ->withTimestamps();
    }
}
