<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualan;
use App\Models\produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua data user dan produk
        $penjualan = penjualan::all();
        $user = User::all();
        $produk = produk::all();

        // Mengambil data produk dengan nama 'saldo'
        $saldoProduk = produk::where('nama_produk', 'saldo')->first();

        // Jika produk dengan nama 'saldo' ada, ambil stoknya, jika tidak set stok menjadi 0
        $saldoStok = $saldoProduk ? $saldoProduk->stok : 0;

        // Mengambil tanggal hari ini
        $today = Carbon::today();

        // Mengambil data penjualan
        $data = DB::table('penjualan')->get();

        // Menghitung total penjualan hari ini
        $totalSales = DB::table('penjualan')->whereDate('tanggal', $today)->count();

        $totalKeuntungan = DB::table('penjualan')->whereDate('tanggal', $today)->sum('keuntungan');

        // Menghitung total jumlah user
        $jumlahUser = $user->count();

        // Menghitung total jumlah produk
        $jumlahProduk = $produk->count();

        // Ambil data keuntungan per bulan
        $profits = penjualan::selectRaw('SUM(keuntungan) as total, MONTH(tanggal) as month')
            ->whereYear('tanggal', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Inisialisasi array untuk setiap bulan
        $dataP = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataP[$i] = 0; // Default 0 jika bulan tidak ada datanya
        }

        // Isi array dengan data dari database
        foreach ($profits as $profit) {
            $dataP[$profit->month] = $profit->total;
        }

        // Ambil produk dengan jumlah penjualan terbanyak per bulan
        $transaksi = penjualan::selectRaw('produk_id, COUNT(*) as total, MONTH(tanggal) as month')
            ->whereYear('tanggal', Carbon::now()->year)
            ->groupBy('month', 'produk_id')
            ->orderBy('total', 'desc')
            ->get()
            ->groupBy('month')
            ->map(function ($item) {
                return $item->first(); // Ambil produk dengan penjualan terbanyak
            });

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[$i] = ['produk_id' => null, 'total' => 0]; // Default null jika bulan tidak ada datanya
        }

        // Isi array dengan data dari database
        foreach ($transaksi as $month => $trk) {
            $data[$month] = ['produk_id' => $trk->produk_id, 'total' => $trk->total];
        }

        // Mengambil nama produk berdasarkan produk_id
        $productNames = produk::whereIn('id', array_column($data, 'produk_id'))
            ->pluck('nama_produk', 'id');

        // Mengembalikan view 'dashboard' dengan data yang telah dihitung
        return view('dashboard', compact('productNames', 'dataP', 'data', 'saldoStok', 'totalSales', 'jumlahUser', 'jumlahProduk', 'data', 'totalKeuntungan'));
    }
}
