@extends('layouts.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 text-center">
                    <h1>Edit Transaksi Pembelian</h1>
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
                        <div class="pb-8">
                        </div>
                        <div class="card-header">
                            <form id="form" action="{{ route('pembelian.update', $pembelian->id) }}" method="post"
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
                                                <option value="{{$ct->id}}" {{$pembelian->produk_id == $ct->id ? 'selected' : ''}} >
                                                {{$ct->nama_produk}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                                        <input value="{{$pembelian->jumlah}}" name="jumlah" id="jumlah" class="form-control" id="exampleFormControlInput1" placeholder="Jumlah produk" oninput="formatNumber(this)" required type="number" oninvalid="this.setCustomValidity('Jumlah harus lebih dari 1')"
                                        oninput="setCustomValidity('')" min="1"/>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="exampleFormControlSelect1" class="form-label">Metode Pembayaran</label>
                                        <select title="metode pembayaran" name="metode_pembayaran" id="metode_pembayaran" class="form-control" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                            <option value="{{$pembelian->metode_pembayaran}}" selected>{{$pembelian->metode_pembayaran}}</option>
                                            <option value="tunai">Tunai</option>
                                            <option value="qris">Qris</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                                        <input value="{{$pembelian->tanggal}}" name="tanggal" type="datetime-local" class="form-control" id="exampleFormControlInput1" required/>
                                    </div>
                                    <div class="col-12">
                                        <label for="exampleFormControlInput1" class="form-label">Catatan</label>
                                        <textarea title="catatan" name="catatan" id="catatan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$pembelian->catatan}}</textarea>
                                        <small class="form-text text-muted">Jika tidak ada catatan, isi catatan dengan simbol '-' (strip).</small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <div class="mr-4">
                                        <a class="btn btn-secondary" href="{{route('pembelian')}}">Batal</a>
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
