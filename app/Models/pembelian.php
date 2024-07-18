<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\produk;
use Carbon\Carbon;

class pembelian extends Model
{
    use HasFactory;

    protected  $table = 'pembelian';

    protected $fillable = ['produk_id', 'jumlah', 'total', 'metode_pembayaran', 'tanggal', 'user_id', 'catatan'];

    public function produk()
    {
        return $this->belongsTo(produk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
