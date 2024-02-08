@extends('Layout.Semua')
@section('Title', 'Pesanan')
@section('Konten')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
    /* Mengkecilkan ukuran pagination */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        font-size: 0.75rem;
        /* Ukuran font lebih kecil */
        padding: 3px 6px;
        /* Padding yang lebih kecil */
        margin-bottom: 8px;
    }

    /* Mengkecilkan ukuran angka halaman */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        padding: 3px 6px;
        /* Padding yang lebih kecil */
    }

    /* Mengkecilkan ukuran teks 'Showing' */
    .dataTables_wrapper .dataTables_info {
        font-size: 0.75rem;
        /* Atur ukuran font sesuai kebutuhan */
        padding: 3px;
        margin-bottom: 5px;
        /* Atur padding sesuai kebutuhan */
    }

    #dataTable td {
        white-space: nowrap;
        overflow: hidden;
        max-width: 150px;
        vertical-align: middle;
    }

    #dataTable th {

        vertical-align: middle;
    }


    #dataTable td.kode-reservasi {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 300px;
    }

    #dataTable td.opsi {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 4000px;
    }

    .btn-extra-sm {
        padding: 0.25rem 0.5rem;
        /* Lebih kecil dari btn-sm */
        font-size: 0.75rem;
        /* Ukuran font lebih kecil */
        line-height: 1.25;
        /* Line height yang sesuai */
    }
</style>

<div class="container5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Reservasi</h1>
    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pesanan Anda</h6>
    </div>

    <div class="table-responsive shadow">
        @if(count($data) > 0)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr style="font-size: 10pt; text-align: center;">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kode Reservasi</th>
                    <th rowspan="2">Nama Tamu</th>
                    <th rowspan="2">Nomor Hp</th>
                    <th rowspan="2">Jenis/Type Kamar</th>
                    <th rowspan="2">Harga</th>
                    <th colspan="2">Tanggal Reservasi</th>
                    <th rowspan="2">Total Harga</th>
                    <th rowspan="2">Status Pembayaran</th>
                    <th rowspan="2">Dibuat</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr style="font-size: 10pt; text-align: center;">
                    <!-- Additional header for check-in and check-out -->
                    <th>Check In</th>
                    <th>Check Out</th>
                </tr>
            </thead>


            <tbody>
                @php($no = 1)
                @foreach ($data as $row)
                <tr style="font-size: 10pt; text-align: center;">
                    <th>{{ $no++ }}</th>
                    <td class="kode-reservasi">{{ $row->kode_reservasi }}</td>
                    <td>{{ $row->nama_tamu }}</td>
                    <td>{{ $row->no_hp }}</td>
                    <td>{{ $row->jenis_kamar }}</td>
                    <td>{{ 'Rp ' . number_format($row->harga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->checkIn)->format('d-m-Y') }} </td>
                    <td>{{ \Carbon\Carbon::parse($row->checkOut)->format('d-m-Y') }}</td>

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
                    <td>{{ $row->created_at->translatedFormat('l, d M Y') }}</td>
                    <td class="opsi text-center">
                        @if($row->pembayaran && $row->pembayaran->status == 'Unpaid')
                        <a href="javascript:void(0);" onclick="bayar('{{ $row->kode_reservasi }}')" class="btn btn-primary btn-extra-sm my-1">Bayar</a>
                        <a href="{{ route('lihat.reservasi', ['kode_reservasi' => $row->kode_reservasi]) }}" class="btn btn-info btn-extra-sm my-1">Lihat Reservasi</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-extra-sm my-1" onclick="confirmDelete('{{ route('hapus.pesanan', ['id' => $row->kode_reservasi]) }}')">
                            Hapus <span data-feather="trash-2"></span>
                        </a>

                        @elseif($row->pembayaran && $row->pembayaran->status == 'Paid')
                        <a href="{{ route('lihat.bukti', ['kode_reservasi' => $row->kode_reservasi]) }}" class="btn btn-success btn-extra-sm my-1">Lihat Bukti</a>
                        @elseif($row->pembayaran && $row->pembayaran->status == 'Expired')
                        <span style="font-style: italic;">Transaksi Expired</span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center mb-4">
            <img src="{{ asset('img/No Data Found.png') }}" alt="No Data Icon" width="50%" height="50%">
        </div>
        @endif
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "searching": false, // Nonaktifkan fitur pencarian
            "lengthChange": false // Nonaktifkan kontrol panjang tabel (jumlah baris per halaman)
        });
    });

    function confirmDelete(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Ingin menghapus pesanan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        });
    }
</script>

