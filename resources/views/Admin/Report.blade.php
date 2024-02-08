@extends('Admin.Layout.main')

@section('Title', 'Report')

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
    }
</style>
@endpush
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Report</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#dateRangeModal">
                <span data-feather="printer"></span> Cetak PDF
            </button>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateRangeModalLabel">Pilih Rentang Tanggal Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dateRangeForm">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Tanggal Awal :</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Tanggal Akhir :</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" required value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="fa fa-print"></i> Cetak PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tamu</h6>
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
                        <th>Jenis/Type Kamar</th>
                        <th>Harga</th>
                        <th>Check-in</th>
                        <th>Check-Out</th>
                        <th>Total Harga</th>
                        <th>Status Reservasi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($data as $row)
                    <tr>
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
<script>
    document.getElementById('dateRangeForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Ambil nilai tanggal dari form
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        // Konversi string tanggal ke objek Date
        var start = new Date(startDate);
        var end = new Date(endDate);

        // Periksa jika startDate lebih besar dari endDate
        if (start > end) {
            alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir.');
            return; // Hentikan eksekusi lebih lanjut
        }

        // Redirect ke route cetak PDF dengan parameter tanggal
        var pdfUrl = `/cetak-pdf?startDate=${startDate}&endDate=${endDate}`;
        window.open(pdfUrl, '_blank');
    });
</script>



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