@extends('Admin.Layout.main')

@section('admin-konten')

<style>
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: scale(1.03);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .card.border-left-primary:hover {
        border-left-color: #4e73df;
    }

    .card.border-left-success:hover {
        border-left-color: #1cc88a;
    }

    .card.border-left-info:hover {
        border-left-color: #36b9cc;
    }
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Earnings ({{$currentMonth}})</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($currentMonthEarnings, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Use Room Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Use Room ({{$currentDay}})</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$roomsInUse}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Target Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Target : {{ $targetReservasiPerBulan }} ({{$currentMonth}})</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $persentaseTercapai }}%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $persentaseTercapai }}%" aria-valuenow="{{ $persentaseTercapai }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Reservasi ({{$currentMonth}})</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bookingCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bed fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row chart-container ">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Total Pendapatan Perbulan (1 Tahun Terakhir)</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Total Pendapatan Perhari</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-5">
    <div class="card-body">
        <h3>Reservasi Terakhir</h3>
        <div class="table-responsive">
            <table class="table table-striped table-sm " style="font-size: 5pt;   vertical-align: middle;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Reservasi</th>
                        <th scope="col">Nama Tamu</th>
                        <th scope="col">No Handphone</th>
                        <th scope="col">Jenis/Type Kamar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Check-in</th>
                        <th scope="col">Check-Out</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Status Reservasi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($data as $row)
                    <tr style="font-size: 10pt">
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->kode_reservasi }}</td>
                        <td>{{ $row->nama_tamu }}</td>
                        <td>{{ $row->no_hp }}</td>
                        <td>{{ $row->jenis_kamar }}</td>
                        <td>{{ 'Rp ' . number_format($row->harga, 0, ',', '.') }}</td>
                        <td>{{ $row->checkIn }}</td>
                        <td>{{ $row->checkOut }}</td>
                        <td class="text-center">
                            {{ $row->pembayaran && $row->pembayaran->jumlah_bayar !== null
                ? 'Rp ' . number_format($row->pembayaran->jumlah_bayar, 0, ',', '.')
                : '-' }}
                        </td>
                        <td class="text-center">
                            @if($row->pembayaran)
                            @if($row->pembayaran->status == 'Paid')
                            <span class="badge bg-success">Paid</span>
                            @elseif($row->pembayaran->status == 'Unpaid')
                            <span class="badge bg-warning">Unpaid</span>
                            @elseif($row->pembayaran->status == 'Pending')
                            <span class="badge bg-info">Pending</span>
                            @elseif($row->pembayaran->status == 'Expired')
                            <span class="badge bg-danger">Expired</span>
                            @else
                            <span class="badge bg-secondary">Tidak diketahui</span>
                            @endif
                            @else
                            <span class="badge bg-secondary">Tidak diketahui</span>
                            @endif
                        </td>
                        <td>
                            @if ($row->pembayaran->status === "Expired" && $row->status_reservasi === null)
                            <span style="font-style:italic">Transaksi Batal</span>
                            @elseif ($row->status_reservasi === null)
                            <span class="badge bg-warning text-dark">Belum Checkin</span>
                            @elseif ($row->status_reservasi == 0)
                            <span class="badge bg-success">Checkin</span>
                            @elseif ($row->status_reservasi == 1)
                            <span class="badge bg-danger">Checkout</span>
                            @else
                            {{ $row->status_reservasi }}
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Plugin kustom untuk menampilkan pesan jika tidak ada data
    const noDataPlugin = {
        id: 'noDataPlugin',
        afterDraw: function(chart) {
            if (chart.data.datasets.length === 0 || chart.data.datasets[0].data.length === 0 || chart.data.datasets[0].data.every(item => item === null)) {
                let ctx = chart.ctx;
                let width = chart.width;
                let height = chart.height;
                chart.clear();

                // Set style untuk teks
                ctx.save();
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.font = "16px Arial";
                ctx.fillText('Tidak ditemukan data.', width / 2, height / 2);
                ctx.restore();
            }
        }
    };

    // Daftarkan plugin
    Chart.register(noDataPlugin);

    document.addEventListener('DOMContentLoaded', function() {
        // Set up Area Chart
        var ctxArea = document.getElementById('myAreaChart').getContext('2d');
        var myAreaChart = new Chart(ctxArea, {
            type: 'line',
            data: {
                labels: @json($labelsBulanan),
                datasets: [{
                    label: 'Total Pembayaran',
                    data: @json($dataBulanan),
                    backgroundColor: 'rgba(78, 115, 223, 0.2)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }

                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14 // Ukuran font untuk legenda
                            }
                        }
                    },
                    tooltip: {
                        bodyFont: {
                            size: 14 // Ukuran font untuk tooltip
                        }
                    }
                }

            }
        });

        // Set up Pie Chart
        var ctxPie = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: @json($labelsHarian),
                datasets: [{
                    data: @json($dataHarian),
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                }],
            },
            options: {
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 16 // Ukuran font untuk legenda
                            }
                        }
                    },
                    tooltip: {
                        bodyFont: {
                            size: 14 // Ukuran font untuk tooltip
                        }
                    }
                }
            }
        });
    });
</script>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif


@endsection
