<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = 'komponens';
    protected $fillable = ['nama_komponen','stok','harga','kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
