@extends('layouts.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 text-center">
                    <h1>Edit Transaksi Penjualan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <form id="form" action="{{ route('penjualan.update', $penjualan->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div
                                    class="row justify-content-center align-items-center g-3 mb-3"
                                >
                                    <div class="col-12 col-lg-6">
                                        <label for="exampleFormControlSelect1" class="form-label">Nama Produk</label>
                                        <select name="produk_id" id="produk_id" class="form-control" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                            @foreach ($produk as $ct)
                                                @if($ct->nama_produk !== 'saldo')
                                                    <option value="{{$ct->id}}" {{$penjualan->produk_id == $ct->id ? 'selected' : ''}} >
                                                    {{$ct->nama_produk}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                                        <input value="{{$penjualan->jumlah}}" name="jumlah" id="jumlah" class="form-control" id="exampleFormControlInput1" placeholder="Jumlah produk" required type="number" oninvalid="this.setCustomValidity('Jumlah harus lebih dari 1')"
                                        oninput="setCustomValidity(''); formatNumber(this)" min="1"/>
                                    </div>
                                </div>
                                <div
                                    class="row g-3 mb-3"
                                >
                                    <div class="col-12 col-lg-6">
                                        <label for="exampleFormControlInput1" class="form-label">Nomor</label>
                                        <input value="{{$penjualan->no}}" name="no" id="no" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nomor" required/>
                                        <small class="form-text text-muted">Jika tidak ada nomor isi dengan simbol '-' (strip).</small>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="exampleFormControlSelect1" class="form-label">Metode Pembayaran</label>
                                        <select title="metode pembayaran" name="metode_pembayaran" id="metode_pembayaran" class="form-control" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                            <option selected value="{{$penjualan->metode_pembayaran}}">{{$penjualan->metode_pembayaran}}</option>
                                            <option value="tunai">Tunai</option>
                                            <option value="qris">Qris</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                                    <input value="{{$penjualan->tanggal}}" name="tanggal" type="datetime-local" class="form-control" id="exampleFormControlInput1" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Catatan</label>
                                    <textarea title="catatan" name="catatan" id="catatan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$penjualan->catatan}}</textarea>
                                    <small class="form-text text-muted">Jika tidak ada catatan, isi catatan dengan simbol '-' (strip).</small>
                                </div>
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <div class="mr-4">
                                        <a class="btn btn-secondary" href="{{route('penjualan')}}">Batal</a>
                                    </div>
                                    <div>
                                      <button type="submit" name="update" class="btn btn-warning">Edit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <script>
            function formatNumber(input) {
                // Hapus semua karakter non-digit
                let value = input.value.replace(/\D/g, '');
                // Format ulang angka dengan titik ribuan
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                input.value = value;
            }
        </script>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
