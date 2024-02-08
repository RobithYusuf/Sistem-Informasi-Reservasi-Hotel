@extends('Admin.Layout.main')

@section('Title', 'Pesan')

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
    <h1 class="h2">Customers</h1>
</div>
<!-- Content Row -->
<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kritik Dan Saran</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-sm">
                <thead style="background-color: #adb5bd">
                    <tr>
                        <th>No</th>
                        <th>Nama Tamu</th>
                        <!-- <th>kode_reservasi</th> -->
                        <th>Kontak</th>
                        <th>Subjek</th>
                    </tr>
                    </center>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($data as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->nama }}</td>
                        <!-- <td>{{ $row->kode_reservasi }}</td> -->
                        <td>{{ $row->kontak }}</td>
                        <td>{{ $row->subject }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

@endsection
