@extends('Admin.Layout.main')

@section('Title', 'Kamar')

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

    #dataTable td.opsi {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 300px;
    }

    /* required red */
    .required::after {
        content: "*";
        color: red;
        padding-left: 5px;
    }

    .keterangan-kalender {
        margin-bottom: 15px;
        /* Atur margin atas */
        padding: 10px;
        /* Atur padding */
        background-color: #f8f9fa;
        /* Warna latar */
        border-radius: 4px;
        /* Border radius */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Shadow box */
    }

    .keterangan-kalender p {
        margin: 5px 0;
        /* Margin atas dan bawah untuk setiap paragraf */
        font-size: 1.4rem;
        /* Ukuran font */
        color: #333;
        /* Warna teks */
    }

    .modal-kalender {
        width: fit-content;
        /* Untuk browser lainnya */
        margin: auto;
    }

    .kalender-grid {
        justify-content: center;
        display: grid;
        margin: 10px auto;
        /* Centers the grid and provides uniform margin */
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        /* Adjusts the column width dynamically */
        grid-auto-rows: minmax(100px, auto);
        /* Ensures all rows are of equal height */
        gap: 10px;
        padding: 10px;
        font-size: 20px;
    }

    .tanggal-ketersediaan {
        border: 1px solid #ccc;
        padding: 15px;
        text-align: center;
        background-color: #ccffcc;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        min-width: 200px;
        /* Set a minimum width for each grid item */
        min-height: 120px;
        /* Set a minimum height for each grid item */
        box-sizing: border-box;
    }

    .modal-title {
        margin: 0;
        font-size: 2rem;
    }

    /* Style untuk footer modal */
    .modal-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e3e6f0;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .btn-close {
        padding: 1rem;
        margin: -1rem -1rem -1rem auto;
        background-color: transparent;
        border: 0;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .kalender-grid {
            margin-left: 5px;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            /* Sesuaikan untuk tampilan tablet */
        }
    }

    @media (max-width: 600px) {
        .modal-kalender {
            max-width: 95vw;
        }

        .kalender-grid {
            margin-left: 5px;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            /* Sesuaikan untuk tampilan ponsel */
        }
    }
</style>
@endpush
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Room's</h1>
</div>


