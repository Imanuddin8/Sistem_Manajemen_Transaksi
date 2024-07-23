@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12">
        <h1>User</h1>
        <p>Daftar user admin dan karyawan yang mengakses sistem informasi manajemen transaksi pada Toko Laros Cell</p>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-4">
              <a type="button" class="btn btn-primary btn-md" href="{{ route('user.create') }}" role="button">
                <i class="fa fa-plus"></i> Tambah
              </a>
            </div>
            <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-hover">
                <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Posisi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="text-start">
                  @foreach ($user as $row)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$row->nama}}</td>
                      <td>{{$row->username}}</td>
                      <td>{{$row->role}}</td>
                      <td class="d-flex justify-content-center">
                        <a href="{{route('user.edit', ['id' => $row->id])}}" type="button" class="btn btn-icon btn-warning mr-1" name="edit">
                          <i class="fa fa-edit text-white"></i>
                        </a>
                        <form action="{{ route('user.destroy', $row->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button  id="hapus" class="btn btn-icon btn-danger" type="button" data-id="{{ $row->id }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
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
  </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('#hapus');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Hapus user!',
                        text: "Apakah anda yakin ingin menghapus user?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Iya, Hapus user!',
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
</section>
@endsection
