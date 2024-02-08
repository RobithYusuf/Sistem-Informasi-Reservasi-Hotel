@extends('Layout.Semua')

@section('Title', 'Form Reservasi')

@section('Konten')

<style>
    /* required red */
    .form-outline-mb-4 .required::after {
        content: "*";
        color: red;
        padding-left: 5px;
    }
</style>


<div class="container">
    <section class="FormReservasi">
        <div class="feature1">
            <h3>Masukkan Data Diri Anda</h3>

            @if($errors->any())
            <div id="errorMessages" style="display: none;">
                {{ implode('|', $errors->all()) }}
            </div>
            @endif

            <form id="reservationForm" action="{{ route('store.reservasi') }}" method="POST" onsubmit="return validateAndSubmitForm()">
                @csrf
                @if(auth()->check())
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                @endif
                <!-- NO KTP -->
                <div class="form-outline-mb-4">
                    <label class="form-label required" for="no_ktp">No KTP</label>
                    <input type="text" id="no_ktp" class="form-control" name="no_ktp" placeholder="Masukan No KTP" required>
                </div>
                <!-- Nama input -->
                <div class="form-outline-mb-4">
                    <label class="form-label required" for="nama_tamu">Nama Tamu</label>
                    <input type="text" id="nama_tamu" class="form-control" name="nama_tamu" placeholder="Masukan Nama Tamu" required>
                </div>

                <!-- No Hp input-->
                <div class="form-outline-mb-4">
                    <label class="form-label required" for="no_hp">No Handphone</label>
                    <input type="text" id="no_hp" class="form-control" name="no_hp" placeholder="Masukan no handphone">
                </div>

                <!-- Tambahkan bagian metode pembayaran di sini -->
                <div class="form-outline-mb-4">
                    <label class="form-label required">Metode Pembayaran</label>
                    <div style="margin-left: 3px;">
                        <input  type="checkbox" id="bayarSekarang" name="metode_pembayaran" value="sekarang">
                        <label for="bayarSekarang">Bayar Sekarang</label>
                        <input style="margin-left: 20px;" type="checkbox" id="bayarCheckin" name="metode_pembayaran" value="checkin">
                        <label for="bayarCheckin">Bayar Saat Check-In</label>
                    </div>
                </div>
                <!-- tipe kamar input -->
                <div class="form-outline-mb-4">
                    <label class="form-label" for="jenis_kamar">Tipe Kamar</label>
                    <input type="text" id="jenis_kamar" class="form-control" name="jenis_kamar" value="{{ $data['jenis_kamar'] }}" style="background-color: rgb(234,236,244)" readonly />
                </div>
                <!-- Jumlah kamar input-->
                <div class="form-outline-mb-4">
                    <label class="form-label" for="jumlah_kamar">Jumlah Kamar</label>
                    <input type="text" id="jumlah_kamar" class="form-control" name="jumlah_kamar" value="{{ $data['jumlah_kamar'] }}" style="background-color: rgb(234,236,244)" readonly />
                </div>
                <!-- Harga -->
                <div class="form-outline-mb-4">
                    <label class="form-label" for="harga">Harga Kamar/Malam</label>
                    <input type="text" id="harga" class="form-control" name="harga" value="{{ $harga }}" style="background-color: rgb(234,236,244)" readonly />
                </div>
                <!-- Checkin -->
                <div class="form-outline-mb-4">
                    <label class="form-label" for="checkIn">Check-In</label>
                    <input type="text" id="checkIn" class="form-control" name="checkIn" value="{{ $data['check_in'] }}" style="background-color: rgb(234,236,244)" readonly />
                </div>
                <!-- Checkout -->
                <div class="form-outline-mb-4">
                    <label class="form-label" for="checkOut">Check-Out</label>
                    <input type="text" id="checkOut" class="form-control" name="checkOut" value="{{ $data['check_out'] }}" style="background-color: rgb(234,236,244)" readonly />
                </div>
                <!-- Total Harga -->
                <div class="form-outline-mb-4">
                    <label class="form-label" for="total_harga">Total Harga</label>
                    <input type="text" id="total_harga" class="form-control" name="total_harga" value="{{ 'Rp '. number_format($totalHarga, 0, ',', '.') }}" style="background-color: rgb(234,236,244)" readonly />
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4" onclick="removeFormat()">Booking</button>
            </form>
        </div>
    </section>
</div>

<script>
    // Fungsi untuk memastikan hanya satu checkbox yang dapat dipilih
    document.getElementById('bayarCheckin').onclick = function() {
        document.getElementById('bayarSekarang').checked = !this.checked;
    };
    document.getElementById('bayarSekarang').onclick = function() {
        document.getElementById('bayarCheckin').checked = !this.checked;
    };
</script>
<!-- Skrip Konfirmasi SweetAlert -->
<script>
    function validateAndSubmitForm() {
        // Ambil nilai dari form (sesuaikan dengan id formulir sebenarnya)
        var noKTP = document.getElementById('no_ktp').value;
        var namaTamu = document.getElementById('nama_tamu').value;
        var noHP = document.getElementById('no_hp').value;

        // Membuat pesan konfirmasi
        var confirmationMessage =
            'Data Diri:' + '<br>' +
            'No KTP: ' + noKTP + '<br>' +
            'Nama Tamu: ' + namaTamu + '<br>' +
            'No Handphone: ' + noHP;

        Swal.fire({
            title: 'Konfirmasi Reservasi',
            html: confirmationMessage,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reservasi Sekarang',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna menekan "Ya", submit formulir
                document.getElementById('reservationForm').submit();
            }
        });

        return false;
    }
</script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = `{{ session('success') }}`;
        Swal.fire({
            title: 'Sukses!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

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
