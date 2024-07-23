@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12">
        <h1>Transaksi Pembelian</h1>
        <p>Daftar transaksi pembelian pada Toko Laros Cell</p>
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
                class="row justify-content-start align-items-center g-2 mb-4"
            >
                <div class="col-auto">
                    <a type="button" class="btn btn-primary btn-md" href="{{ route('pembelian.create') }}" role="button">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="col-auto">
                    <a target="_blank" type="button" class="btn btn-info btn-md" href="{{ route('pembelian.cetak', request()->query()) }}" role="button">
                        <i class="fa fa-print"></i> Cetak
                    </a>
                </div>
            </div>
            <div class="mb-4">
                <form action="{{ route('pembelian.filter') }}" method="get">
                    <div
                        class="row justify-content-start align-items-center g-2"
                    >
                        <div class="col-auto">
                            <span class="fw-bold">Filter</span>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" required type="date" name="tanggal_mulai" title="tanggal awal">
                        </div>
                        <div class="col-auto">
                            -
                        </div>
                        <div class="col-auto">
                            <input class="form-control" required type="date" name="tanggal_akhir" title="tanggal akhir">
                        </div>
                        <div class="col-auto">
                            /
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="text" placeholder="Masukkan nama produk" name="nama_produk" title="nama produk">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-icon btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        @if(request('tanggal_mulai'))
                            <div class="col-auto">
                                <a href="{{ route('pembelian') }}" class="btn btn-icon btn-success">
                                    <i class="fa fa-arrows-rotate text-white"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                  <th>Tanggal & Waktu</th>
                  <th>Pembuat</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody class="text-start">
                    @foreach ($pembelian as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->produk->nama_produk}}</td>
                            <td>{{number_format($row->jumlah, 0, ',', '.')}}</td>
                            <td>Rp {{number_format($row->total, 0, ',', '.')}}</td>
                            <td>{{ formatDate($row->tanggal) }}</td>
                            <td>{{ $row->user->username ?? 'User tidak ada' }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{route('pembelian.edit', ['id' => $row->id])}}" type="button" class="btn btn-icon btn-warning mr-2" name="edit">
                                    <i class="fa fa-edit text-white" aria-hidden="true"></i>
                                </a>
                                {{-- <form action="{{ route('pembelian.destroy', $row->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-icon btn-danger mr-2" type="submit" onclick="return confirm('Apakah anda yakin akan Menghapus?');">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form> --}}
                                <form action="{{ route('pembelian.destroy', $row->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button  id="hapus" class="btn btn-icon btn-danger mr-2" type="button" data-id="{{ $row->id }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <a href="{{route('pembelian.detail', ['id' => $row->id])}}}" type="button" class="btn btn-icon btn-info" name="detail">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('#hapus');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Hapus transaksi pembelian!',
                    text: "Apakah anda yakin ingin menghapus transaksi pembelian?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Hapus transaksi!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    });
</script>

@endsection
