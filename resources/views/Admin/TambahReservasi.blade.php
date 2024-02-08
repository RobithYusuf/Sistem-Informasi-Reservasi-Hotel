@extends('Admin.Layout.main')

@section('Title', 'Tambah Reservasi')

@section('admin-konten')
<style>
    /* required red */
    .form-outline .required::after {
        content: "*";
        color: red;
        padding-left: 5px;
    }
</style>
<div class="row mt-4">
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambahkan Data Reservasi</h6>
            </div>
            <div class="card-body">
                @if($errors->any())
                <div id="errorMessages" style="display: none;">
                    {{ implode('|', $errors->all()) }}
                </div>
                @endif
                <div class="table-responsive border">
                    <form id="reservasi-form" style="max-width: 650px; margin: auto;" action="{{ route('admin.reservasi.store') }}" method="POST">
                        @csrf

                        <!-- Detail Reservasi -->
                        <h5 class="mb-3">Detail Reservasi</h5>
                        <div class="row">
                            <!-- Check-In -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="checkIn">Check-In</label>
                                <input type="date" id="checkIn" class="form-control" name="checkIn" required />
                            </div>
                            <!-- Check-Out -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="checkOut">Check-Out</label>
                                <input type="date" id="checkOut" class="form-control" name="checkOut" required />
                            </div>

                            <!-- Jenis Reservasi -->
                            <div class="col-md-6 form-outline mb-3 form-group">
                                <label class="form-label required" for="jenis_kamar">Pilih Tipe Kamar</label>
                                <select id="jenis_kamar" class="form-control" name="jenis_kamar" required>
                                    <option value="" disabled selected>Pilih Tipe Kamar</option>
                                    <option value="" disabled>Pilih tanggal terlebih dahulu</option>
                                </select>
                            </div>

                            <!-- Jumlah Kamar -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="jumlah_kamar">Jumlah Kamar yang dipesan</label>
                                <input type="number" id="jumlah_kamar" class="form-control" name="jumlah_kamar" placeholder="Masukkan jumlah kamar" required />
                            </div>
                            <!-- Harga Kamar Permalam -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="harga_per_kamar">Harga Kamar Permalam</label>
                                <input type="text" id="harga_per_kamar" class="form-control" name="harga_per_kamar" placeholder="Harga permalam" readonly />
                            </div>
                            <!-- Total Harga -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="total_harga">Total Harga</label>
                                <input type="text" id="total_harga" class="form-control" name="total_harga" placeholder="Jumlah harga yang dibayar" readonly />
                            </div>

                        </div>

                        <!-- Data Diri -->
                        <h5 class="mb-3">Data Diri</h5>
                        <div class="row">
                            <!-- No KTP -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="no_ktp">No KTP</label>
                                <input type="text" id="no_ktp" class="form-control" name="no_ktp" placeholder="Masukkan No KTP" required />
                            </div>
                            <!-- Nama Tamu -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="nama_tamu">Nama Tamu</label>
                                <input type="text" id="nama_tamu" class="form-control" name="nama_tamu" placeholder="Masukkan Nama Tamu" required />
                            </div>
                            <!-- No HP -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="no_hp">No Handphone</label>
                                <input type="text" id="no_hp" class="form-control" name="no_hp" placeholder="Masukkan No HP" required />
                            </div>

                            <!-- Status Reservasi -->
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label required" for="status_reservasi">Status Reservasi</label>
                                <select id="status_reservasi" class="form-control" name="status_reservasi" onchange="checkStatus()" required>
                                    <option value="" disabled selected>Pilih Status Reservasi</option>
                                    <option value="0">Check In Sekarang</option>
                                    <option value="">Check In Nanti</option>

                                    <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary" style="margin-right: 5px;">Kembali</a>
                                <button type="button" class="btn btn-primary" onclick="submitForm()">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk memperbarui tanggal min (minimal) pada input check-in dan check-out
        function updateToday() {
            const today = new Date().toLocaleDateString('en-CA'); // Menggunakan format 'YYYY-MM-DD'
            document.getElementById('checkIn').setAttribute('min', today);
            document.getElementById('checkOut').setAttribute('min', today);
        }
        // Memperbarui 'today' setiap menit
        setInterval(updateToday, 60000);
        // Panggil sekali saat memuat
        updateToday();
        const checkInInput = document.getElementById('checkIn');
        const checkOutInput = document.getElementById('checkOut');
        const jenisKamarSelect = document.getElementById('jenis_kamar');

        checkInInput.addEventListener('change', fetchJenisKamar);
        checkOutInput.addEventListener('change', fetchJenisKamar);

        function fetchJenisKamar() {
            const checkInValue = checkInInput.value;
            const checkOutValue = checkOutInput.value;

            if (checkInValue && checkOutValue) {
                const url = `/get-jenis-kamar?check_in=${checkInValue}&check_out=${checkOutValue}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        updateJenisKamarOptions(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function updateJenisKamarOptions(data) {
            while (jenisKamarSelect.options.length > 1) {
                jenisKamarSelect.remove(1);
            }

            data.forEach(jenis => {
                const option = document.createElement('option');
                option.value = jenis.jenis_kamar;
                option.textContent = `${jenis.jenis_kamar} (${jenis.jumlah_kamar_tersedia})`; // Menambahkan jumlah kamar
                option.setAttribute('data-price', jenis.harga); // Set harga per kamar
                jenisKamarSelect.appendChild(option);
            });

            if (data.length === 0) {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Tidak ada kamar tersedia';
                option.disabled = true;
                jenisKamarSelect.appendChild(option);
            }

            jenisKamarSelect.disabled = false;
        }


    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('checkIn').addEventListener('change', updateTotalPrice);
        document.getElementById('checkOut').addEventListener('change', updateTotalPrice);
        document.getElementById('jenis_kamar').addEventListener('change', updateRoomPriceAndTotal);
        document.getElementById('jumlah_kamar').addEventListener('input', updateTotalPrice);
    });

    function updateRoomPriceAndTotal() {
        updateRoomPrice();
        updateTotalPrice();
    }

    function updateRoomPrice() {
        var selectedRoomType = document.getElementById('jenis_kamar');
        var selectedOption = selectedRoomType.options[selectedRoomType.selectedIndex];
        var price = selectedOption.getAttribute('data-price');
        document.getElementById('harga_per_kamar').value = price;
    }


    function updateTotalPrice() {
        var checkIn = document.getElementById('checkIn').value;
        var checkOut = document.getElementById('checkOut').value;
        var hargaPerKamar = parseFloat(document.getElementById('harga_per_kamar').value.replace(/[^0-9.-]+/g, ""));
        var jumlahKamar = parseInt(document.getElementById('jumlah_kamar').value);

        // Check for NaN in jumlahKamar and replace it with a default value (e.g., 0)
        if (isNaN(jumlahKamar)) {
            jumlahKamar = 0;
            document.getElementById('jumlah_kamar').value = ''; // Optional: Clear the field
        }

        if (checkIn && checkOut && !isNaN(hargaPerKamar) && jumlahKamar > 0) {
            var checkInDate = new Date(checkIn);
            var checkOutDate = new Date(checkOut);
            var timeDiff = checkOutDate.getTime() - checkInDate.getTime();
            var selisihHari = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (selisihHari > 0) {
                var totalHarga = selisihHari * hargaPerKamar * jumlahKamar;
                document.getElementById('total_harga').value = 'Rp ' + totalHarga.toLocaleString('id-ID');
            }
        } else {
            // Clear the total price if the calculation criteria are not met
            document.getElementById('total_harga').value = '';
        }

    }
</script>

<script>
    function submitForm() {
        var form = document.getElementById('reservasi-form');
        form.classList.add('was-validated');

        if (form.checkValidity() === false) {
            // Jika formulir tidak valid, tampilkan pesan peringatan SweetAlert
            Swal.fire({
                title: 'Perhatian!',
                text: 'Harap lengkapi semua data yang diperlukan.',
                icon: 'warning',
                confirmButtonText: 'Ok'
            });
        } else {
            // Jika formulir valid, ambil nilai dari masing-masing elemen formulir
            var checkIn = document.getElementById('checkIn').value;
            var checkOut = document.getElementById('checkOut').value;
            var jenisKamar = document.getElementById('jenis_kamar').value;
            var jumlahKamar = document.getElementById('jumlah_kamar').value;
            var hargaPerKamar = document.getElementById('harga_per_kamar').value;
            var totalHarga = document.getElementById('total_harga').value;
            var noKTP = document.getElementById('no_ktp').value;
            var namaTamu = document.getElementById('nama_tamu').value;
            var noHP = document.getElementById('no_hp').value;


            // Tampilkan konfirmasi SweetAlert dengan data yang diinput
            Swal.fire({
                title: 'Konfirmasi Reservasi',
                html: `
                    <strong>Detail Reservasi</strong><br>
                    Check-In: ${checkIn}<br>
                    Check-Out: ${checkOut}<br>
                    Jenis Kamar: ${jenisKamar}<br>
                    Jumlah Kamar: ${jumlahKamar}<br>
                    Harga Per Kamar: ${hargaPerKamar}<br>
                    Total Harga: ${totalHarga}<br><br>
                    <strong>Data Diri</strong><br>
                    No KTP: ${noKTP}<br>
                    Nama Tamu: ${namaTamu}<br>
                    No HP: ${noHP}<br><br>

                    Apakah Anda yakin dengan data ini?
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tambah',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirim formulir
                    form.submit();
                }
            });
        }
    }
</script>



@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorContainer = document.getElementById('errorMessages').innerText;
        var errors = errorContainer.split('|');
        var errorMessageHtml = errors.join('<br/>');

        Swal.fire({
            title: 'Error!',
            html: errorMessageHtml,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif


@endsection
