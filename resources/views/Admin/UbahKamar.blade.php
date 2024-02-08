@extends('Admin.Layout.main')

@section('Title', 'Ubah Kamar')

@section('admin-konten')
<div class="row" id="container-kamar">
    <div class="container-fluid">
        <div class="container-fluid">

        </div>
        <!-- Content Row -->
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambahkan Data Kamar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form style="max-width: 600px; margin: auto;" action="{{ route('ubah', $kamar->kode_kamar) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- First Column -->
                            <div class="col-md-6">
                                <!-- Kode Kamar -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="kode_kamar">Kode Kamar</label>
                                    <input type="text" id="kode_kamar" class="form-control" name="kode_kamar" value="{{ $kamar->kode_kamar }}" readonly />
                                </div>

                                <!-- Tipe Kamar -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="jenis_kamar">Tipe Kamar</label>
                                    <input type="text" id="jenis_kamar" class="form-control" name="jenis_kamar" value="{{ $kamar->jenis_kamar }}" />
                                </div>

                                <!-- No Kamar -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="no_kamar">No Kamar</label>
                                    <input type="text" id="no_kamar" class="form-control" name="no_kamar" value="{{ $kamar->no_kamar }}" />
                                </div>
                            </div>

                            <!-- Second Column -->
                            <div class="col-md-6">
                                <!-- Fasilitas -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="fasilitas">Fasilitas</label>
                                    <input type="text" id="fasilitas" class="form-control" name="fasilitas" value="{{ $kamar->fasilitas }}" />
                                </div>

                                <!-- Jumlah Stok -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="jumlah_stok">Jumlah Stok</label>
                                    <input type="number" id="jumlah_stok" class="form-control" name="jumlah_stok" value="{{ $kamar->stokKamar->jumlah ?? 0 }}" />
                                </div>

                                <!-- Harga Kamar -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="harga">Harga Kamar</label>
                                    <input type="text" id="harga" class="form-control" name="harga" value="{{ $kamar->harga }}" />
                                </div>
                            </div>
                        </div>



                        <div class="row ">
                            <!-- Kembali (Back) Button -->
                            <div class="col-md-12 d-flex justify-content-end">

                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block" style="margin-right: 5px;">Kembali</a>

                                <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
