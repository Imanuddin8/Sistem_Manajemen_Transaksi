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
            <div
                class="row justify-content-center align-items-center g-3 mb-3"
            >
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlSelect1" class="form-label">Nama Produk</label>
                    <input type="text" name="produk_nama" id="produk_nama" class="form-control" aria-label="Default input example" value="{{$penjualan->produk->nama_produk}}" readonly>
                    <input type="hidden" name="produk_id" id="produk_id" value="{{$penjualan->produk_id}}">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                    <input readonly value="{{number_format($penjualan->jumlah)}}" name="jumlah" id="jumlah" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">No</label>
                    <input readonly value="{{$penjualan->no}}" name="no" id="no" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlSelect1" class="form-label">Metode Pembayaran</label>
                    <input readonly value="{{$penjualan->metode_pembayaran}}" name="metode_pembayaran" id="metode_pembayaran" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlSelect1" class="form-label">Total</label>
                    <input readonly value="{{formatRupiah($penjualan->total)}}" name="total" id="total" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal & Waktu</label>
                    <input readonly value="{{formatDate($penjualan->tanggal)}}" name="tanggal" id="tanggal" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal & waktu di Buat</label>
                    <input readonly value="{{formatDate($penjualan->created_at)}}" name="created_at" id="created_at" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal & waktu di Edit</label>
                    <input readonly value="{{formatDate($penjualan->updated_at)}}" name="updated_at" id="updated_at" type="text" class="form-control"/>
                </div>
            </div>
            <div
                class="row g-3 mb-3"
            >
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlSelect1" class="form-label">Pembuat</label>
                    <input type="text" name="produk_nama" id="produk_nama" class="form-control" aria-label="Default input example" value="{{$penjualan->user->username}}" readonly>
                    <input type="hidden" name="produk_id" id="produk_id" value="{{$penjualan->user_id}}">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Catatan</label>
                    <textarea readonly title="catatan" name="catatan" id="catatan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$penjualan->catatan}}</textarea>
                </div>
            </div>
            <a href="{{ route('penjualan') }}" class="btn btn-primary btn-md" >
                <i class="fa-solid fa-arrow-left"></i>
                kembali
            </a>
        </div>
      </div>
    </div>
  </div>
</div>

@include('sweetalert::alert')

</section>


@endsection
