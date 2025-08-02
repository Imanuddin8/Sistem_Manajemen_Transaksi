@extends('layouts.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 text-center">
                <h1>Tambah Transaksi Penjualan</h1>
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
                        <form id="form" action="{{ route('penjualan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center align-items-center g-3 mb-3" id="produk-rows">
                                <div class="col-12">
                                    <button type="button" class="btn btn-success" id="add-row">
                                        <span>Tambah Produk</span>
                                    </button>
                                </div>
                                <!-- Baris produk default -->
                                @foreach(old('produk_id', [null]) as $index => $old_produk_id)
                                <div class="row ms-0 g-2 produk-row">
                                    <div class="col-12 col-lg-4">
                                        <label for="exampleFormControlSelect1" class="form-label">Nama Produk</label>
                                        <select title="nama produk" name="produk_id[]" class="form-control" aria-label="Default select example" required>
                                            @foreach($produk as $item)
                                                {{-- <option value="{{ $item->id }}" {{ $old_produk_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_produk }}
                                                </option> --}}
                                                @if($item->nama_produk !== 'saldo')
                                                    <option value="{{ $item->id }}" {{ $old_produk_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_produk }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5 col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                                        <input name="jumlah[]" type="number" class="form-control" placeholder="Jumlah produk" oninput="formatNumber(this)" value="{{ old('jumlah.' . $index) }}" required oninvalid="this.setCustomValidity('Jumlah harus lebih dari 1')"
                                        oninput="setCustomValidity('')" min="1"/>
                                    </div>
                                    <div class="col-5 col-lg-4">
                                        <label for="no" class="form-label">Nomor</label>
                                        <input title="nomor" name="no[]" type="text" oninput="formatNo(this)" class="form-control" placeholder="Nomor" value="{{ old('no' . $index) }}">
                                        <small class="form-text text-muted">Kosongi jika tidak ada nomor.</small>
                                    </div>
                                    <div class="col-2 col-lg-1 d-flex align-items-start" style="margin-top: 2.4rem;">
                                        <button type="button" class="btn btn-danger remove-row">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                <select title="metode pembayaran" name="metode_pembayaran" id="metode_pembayaran" class="form-control" aria-label="Default select example" required>
                                    <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="qris" {{ old('metode_pembayaran') == 'qris' ? 'selected' : '' }}>Qris</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea title="catatan" name="catatan" id="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                                <small class="form-text text-muted">Kosongi jika tidak ada catatan.</small>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="mr-4">
                                    <a class="btn btn-secondary" href="{{ route('penjualan') }}">Batal</a>
                                </div>
                                <div>
                                    <button type="submit" name="create" class="btn btn-primary">Tambah</button>
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
            let value = input.value.replace(/\D/g, '');
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            input.value = value;
        }
        function formatNo(input) {
            let value = input.value.replace(/\D/g, '');
            input.value = value;
        }
        document.getElementById('add-row').addEventListener('click', function() {
        const container = document.getElementById('produk-rows');
        const index = container.querySelectorAll('.produk-row').length;
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'ms-0', 'g-2', 'produk-row');
        newRow.innerHTML = `
            <div class="col-12 col-lg-4">
                <label class="form-label">Nama Produk</label>
                <select title="nama produk" name="produk_id[]" class="form-control" aria-label="Default select example" required>
                    @foreach($produk as $item)
                        <option value="{{ $item->id }}" {{ old('produk_id.${index}') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_produk }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-5 col-lg-3">
                <label class="form-label">Jumlah</label>
                <input name="jumlah[]" type="text" class="form-control" placeholder="Jumlah produk" oninput="formatNumber(this)" value="{{ old('jumlah.${index}') }}" required/>
            </div>

            <div class="col-5 col-lg-4">
                <label for="no" class="form-label">Nomor</label>
                <input title="nomor" name="no[]" type="text" class="form-control" placeholder="Nomor" value="{{ old('no.${index}') }}">
                <small class="form-text text-muted">Kosongi jika tidak ada nomor.</small>
            </div>

            <div class="col-2 col-lg-1 d-flex align-items-start" style="margin-top: 2.2rem;">
                <button type="button" class="btn btn-danger remove-row">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>
        `;
        container.appendChild(newRow);
    });

    // Menggunakan event delegation untuk menghapus baris produk
    document.getElementById('produk-rows').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-row') || event.target.closest('.remove-row')) {
            const row = event.target.closest('.produk-row');
            row.remove();
        }
    });
    </script>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