@if(session('message'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Informasi Reservasi',
            text: "{{ session('message') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

<!-- Sertakan library Midtrans Snap beserta kunci klien -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<!-- Bagian JavaScript untuk proses pembayaran -->
<!-- Bagian JavaScript untuk proses pembayaran -->
<script type="text/javascript">
    // Fungsi untuk memulai pembayaran menggunakan Midtrans Snap
    function bayar(kodeReservasi) {
        Swal.fire({
            title: 'Memproses...',
            text: 'Silakan tunggu.',
            didOpen: () => {
                Swal.showLoading();
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        });

        // Mengambil data pembayaran dari server
        fetch(`/bayar-pesanan/${kodeReservasi}`)
            .then(response => {
                // console.log('Response status:', response.status); // debuging Log the HTTP status code
                return response.json();
            })
            .then(data => {
                // console.log('Response from server:', data); // debuging data dari server

                // Memproses data pembayaran dari server
                if (data.error) {
                    // Menampilkan pesan error apabila dari server terdapat eror dan mereload halaman
                    Swal.fire('Error', data.error, 'error').then(() => {
                        location.reload();
                    });
                } else if (data.message === 'Pembayaran sudah dilakukan sebelumnya') {
                    // cek apakah ada pesan ini dari server (paid) jika ada tampilkan informasinya
                    Swal.fire('Informasi', data.message, 'info').then(() => {});
                } else if (data.message === 'Pembayaran pending, silakan menghubungi admin untuk pembayaran') {
                    // cek apakah ada pesan ini dari server (pending) jika ada tampilkan informasinya
                    Swal.fire('Informasi', data.message, 'info').then(() => {
                        location.reload();
                    });

                    //} else if (data.message === 'Pembayaran dibatalkan atau kedaluwarsa') {
                    //     // cek apakah ada pesan ini dari server (expired) jika ada tampilkan informasinya
                    //     Swal.fire('Informasi', data.message, 'warning').then(() => {
                    //         location.reload();
                    //     });
                } else if (data.message === 'Pembayaran dibatalkan karena kedaluwarsa') {
                    // cek apakah ada pesan ini dari server (pending) jika ada tampilkan informasinya
                    Swal.fire('Informasi', data.message, 'warning').then(() => {

                    });
                } else if (data.snapToken) {
                    // Memulai pembayaran menggunakan Snap
                    snap.pay(data.snapToken, {
                        // jika sukses lakukan pengecekan status tanskasi
                        onSuccess: function(result) {
                            checkPaymentStatus(result.order_id);
                        },
                        // jika pending lakukan pengecekan status tanskasi
                        onPending: function(result) {
                            checkPaymentStatus(result.order_id);
                        },
                        // jika eror lakukan pengecekan status tanskasi
                        onError: function(result) {
                            // Menampilkan pesan error ketika try catch server tidak terpenuhi dan reload
                            Swal.fire('Error', 'Terjadi kesalahan saat proses pembayaran.', 'error').then(() => {
                                location.reload();
                            });
                        },
                        onClose: function() {
                            // Menampilkan pesan informasi pembayaran di batalkan ketika belum klik metode bayar  dan reload
                            Swal.fire('Informasi', 'Proses pembayaran dibatalkan.', 'info').then(() => {
                                location.reload();
                            });
                        }
                    });
                } else {
                    // Menampilkan pesan error ketika server tidak dapat memproses (pengecekan status dan gagal mendapatkan snap token)
                    Swal.fire('Error', 'Respon server tidak valid atau tidak lengkap.', 'error').then(() => {

                    });
                }
            })
            .catch(error => {
                // Menampilkan pesan error jika pada backend bermasalah (tidak di temrukan reservasi atau pembayaran yang tidak sesuai prosedur) dan reload
                Swal.fire('Error', 'Terjadi masalah pada server, silakan coba lagi nanti.', 'error').then(() => {

                });
            });
    }

    // Fungsi untuk memeriksa status pembayaran berdasarkan ID pesanan
    function checkPaymentStatus(orderId) {
        // Mengambil status pembayaran dari server
        fetch(`/check-payment/${orderId}`)
            .then(response => response.json())
            .then(data => {
                // Memproses data status pembayaran dari server
                if (data.status === 'Paid') {
                    // Menampilkan pesan berhasil dan mereload halaman
                    Swal.fire('Berhasil', 'Pembayaran berhasil!', 'success').then(() => {
                        location.reload();
                    });
                } else if (data.status === 'Pending') {
                    // Menampilkan pesan informasi tanpa mereload halaman
                    Swal.fire('Informasi', 'Pembayaran pending. Silakan menghubungi admin untuk menyelesaikan pembayaran.', 'info').then(() => {
                        // Do not reload immediately, wait for user acknowledgment
                    });
                } else if (data.status === 'Expired' || data.status === 'Cancelled') {
                    // Menampilkan pesan informasi dan mereload halaman
                    Swal.fire('Informasi', 'Pembayaran telah kedaluwarsa.', 'warning').then(() => {
                        location.reload();
                    });
                } else {
                    // Menampilkan pesan informasi dan mereload halaman
                    Swal.fire('Informasi', 'Status pembayaran: ' + data.status, 'info').then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                // Menampilkan pesan error dan mereload halaman
                Swal.fire('Error', error.message, 'error').then(() => {
                    location.reload();
                });
            });
    }
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

@if(session('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif

@endsection
