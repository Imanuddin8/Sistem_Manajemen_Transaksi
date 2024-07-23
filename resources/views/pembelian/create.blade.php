@extends('layouts.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 text-center">
                    <h1>Tambah Transaksi Pembelian</h1>
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
                        <div class="card-body">
                            <form id="form" action="{{ route('pembelian.store') }}" method="post">
                                @csrf
                                <div class="row justify-content-center align-items-center g-3 mb-3" id="produk-rows">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success" id="add-row">
                                            <span>Tambah Produk</span>
                                        </button>
                                    </div>
                                    <!-- Baris produk default -->
                                    <div class="row justify-content-center align-items-center ms-0 g-2 produk-row">
                                        <div class="col-6 col-lg-7">
                                            <label for="exampleFormControlSelect1" class="form-label">Nama Produk</label>
                                            <select title="nama produk" name="produk_id[]" class="form-control" aria-label="Default select example" required>
                                                @foreach($produk as $item)
                                                    <option value="{{ $item->id }}" {{ old('produk_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4 col-lg-4">
                                            <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                                            <input name="jumlah[]" type="text" class="form-control" placeholder="Jumlah produk" oninput="formatNumber(this)" required/>
                                        </div>
                                        <div class="col-2 col-lg-1 d-flex align-items-start" style="margin-top: 2.2rem;">
                                            <button type="button" class="btn btn-danger remove-row">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Metode Pembayaran</label>
                                        <select title="metode pembayaran" name="metode_pembayaran" class="form-control" aria-label="Default select example" required>
                                            <option value="tunai">Tunai</option>
                                            <option value="qris">Qris</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                                        <input title="tanggal transaksi" name="tanggal" type="datetime-local" class="form-control" required/>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                                        <textarea title="catatan" name="catatan" class="form-control" rows="3"></textarea>
                                        <small class="form-text text-muted">Kosongi jika tidak ada catatan.</small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="mr-4">
                                        <a class="btn btn-secondary" href="{{ route('pembelian') }}">Batal</a>
                                    </div>
                                    <div>
                                        <button type="submit" name="create" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function formatNumber(input) {
                // Hapus semua karakter non-digit
                let value = input.value.replace(/\D/g, '');
                // Format ulang angka dengan titik ribuan
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                input.value = value;
            }

            document.getElementById('add-row').addEventListener('click', function() {
                const container = document.getElementById('produk-rows');
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'justify-content-center', 'align-items-center', 'ms-0', 'g-2', 'produk-row');
                newRow.innerHTML = `
                    <div class="col-6 col-lg-7">
                        <label class="form-label">Nama Produk</label>
                        <select title="nama produk" name="produk_id[]" class="form-control" aria-label="Default select example" required>
                            @foreach($produk as $item)
                                <option value="{{ $item->id }}" {{ old('produk_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4 col-lg-4">
                        <label class="form-label">Jumlah</label>
                        <input name="jumlah[]" type="text" class="form-control" placeholder="Jumlah produk" oninput="formatNumber(this)" required/>
                    </div>

                    <div class="col-2 col-lg-1 d-flex align-items-start" style="margin-top: 2.2rem;">
                        <button type="button" class="btn btn-danger remove-row">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                `;
                container.appendChild(newRow);
            });

            // Menghapus baris produk
            document.getElementById('produk-rows').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-row')) {
                    const row = event.target.closest('.produk-row');
                    row.remove();
                }
            });
        </script>
    </section>
@endsection
