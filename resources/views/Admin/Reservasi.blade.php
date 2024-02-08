@extends('Admin.Layout.main')

@section('Title', 'Reservasi')

@section('admin-konten')
@push('linkstyle')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
    #dataTable_wrapper .dataTables_length,
    #dataTable_wrapper .dataTables_filter {
        margin-bottom: 20px !important;
    }

    #dataTable td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 120px;
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
        max-width: 300px;
    }
</style>
@endpush

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Reservation</h1>

</div>


<!-- <div class="d-sm-flex align-items-center justify-content-between mb-2 mt-2">
    <a href="{{ route('tambahkamar') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <span data-feather="plus-square"></span> Tambah</a>
</div> -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tamu</h6>
    </div>
    <div class="card-body">

        <div class="d-flex align-items-center justify-content-between mt-3 px-3">
            <div>
                <a href="{{ route('tambah.reservasi') }}" class="btn btn-primary px-3 py-2">
                    <span data-feather="plus-square" class="mr-2"></span> Tambah Reservasi
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-sm">
                <thead style="background-color: #adb5bd">
                    <tr>
                        <th>No</th>
                        <th>Kode Reservasi</th>
                        <th>Nama Tamu</th>
                        <th>No Handphone</th>
                        <th>Type Kamar</th>
                        <th>Harga Permalam</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Status Reservasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @forelse ($data as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td class="kode-reservasi">{{ $row->kode_reservasi }}</td>
                        <td>{{ UcFirst($row->nama_tamu) }}</td>
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
                            <span class="me-1" style="font-style:italic">Transaksi Batal</span>
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
                        <td class="opsi">
                            @if ($row->pembayaran->status === "Expired" && $row->status_reservasi === null)
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-sm btn-danger" title="Hapus Reservasi" onclick="confirmDelete('{{ $row->kode_reservasi }}')">
                                Hapus
                            </button>
                            <!-- Hidden Delete Form -->
                            <form id="delete-form-{{ $row->kode_reservasi }}" action="{{ route('reservasi.destroy', $row->kode_reservasi) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            @elseif($row->pembayaran->status === "Paid" && $row->status_reservasi === 0)
                            <button type="button" class="btn btn-sm btn-danger" title="Hapus Reservasi" onclick="confirmDelete('{{ $row->kode_reservasi }}')">
                                Hapus
                            </button>
                            <!-- Hidden Delete Form -->
                            <form id="delete-form-{{ $row->kode_reservasi }}" action="{{ route('reservasi.destroy', $row->kode_reservasi) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            @else
                            <button type="button" class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#checkInModal{{ $row->kode_reservasi }}" title="Check In">
                                <span>Checkin</span>
                            </button>
                            <div class="modal fade" id="checkInModal{{ $row->kode_reservasi }}" tabindex="-1" aria-labelledby="checkInModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="checkInModalLabel">Konfirmasi Check-In</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <h6 class="mb-3">Detail Reservasi Tamu:</h6>
                                            <p class="mb-2">Kode Reservasi: <strong>{{ $row->kode_reservasi }}</strong></p>
                                            <p class="mb-4">Nama Tamu: <strong>{{UcFirst($row->nama_tamu) }}</strong></p>
                                            <hr>
                                            <p class="mb-0">Harap periksa detail di atas sebelum melanjutkan.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('reservasi.checkin', $row->kode_reservasi) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Yaa, Check-In</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-sm btn-danger" title="Hapus Reservasi" onclick="confirmDelete('{{ $row->kode_reservasi }}')">
                                Hapus
                            </button>
                            <!-- Hidden Delete Form -->
                            <form id="delete-form-{{ $row->kode_reservasi }}" action="{{ route('reservasi.destroy', $row->kode_reservasi) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">Tidak ada data reservasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable();
        // Add margin to DataTable controls
        $('#dataTable_wrapper .dataTables_length, #dataTable_wrapper .dataTables_filter, #dataTable_wrapper .dataTables_paginate').css('margin-top', '20px');
    });
</script>


@endpush



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<script>
    function confirmDelete(kodeReservasi) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Setelah dihapus, Anda tidak akan dapat memulihkan reservasi ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + kodeReservasi).submit();
            }
        });
    }
</script>

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
