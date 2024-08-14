<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class penjualan extends Model
{
    use HasFactory;

    protected  $table = 'penjualan';

    protected $fillable = ['produk_id', 'no', 'struk', 'jumlah', 'total', 'keuntungan','metode_pembayaran', 'tanggal', 'user_id', 'catatan'];

    public function produk()
    {
        return $this->belongsTo(produk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
