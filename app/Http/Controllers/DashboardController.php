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

        // Mengembalikan view 'dashboard' dengan data yang telah dihitung
        return view('dashboard', compact('dataP', 'saldoStok', 'totalSales', 'jumlahUser', 'jumlahProduk', 'data', 'totalKeuntungan'));
    }
}
