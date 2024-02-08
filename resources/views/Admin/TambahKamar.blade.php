@extends('Admin.Layout.main')

@section('Title', 'Tambah Kamar')

@section('admin-konten')
<div class="row mt-4">
    <div class="container-fluid">
        <div class="container-fluid">

        </div>
        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambahkan Data Kamar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive border">
                    <form style="max-width: 650px; margin: auto;" action="insert" method="POST">
                        @csrf
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6">
                                <!-- Kode Kamar -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="kode_kamar">Kode Kamar</label>
                                    <input type="text" id="kode_kamar" class="form-control" name="kode_kamar" />
                                </div>

                                <!-- Tipe Kamar -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="jenis_kamar">Tipe Kamar</label>
                                    <input type="text" id="jenis_kamar" class="form-control" name="jenis_kamar" />
                                </div>

                                <!-- No Kamar -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="no_kamar">No Kamar</label>
                                    <input type="text" id="no_kamar" class="form-control" name="no_kamar" />
                                </div>
                            </div>

                            <!-- Second Column -->
                            <div class="col-md-6">
                                <!-- Fasilitas -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="fasilitas">Fasilitas</label>
                                    <input type="text" id="fasilitas" class="form-control" name="fasilitas" />
                                </div>

                                <!-- Jumlah Stok -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="jumlah">Jumlah Stok</label>
                                    <input type="number" id="jumlah" class="form-control" name="jumlah" />
                                </div>

                                <!-- Harga Kamar -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="harga">Harga Kamar</label>
                                    <input type="text" id="harga" class="form-control" name="harga" />
                                </div>

                                <!-- Submit button -->
                                <div class="row" >
                                    <!-- Kembali (Back) Button -->
                                    <div class="col-md-12 d-flex justify-content-end">

                                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block" style="margin-right: 5px;">Kembali</a>

                                        <button type="submit" id="btnTambahKmr" class="btn btn-primary btn-block">Tambah</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
