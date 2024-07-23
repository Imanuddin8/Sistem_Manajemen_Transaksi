<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('dist/img/logo.jpg')}}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Laros Cell</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/userReal.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <label class="fs-6 text-white">{{ auth()->user()->nama}}</label>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pembelian') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembelian</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('penjualan') }}" class="nav-link" >
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk') }}" class="nav-link ">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                @if (auth()->user()->role == "admin")
                    <li class="nav-item">
                        <a href="{{ route('user') }}" class="nav-link ">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                user
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <div class="mt-3 d-flex justify-content-center">
            {{-- <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="button" id="logout" class="btn btn-danger btn-md px-5">
                    <i class="nav-icon fas fa-sign-out-alt" style="color: white;"></i>
                    <span class="align-middle ml-1">Logout</span>
                </button>
            </form> --}}
            <form action="{{ url('/logout') }}" method="POST" id="logout-form">
                @csrf
                <button type="button" id="logout-button" class="btn btn-danger btn-md px-5">
                    <i class="nav-icon fas fa-sign-out-alt" style="color: white;"></i>
                    <span class="align-middle ml-1">Logout</span>
                </button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const logoutButton = document.getElementById('logout-button');
            const logoutForm = document.getElementById('logout-form');

            logoutButton.addEventListener('click', function () {
                Swal.fire({
                    title: 'Logout!',
                    text: "Apakah anda yakin ingin logout?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Logout!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutForm.submit();
                    }
                })
            });
        });
    </script>
    <!-- /.sidebar -->
</aside>