<section>
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kamar Yang Tersedia</h6>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3 px-3">
            <div>
                <a href="{{ route('tambahkamar') }}" class="btn btn-primary px-3 py-2">
                    <span data-feather="plus-square" class="mr-2"></span> Tambah Kamar
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-sm">
                <thead style="background-color: #adb5bd">
                    <tr>
                        <th>No</th>
                        <th>Kode Kamar</th>
                        <th>Type Kamar</th>
                        <th>No Kamar</th>
                        <th>Fasilitas</th>
                        <th>Jumlah Kamar</th>
                        <th>Harga/malam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($data as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->kode_kamar }}</td>
                        <td>{{ $row->jenis_kamar }}</td>
                        <td>{{ $row->no_kamar }}</td>
                        <td>{{ $row->fasilitas }}</td>
                        <td>{{ $row->stokKamar->jumlah ?? 'Data tidak tersedia' }}</td>
                        <td>{{ 'Rp ' . number_format($row->harga, 0, ',', '.') }}</td>
                        <td class="opsi">
                            <center>

                                <button class="btn-lihat-stok btn btn-sm btn-secondary shadow-sm" data-jenis-kamar="{{ $row->jenis_kamar }}">
                                    <span data-feather="eye"></span> Lihat Stok
                                </button>
                                &nbsp;
                                <a href="{{ route('update', ['id' => $row->kode_kamar]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <span data-feather="edit"></span> Edit</a>
                                &nbsp;
                                <a href="javascript:void(0)" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="confirmDelete('{{ route('hapus', ['id' => $row->kode_kamar]) }}', '{{ $row->kode_kamar }}','{{ $row->jenis_kamar }}')">
                                    Hapus <span data-feather="trash-2"></span>
                                </a>


                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable();

        // Add margin to DataTable controls
        $('#dataTable_wrapper .dataTables_length, #dataTable_wrapper .dataTables_filter, #dataTable_wrapper .dataTables_paginate').css('margin-top', '20px');
    });
    // icon feather
    feather.replace();

    function confirmDelete(url, kodeKamar, jenisKamar) {
        Swal.fire({
            title: 'Konfirmasi Penghapusan',
            html: 'Apakah Anda yakin ingin menghapus kamar dengan kode: <strong>' + kodeKamar + ' (' + jenisKamar + ')?</strong><br><br>Tindakan ini akan menghapus data yang berkaitan dan tidak dapat dikembaikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
@endpush

<!-- Modal Pemilihan Bulan -->
<div class="modal fade" id="modalPilihBulan" tabindex="-1" role="dialog" aria-labelledby="modalPilihBulanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modalPilihBulanLabel">Pilih Bulan Untuk Melihat Stok</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPilihBulan">
                    <div class="mb-3">
                        <label for="bulanSelect" class="form-label required">Pilih Stock Untuk Bulan :</label>
                        <select class="form-select" id="bulanSelect" name="bulan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>

                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-end mt-3">Tampilkan Stok</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKalenderStok" tabindex="-1" role="dialog" aria-labelledby="modalKalenderStokLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-kalender" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKalenderStokLabel">Kalender Stok Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="keteranganKalender" class="keterangan-kalender"></div>
                <div id="kalenderKetersediaan" class="kalender-grid"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan semua tombol 'Lihat Stok'
        const stokButtons = document.querySelectorAll('.btn-lihat-stok');

        stokButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                const jenisKamar = event.target.getAttribute('data-jenis-kamar');

                // Simpan jenis kamar yang dipilih ke dalam form
                const bulanSelect = document.getElementById('bulanSelect');
                bulanSelect.setAttribute('data-jenis-kamar', jenisKamar);

                // Tampilkan modal pemilihan bulan
                $('#modalPilihBulan').modal('show');
            });
        });

        const formPilihBulan = document.getElementById('formPilihBulan');
        formPilihBulan.addEventListener('submit', function(event) {
            event.preventDefault();
            const jenisKamar = bulanSelect.getAttribute('data-jenis-kamar');
            const bulanDipilih = formPilihBulan.querySelector('select[name="bulan"]').value;
            const tahunSekarang = new Date().getFullYear();
            const tanggalMulai = new Date(tahunSekarang, bulanDipilih - 1, 1).toISOString().split('T')[0];
            const tanggalAkhir = new Date(tahunSekarang, bulanDipilih, 0).toISOString().split('T')[0];

            // Tutup modal pemilihan bulan
            $('#modalPilihBulan').modal('hide');

            // Panggil fungsi untuk memuat ketersediaan kamar dengan tanggal yang dipilih
            muatKetersediaanKamarBerdasarkanBulan(tanggalMulai, tanggalAkhir, jenisKamar);
        });
    });

    function bukaModalStok(jenisKamar) {
        muatKetersediaanKamar(jenisKamar);
        var modalStok = new bootstrap.Modal(document.getElementById('modalKalenderStok'));
        modalStok.show();
    }

    function muatKetersediaanKamarBerdasarkanBulan(tanggalMulai, tanggalAkhir, jenisKamar) {
        fetch(`/stok-kamar/${jenisKamar}?start=${tanggalMulai}&end=${tanggalAkhir}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Server returned ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                tampilkanKalender(data.kalender);
                tampilkanKeterangan(data.keterangan);
                // Tampilkan modal utama dengan stok kamar
                $('#modalKalenderStok').modal('show');
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function tampilkanKeterangan(keterangan) {
        const keteranganContainer = document.getElementById('keteranganKalender');
        keteranganContainer.innerHTML = `
        <p><strong>Jenis Kamar:</strong> ${keterangan.jenisKamar}</p>
        <p><strong>Stok Kamar untuk Periode:</strong> ${keterangan.periode}</p>
        <p><strong>Harga per Malam:</strong> Rp ${keterangan.harga}</p>
    `;
    }

    function tampilkanKalender(data) {
        const container = document.getElementById('kalenderKetersediaan');
        container.innerHTML = ''; // Bersihkan konten sebelumnya
        container.classList.add('d-flex', 'flex-wrap'); // Tambahkan class untuk flexbox

        // Temukan nilai maksimum dan minimum stok untuk menghitung perbedaan
        const availabilityValues = Object.values(data);
        const maxAvailability = Math.max(...availabilityValues);

        Object.keys(data).forEach(tanggalRaw => {
            const stok = data[tanggalRaw];
            const elemenTanggal = document.createElement('div');
            elemenTanggal.classList.add('tanggal-ketersediaan', 'p-2', 'border', 'm-2');
            elemenTanggal.style.minWidth = '100px'; // Atur minimal lebar elemen

            // Format tanggal dari YYYY-MM-DD ke DD-MM-YYYY dengan strip
            const tanggal = new Date(tanggalRaw);
            const formattedDate = tanggal.getDate().toString().padStart(2, '0') + '-' +
                (tanggal.getMonth() + 1).toString().padStart(2, '0') + '-' +
                tanggal.getFullYear();

            // Menghitung transparansi berdasarkan stok yang tersedia
            let transparency = 1 - (stok / maxAvailability); // Transparansi meningkat ketika stok menurun
            transparency = Math.min(transparency, 0.3); // Batasi transparansi maksimal 30%

            if (stok === 0) {
                // Warna merah untuk stok habis
                elemenTanggal.style.backgroundColor = `rgba(255, 0, 0, ${transparency})`;
            } else if (stok === maxAvailability) {
                // Warna hijau muda untuk stok penuh
                elemenTanggal.style.backgroundColor = `#ccffcc`;
            } else {
                // Warna hijau ke oranye untuk stok yang tersedia
                const greenToOrange = 255 * (1 - transparency); // Warna hijau berkurang dan oranye meningkat
                elemenTanggal.style.backgroundColor = `rgba(255, ${greenToOrange}, 0, ${transparency})`;
            }

            // Tampilkan "Kamar Kosong" jika stok = 0, jika tidak, tampilkan jumlah kamar
            elemenTanggal.innerHTML = `<div class="text-center"><strong>${formattedDate}</strong><br>${stok === 0 ? '&nbsp; Kamar Kosong&nbsp; ' : `${stok} Kamar tersedia`}</div>`;
            container.appendChild(elemenTanggal);
        });
    }
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
