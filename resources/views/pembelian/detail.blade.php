@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12">
        <h1>Transaksi Pembelian</h1>
        <p>Detail transaksi pembelian pada Toko Laros Cell</p>
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
                        : {{$pembelian->produk->nama_produk}}
                        <input type="hidden" name="produk_id" id="produk_id" value="{{$pembelian->produk_id}}">
                    </td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>
                        : {{formatNumber($pembelian->jumlah)}}
                    </td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>
                        : {{$pembelian->metode_pembayaran}}
                    </td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>
                        : {{formatRupiah($pembelian->total)}}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal & Waktu</td>
                    <td>
                        : {{formatDate($pembelian->tanggal)}}
                    </td>
                </tr>
                <tr>
                    <td>Pembuat</td>
                    <td>
                        : <td>{{ $row->user->username ?? 'User tidak ada' }}</td>
                        <input type="hidden" name="user_id" id="user_id" value="{{$pembelian->user_id}}">
                    </td>
                </tr>
                <tr>
                    <td>Tanggal & waktu di Buat</td>
                    <td>
                        : {{formatDate($pembelian->created_at)}}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal & waktu di Edit</td>
                    <td>
                        : {{formatDate($pembelian->updated_at)}}
                    </td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td>
                        : {{$pembelian->catatan}}
                    </td>
                </tr>
            </table>
            <a href="{{ route('pembelian') }}" class="btn btn-primary btn-md" >
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
