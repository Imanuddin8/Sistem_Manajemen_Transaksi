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
            <div
                class="row justify-content-center align-items-center g-3 mb-3"
            >
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlSelect1" class="form-label">Nama Produk</label>
                    <input type="text" name="produk_nama" id="produk_nama" class="form-control" aria-label="Default input example" value="{{$pembelian->produk->nama_produk}}" readonly>
                    <input type="hidden" name="produk_id" id="produk_id" value="{{$pembelian->produk_id}}">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                    <input readonly value="{{formatNumber($pembelian->jumlah)}}" name="jumlah" id="jumlah" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlSelect1" class="form-label">Metode Pembayaran</label>
                    <input readonly value="{{$pembelian->metode_pembayaran}}" name="metode_pembayaran" id="metode_pembayaran" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlSelect1" class="form-label">Total</label>
                    <input readonly value="{{formatRupiah($pembelian->total)}}" name="total" id="total" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal & Waktu</label>
                    <input readonly value="{{formatDate($pembelian->tanggal)}}" name="tanggal" id="tanggal" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlSelect1" class="form-label">Pembuat</label>
                    <input type="text" name="produk_nama" id="produk_nama" class="form-control" aria-label="Default input example" value="{{$pembelian->user->username}}" readonly>
                    <input type="hidden" name="produk_id" id="produk_id" value="{{$pembelian->user_id}}">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal & waktu di Buat</label>
                    <input readonly value="{{formatDate($pembelian->created_at)}}" name="created_at" id="created_at" type="text" class="form-control"/>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal & waktu di Edit</label>
                    <input readonly value="{{formatDate($pembelian->updated_at)}}" name="update_at" id="update_at" type="text" class="form-control"/>
                </div>
                <div class="col-12">
                    <label for="exampleFormControlInput1" class="form-label">Catatan</label>
                    <textarea readonly title="catatan" name="catatan" id="catatan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$pembelian->catatan}}</textarea>
                </div>
            </div>
            <a href="{{ route('pembelian') }}" class="btn btn-primary btn-md" >
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
