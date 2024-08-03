<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use App\Models\produk;
use App\Models\User;
use App\Http\Requests\StorepenjualanRequest;
use App\Http\Requests\UpdatepenjualanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Alert;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data penjualan dan mengurutkannya berdasarkan waktu pembuatan secara descending (terbaru ke terlama)
        $penjualan = penjualan::orderBy('created_at', 'desc')->get();

        // Mengambil semua data produk dan user dari database
        $produk = produk::all();
        $user = User::all();

        // Mengembalikan view 'penjualan.penjualan' dengan data penjualan, produk, dan user yang telah diambil
        return view('penjualan.penjualan', compact('penjualan', 'produk', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua data penjualan, produk, dan user dari database
        $penjualan = penjualan::all();
        $produk = produk::where('nama_produk', '!=', 'saldo')->get();
        $user = User::all();

        // Mengembalikan view 'penjualan.create' dengan data produk, penjualan, dan user yang telah diambil
        return view('penjualan.create', compact('penjualan', 'produk', 'user'));
    }

    public function store(Request $request)
    {
        // Mengambil semua data produk dan user dari database
        $user = User::all();
        // Ambil semua produk kecuali yang namanya 'Saldo'
        $produk = produk::all();

        // Ambil data dari request
        $produkIds = $request->produk_id;
        $jumlahs = $request->jumlah;
        $noList = $request->no;
        $metode_pembayaran = $request->metode_pembayaran;
        $tanggal = $request->tanggal;
        $catatan = $request->catatan ? $request->catatan : '-';

        // Validasi panjang array produk_id dan jumlah
        if (count($produkIds) !== count($jumlahs) || count($produkIds) !== count($noList)) {
            Alert::toast('Data produk, jumlah dan no tidak sesuai!', 'error');
            return redirect()->back()->withInput();
        }

        // Proses setiap produk
        foreach ($produkIds as $index => $produkId) {
            $jumlah = str_replace('.', '', $jumlahs[$index]); // Hapus titik ribuan dari input jumlah
            $selectedProduct = Produk::find($produkId);

            // Cek stok produk sebelum melakukan penjualan
            if ($selectedProduct->stok < $jumlah) {
                Alert::toast("Stok produk {$selectedProduct->nama_produk} tidak mencukupi untuk transaksi ini!", 'error');
                return redirect()->back()->withInput();
            }

            // Hitung total berdasarkan kategori produk
            if ($selectedProduct->kategori == 'saldo') {
                $total = $jumlah + $selectedProduct->harga_jual;
                // Kurangi stok untuk semua produk dengan kategori 'saldo'
                Produk::where('kategori', 'saldo')->decrement('stok', $jumlah);
                // Set keuntungan ke harga_jual untuk produk kategori 'saldo'
                $keuntungan = $selectedProduct->harga_jual;
            } else {
                $total = $jumlah * $selectedProduct->harga_jual;
                // Kurangi stok untuk produk yang bukan kategori 'saldo'
                $selectedProduct->decrement('stok', $jumlah);
                // Set keuntungan ke harga_jual - harga_beli untuk produk yang bukan kategori 'saldo'
                $keuntungan = ($selectedProduct->harga_jual - $selectedProduct->harga_beli) * $jumlah;
            }

            // Simpan perubahan stok produk
            $selectedProduct->save();

            // Memeriksa apakah catatan kosong, jika ya, diisi dengan tanda strip (-)
            $catatan = $request->catatan ? $request->catatan : '-';

            // Memeriksa apakah nomor kosong, jika ya, diisi dengan tanda strip (-)
            $no = $noList[$index] ?? '-';

            // Simpan data penjualan
            Penjualan::create([
                'produk_id' => $produkId,
                'jumlah' => $jumlah,
                'total' => $total,
                'keuntungan' => $keuntungan,
                'no' => $no,
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal' => Carbon::now(),
                'user_id' => Auth::id(),
                'catatan' => $catatan,
            ]);
        }

        Alert::toast('Transaksi penjualan berhasil ditambahkan!', 'success');
        return redirect()->route('penjualan');
    }

    public function edit($id)
    {
        // Mengambil data penjualan berdasarkan ID yang diberikan.
        $penjualan = penjualan::findOrFail($id);

        // Mengambil semua data produk dan user dari database.
        $user = User::all();
        $produk = produk::where('nama_produk', '!=', 'saldo')->get();

        // Mengembalikan view 'penjualan.update' dengan variabel 'produk', 'penjualan', dan 'user'.
        return view('penjualan.update', compact('produk','penjualan', 'user'));
    }

    public function update(Request $request, $id)
    {
        // Mengambil data penjualan berdasarkan ID yang diberikan.
        $penjualan = penjualan::findOrFail($id);

        // Mengambil semua data produk dan user dari database.
        $user = User::all();
        $produk = produk::all();

        // Hapus titik ribuan dari input jumlah
        $jumlah = str_replace('.', '', $request->jumlah);

        // Ambil produk berdasarkan produk_id dari request
        $selectedProduct = produk::find($request->produk_id);

        // Cek stok produk sebelum melakukan penjualan
        if ($selectedProduct->stok < $jumlah) {
            Alert::toast('Stok produk tidak mencukupi untuk transaksi ini!','error');
            return redirect()->back()->withInput();
            // return redirect()->back()->with('toast_error', 'Stok produk tidak mencukupi untuk transaksi ini')->withInput();
        }

         // Hitung total berdasarkan kategori produk
        if ($selectedProduct->kategori == 'saldo') {
            $total = $jumlah + 2000;
            // Kurangi stok untuk semua produk dengan kategori 'saldo'
            produk::where('kategori', 'saldo')->increment('stok', $penjualan->jumlah); // Kembalikan stok sebelumnya
            produk::where('kategori', 'saldo')->decrement('stok', $jumlah); // Kurangi stok baru
            // Set keuntungan ke harga_jual untuk produk kategori 'saldo'
            $keuntungan = $selectedProduct->harga_jual;
        } else {
            $total = $jumlah * $selectedProduct->harga_jual;
            // Kurangi stok untuk produk yang bukan kategori 'saldo'
            $selectedProduct->increment('stok', $penjualan->jumlah); // Kembalikan stok sebelumnya
            $selectedProduct->decrement('stok', $jumlah); // Kurangi stok baru
            // Set keuntungan ke harga_jual - harga_beli untuk produk yang bukan kategori 'saldo'
            $keuntungan = ($selectedProduct->harga_jual - $selectedProduct->harga_beli) * $jumlah;
        }

        // Simpan perubahan stok produk
        $selectedProduct->save();

        // Mengupdate data penjualan di database dengan menggunakan model penjualan
        $penjualan->update([
            'produk_id' => $request->produk_id, // Menyimpan produk_id yang dikirim melalui request
            'no' => $request->no,               // Menyimpan no penjualan yang dikirim melalui request
            'jumlah' => $jumlah,                // Menyimpan jumlah penjualan yang telah diproses sebelumnya
            'total' => $total,                  // Menyimpan total harga penjualan yang telah dihitung sebelumnya
            'keuntungan' => $keuntungan,
            'metode_pembayaran' => $request->metode_pembayaran,               // Menyimpan metode_pembayaran penjualan yang dikirim melalui request
            'tanggal' => $request->tanggal,     // Menyimpan tanggal penjualan yang dikirim melalui request
            'user_id' => Auth::id(),             // Menyimpan user_id dari pengguna yang sedang login
            'catatan' => $request->catatan               // Menyimpan catatan penjualan yang dikirim melalui request
        ]);

        // Mengarahkan kembali ke route 'penjualan' dengan pesan sukses
        Alert::toast('Transaksi pembelian berhasil diperbarui!','success');
        return redirect()->route('penjualan');
    }

    public function destroy($id)
    {
        // Mengambil data penjualan berdasarkan ID yang diberikan.
        $penjualan = penjualan::findOrFail($id);

        // Menghapus data penjualan yang ditemukan dari database.
        $penjualan->delete();

        // Ambil produk yang terlibat dalam penjualan ini
        $selectedProduct = produk::find($penjualan->produk_id);

        // Kembalikan stok berdasarkan kategori produk pada transaksi yang dihapus
        if ($selectedProduct->kategori == 'saldo') {
            // Kembalikan stok untuk semua produk dengan kategori 'saldo'
            produk::where('kategori', 'saldo')->increment('stok', $penjualan->jumlah);
        } else {
            // Kembalikan stok untuk produk yang bukan kategori 'saldo'
            $selectedProduct->increment('stok', $penjualan->jumlah);
        }

        // Mengarahkan ke route 'penjualan' dengan pesan sukses
        Alert::toast('Transaksi pembelian berhasil dihapus!','success');
        return redirect()->route('penjualan');
    }

    public function detail($id)
    {
        // Mengambil data penjualan berdasarkan ID yang diberikan.
        $penjualan = penjualan::findOrFail($id);

        // Mengambil semua data produk dan user dari database.
        $user = User::all();
        $produk = produk::all();

        // Format jumlah dengan titik ribuan
        $penjualan->formatted_jumlah = formatNumber($penjualan->jumlah);

        // Memformat total ke dalam format Rupiah.
        $penjualan->formatted_total = formatRupiah($penjualan->total);

        // Memformat tanggal ke dalam format d/m/y H-i-s.
        $penjualan->formatted_date = formatDate($penjualan->tanggal);

        // Memformat tanggal ke dalam format d/m/y H-i-s.
        $penjualan->formatted_date = formatDate($penjualan->created_at);

        // Memformat tanggal ke dalam format d/m/y H-i-s.
        $penjualan->formatted_date = formatDate($penjualan->updated_at);

        // Mengembalikan view 'penjualan.update' dengan variabel 'produk', 'penjualan', dan 'user'.
        return view('penjualan.detail', compact('produk','penjualan', 'user'));
    }

    public function filter(Request $request)
    {
        // Membuat instance query builder dari model `penjualan`.
        $query = penjualan::query();

        // Filter by nama_produk
        if ($request->filled('nama_produk')) {
            $query->whereHas('produk', function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->input('nama_produk') . '%');
            });
        }

        // Filter by tanggal_mulai
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->input('tanggal_mulai'));
        }

        // Filter by tanggal_akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal', '<=', $request->input('tanggal_akhir'));
        }

        // Menjalankan query yang telah dibangun menggunakan query builder dan mengambil semua hasilnya.
        $penjualan = $query->get();

        // Mengarahkan ke route 'penjualan'
        return view('penjualan.penjualan', compact('penjualan'));
    }

    public function cetak(Request $request)
    {
        // Ambil data transaksi dari database
        $produk = produk::all();
        $user = User::all();

        // Membuat instance query builder dari model `penjualan`.
        $query = penjualan::query();

        // Filter by nama_produk
        if ($request->filled('nama_produk')) {
            $query->whereHas('produk', function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->input('nama_produk') . '%');
            });
        }

        // Filter by tanggal_mulai
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->input('tanggal_mulai'));
        }

        // Filter by tanggal_akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal', '<=', $request->input('tanggal_akhir'));
        }

        // Menjalankan query yang telah dibangun menggunakan query builder dan mengambil semua hasilnya.
        $penjualan = $query->get();

        // Menghitung jumlah transaksi penjualan
        $jumlahPenjualan = $penjualan->count();

        // Menghitung jumlah total
        $jumlahTotal = $penjualan->sum('total');

        // Menghitung jumlah Keuntungan
        $jumlahKeuntungan = $penjualan->sum('keuntungan');

        // Input tanggal mulai
        $tanggal_mulai = $request->input('tanggal_mulai');

        // Input tanggal akhir
        $tanggal_akhir = $request->input('tanggal_akhir');

        // Iput nama produk
        $nama_produk = $request->input('nama_produk');

        // Mengarahkan ke route 'penjualan.cetak' untuk di cetak
        return view('penjualan.cetak', compact('penjualan', 'user', 'produk', 'jumlahPenjualan', 'jumlahTotal', 'tanggal_mulai', 'tanggal_akhir', 'nama_produk', 'jumlahKeuntungan'));
    }
}
