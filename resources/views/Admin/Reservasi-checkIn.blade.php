@extends('Admin.Layout.main')

@section('Title', 'Check-In')

@section('admin-konten')
@push('linkstyle')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
    #dataTable_wrapper .dataTables_length,
    #dataTable_wrapper .dataTables_filter {
        margin-bottom: 20px !important;
    }

    #dataTable td,
    #dataTable th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
        vertical-align: middle;
    }
</style>
@endpush
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Check In</h1>

</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tamu Check In</h6>
    </div>
    <div class="card-body">
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
                    @foreach ($checkins as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->kode_reservasi }}</td>
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
                            @if ($row->status_reservasi === null)
                            <span class="badge bg-warning text-dark">Belum Checkin</span>
                            @elseif ($row->status_reservasi == 0)
                            <span class="badge bg-success"> Checkin</span>
                            @elseif ($row->status_reservasi == 1)
                            <span class="badge bg-danger">Checkout</span>
                            @else
                            {{ $row->status_reservasi }}
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#checkOutModal{{ $row->kode_reservasi }}" title="Check Out">
                                <span>Checkout</span>
                            </button>
                            <div class="modal fade" id="checkOutModal{{ $row->kode_reservasi }}" tabindex="-1" aria-labelledby="checkOutModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="checkOutModalLabel">Konfirmasi Check-Out</h5>
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
                                            <form action="{{ route('reservasi.checkout', $row->kode_reservasi) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Yaa, Check-Out</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
