<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = 'komponens';
    protected $fillable = ['nama_komponen', 'stok', 'harga', 'id_kategori'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function pembelian()
    {
        return $this->belongsToMany(Pembelian::class, 'pembelian_detail')
                    ->withPivot('jumlah', 'subtotal')
                    ->withTimestamps();
    }
}
