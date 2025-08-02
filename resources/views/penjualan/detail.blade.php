@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12">
        <h1>Transaksi Penjualan</h1>
        <p>Detail transaksi penjualan pada Toko Laros Cell</p>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-md-8 col-lg-12">
      <div class="card">
        <div class="card-body">
            <table class="mb-3">
                <tr>
                    <td>Nama Produk</td>
                    <td>
                        : {{$penjualan->produk->nama_produk}}
                        <input type="hidden" name="produk_id" id="produk_id" value="{{$penjualan->produk_id}}">
                    </td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>
                        : {{formatNumber($penjualan->jumlah)}}
                    </td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>
                        : {{($penjualan->no)}}
                    </td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>
                        : {{$penjualan->metode_pembayaran}}
                    </td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>
                        : {{formatRupiah($penjualan->total)}}
                    </td>
                </tr>
                <tr>
                    <td>Keuntungan</td>
                    <td>
                        : {{formatRupiah($penjualan->keuntungan)}}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal & Waktu</td>
                    <td>
                        : {{formatDate($penjualan->tanggal)}}
                    </td>
                </tr>
                <tr>
                    <td>Pembuat</td>
                    <td>
                        : {{$penjualan->user->username ?? 'User tidak ada'}}
                        <input type="hidden" name="user_id" id="user_id" value="{{$penjualan->user_id}}">
                    </td>
                </tr>
                <tr>
                    <td>Tanggal & waktu di Buat</td>
                    <td>
                        : {{formatDate($penjualan->created_at)}}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal & waktu di Edit</td>
                    <td>
                        : {{formatDate($penjualan->updated_at)}}
                    </td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td>
                        : {{$penjualan->catatan}}
                    </td>
                </tr>
            </table>
            <a href="{{ route('penjualan') }}" class="btn btn-primary btn-md" >
                <i class="fa-solid fa-arrow-left"></i>
                kembali
            </a>
        </div>
      </div>
    </div>
  </div>
</div>

</section>


@endsection
