@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div>
                <h5>Selamat datang {{auth()->user()->nama}}, anda login sebagai {{auth()->user()->role}}</h5>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div
                class="row justify-content-start align-items-center"
            >
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-primary p-1">
                        <div class="inner">
                            <div
                                class="row justify-content-between align-items-center"
                            >
                                <div class="col-auto">
                                    <h4>{{ number_format($saldoStok, 0, ',', '.') }}</h4>
                                    <p>Jumlah Saldo</p>
                                </div>
                                <div class="col-auto">
                                    <i class="fs-1 fa-solid fa-wallet" style="color: #0948e7;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-warning p-1">
                        <div class="inner">
                            <div
                                class="row justify-content-between align-items-center"
                            >
                                <div class="col-auto text-white">
                                    <h4>{{ number_format($jumlahProduk, 0, ',', '.') }}</h4>
                                    <p>Jumlah produk</p>
                                </div>
                                <div class="col-auto">
                                    <i class="fs-1 fa-solid fa-box" style="color: #d9a406;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-success p-1">
                        <div class="inner">
                            <div
                                class="row justify-content-between align-items-center"
                            >
                                <div class="col-auto">
                                    <h4>{{ number_format($totalSales, 0, ',', '.') }}</h4>
                                    <p>Penjualan Hari Ini</p>
                                </div>
                                <div class="col-auto">
                                    <i class="fs-1 fa-solid fa-money-bill" style="color: #228e3b;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-info p-1">
                        <div class="inner">
                            <div
                                class="row justify-content-between align-items-center"
                            >
                                <div class="col-auto">
                                    <h4>{{ formatRupiah($totalKeuntungan) }}</h4>
                                    <p>Keuntungan Hari Ini</p>
                                </div>
                                <div class="col-auto">
                                    <i class="fs-1 fa-solid fa-money-check-dollar" style="color: #148a9d;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->role == "admin")
                    <div class="col-lg-3 col-md-6">
                        <div class="small-box bg-danger p-1">
                            <div class="inner">
                                <div
                                    class="row justify-content-between align-items-center"
                                >
                                    <div class="col-auto">
                                        <h4>{{ number_format($jumlahUser, 0, ',', '.') }}</h4>
                                        <p>Jumlah user</p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fs-1 fa-solid fa-user" style="color: #bb2d3b;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="mb-3" style="width: 100%;">
                <canvas id="profitChart"></canvas>
            </div>
            <div style="width: 100%;">
                <canvas id="profitChartT"></canvas>
            </div>

            <script>
                // Grafik Keuntungan
                const ctxProfit = document.getElementById('profitChart').getContext('2d');
                const profitData = @json($dataP);
                const year = {{ \Carbon\Carbon::now()->year }}; // Mengambil tahun saat ini

                new Chart(ctxProfit, {
                    type: 'line',
                    data: {
                        labels: [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ],
                        datasets: [{
                            label: 'Keuntungan ' + year, // Label dataset dengan tahun
                            data: Object.values(profitData),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Grafik Keuntungan Tahun ' + year // Judul grafik dengan tahun
                            }
                        }
                    }
                });

                // Grafik Penjualan
                const ctxPenjualan = document.getElementById('profitChartT').getContext('2d');
                const penjualanData = @json($data);

                new Chart(ctxPenjualan, {
                    type: 'line',
                    data: {
                        labels: [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ],
                        datasets: [{
                            label: 'Penjualan ' + year, // Label dataset dengan tahun
                            data: Object.values(penjualanData),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Grafik Penjualan Tahun ' + year // Judul grafik dengan tahun
                            }
                        }
                    }
                });
            </script>
        </div>
    </section>
@endsection
