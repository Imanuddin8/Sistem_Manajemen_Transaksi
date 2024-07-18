<?php

namespace App\Models;

use App\Models\penjualan;
use App\Models\pembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected  $table = 'produks';

    protected $fillable = ['nama_produk', 'harga_beli', 'harga_jual', 'kategori', 'stok'];

    public function pembelian()
    {
        return $this->hasMany(pembelian::class,);
    }
    public function penjualan()
    {
        return $this->hasMany(penjualan::class);
    }
}
