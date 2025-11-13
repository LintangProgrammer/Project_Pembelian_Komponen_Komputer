<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = 'komponen';
    protected $fillable = ['nama_komponen', 'stok', 'harga', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Komponen::class, 'kategori_id');
    }

    public function pembelian()
    {
        return $this->belongsToMany(Pembelian::class, 'pembelian_detail')
                    ->withPivot('jumlah', 'subtotal')
                    ->withTimestamps();
    }
}
