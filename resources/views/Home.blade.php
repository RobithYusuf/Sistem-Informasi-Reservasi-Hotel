@extends('Layout.Semua')

@section('Title', 'Family Inn Hotel')

@section('Konten')


<section class="heroIn">
    <div class="heroIn-content">
        <h1>Selamat Datang Kembali {{ session('nama') }}</h1>
        <p>Nikmati pengalaman menginap yang tak terlupakan bersama kami</p>
        <a href="https://api.whatsapp.com/send?phone=+6281367175908&text=Hallo Admin!%0ASaya ingin memesan kamar.%0AApakah bisa?" class="heroIn-content-btn">Hubungi Kami</a>
    </div>
</section>

<section class="reservation">
    <div class="container" style="margin-top: 1rem;">
        @if($errors->any())
        <div id="errorMessages" style="display: none;">
            {{ implode('|', $errors->all()) }}
        </div>
        @endif
        <form id="reservationForm" action="{{ route('form.reservasi') }}" method="POST" onsubmit="return validateAndSubmitForm()">
            @csrf
            <div class="form-group">
                <label for="check-in">Check-in</label>
                <input type="date" id="check-in" name="check_in" required>
            </div>
            <div class="form-group">
                <label for="check-out">Check-out</label>
                <input type="date" id="check-out" name="check_out" required>
            </div>
            <div class="form-group">
                <label for="jenis_kamar">Tipe</label>
                <select id="jenis_kamar" name="jenis_kamar" required>
                    <option value="" disabled selected>Pilih Tipe Kamar</option>
                    <option value="" disabled>Pilih tgl terlebih dahulu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_kamar">Jumlah Kamar</label>
                <input type="number" id="jumlah_kamar" name="jumlah_kamar" min="1" placeholder=" Jumlah" required>
            </div>
            <button type="submit" class="btn_book">Book Now</button>
        </form>
    </div>
</section>

<div class="container-room">
    <span>ROOM'S</span>
    <section class="features2">
        <div class="feature2">
            <img src="{{ asset('img/SUPERIOR/SUPERIOR (1).jpg') }}" alt="">
            <div class="harga">Rp350.000/Malam</div>
            <h3>Superior Room</h3>
            <div class="ps-2">
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star"></small>
            </div>
            <div class="d-flex-mb-3">
                <small class="feature-icon"><i class="fa fa-bed text-primary me-2"></i>1 Bed |</small>
                <small class="feature-icon"><i class="fa fa-bath text-primary me-2"></i>1 Bath |</small>
                <small class="feature-icon"><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
            </div>
            <table border-collapse="collapse">
                <tr>
                    <td>Bed Size</td>
                    <td>:</td>
                    <td>2m x 2m(One king-sized bed)</td>
                </tr>
                <tr>
                    <td>Kapasitas</td>
                    <td>:</td>
                    <td>2 Person</td>
                </tr>
                <tr>
                    <td>Space</td>
                    <td>:</td>
                    <td>60 m2</td>
                </tr>
                <tr>
                    <td>View</td>
                    <td>:</td>
                    <td>Kebun atau Kolam Renang</td>
                </tr>
            </table>
            <a href="{{ url('/rooms/superior-room') }}" class="hero1-content-btn">Lihat Detail</a>
        </div>
        <div class="feature2">
            <img src="{{ asset('img/DELUXE/DELUXE (1).jpg') }}" alt="deluks-singel">
            <div class="harga">Rp400.000/Malam</div>
            <h3>Deluxe Room</h3>
            <div class="ps-2">
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star"></small>
            </div>
            <div class="d-flex-mb-3">
                <small class="feature-icon"><i class="fa fa-bed text-primary me-2"></i>2 Bed |</small>
                <small class="feature-icon"><i class="fa fa-bath text-primary me-2"></i>1 Bath |</small>
                <small class="feature-icon"><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
            </div>
            <table border-collapse="collapse">
                <tr>
                    <td>Bed Size</td>
                    <td>:</td>
                    <td>1.2m x 2m(Two Single beds)</td>
                </tr>
                <tr>
                    <td>Kapasitas</td>
                    <td>:</td>
                    <td>2 Person</td>
                </tr>
                <tr>
                    <td>Space</td>
                    <td>:</td>
                    <td>80 m2</td>
                </tr>
                <tr>
                    <td>View</td>
                    <td>:</td>
                    <td>Kolam Renang</td>
                </tr>
            </table>
            <a href="{{ url('rooms/delux-room') }}" class="hero1-content-btn">Lihat Detail</a>
        </div>
        <div class="feature2">
            <img src="{{ asset('img/VIP DELUXE/VIP DELUXE (1).jpg') }}" alt="Deluks-queen">
            <div class="harga">Rp500.000/Malam</div>
            <h3>VIP Duluxe</h3>
            <div class="ps-2">
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star"></small>
            </div>
            <div class="d-flex-mb-3">
                <small class="feature-icon"><i class="fa fa-bed text-primary me-2"></i>1 Bed |</small>
                <small class="feature-icon"><i class="fa fa-bath text-primary me-2"></i>2 Bath |</small>
                <small class="feature-icon"><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
            </div>
            <table border-collapse="collapse">
                <tr>
                    <td>Bed Size</td>
                    <td>:</td>
                    <td>2m x 2m(One king-sized bed)</td>
                </tr>
                <tr>
                    <td>Kapasitas</td>
                    <td>:</td>
                    <td>2 Person</td>
                </tr>
                <tr>
                    <td>Space</td>
                    <td>:</td>
                    <td>100 m2</td>
                </tr>
                <tr>
                    <td>View</td>
                    <td>:</td>
                    <td>Kolam Renang</td>
                </tr>
            </table>
            <a href="{{ url('rooms/vip-delux') }}" class="hero1-content-btn">Lihat Detail</a>
        </div>
        <div class="feature2">
            <img src="{{ asset('img/FAMILY SUITE/FAMILY SUITE (1).jpg') }}" alt="">
            <div class="harga">Rp550.000/Malam</div>
            <h3>Family Suite</h3>
            <div class="ps-2">
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
            </div>
            <div class="d-flex-mb-3">
                <small class="feature-icon"><i class="fa fa-bed text-primary me-2"></i>2 Bed |</small>
                <small class="feature-icon"><i class="fa fa-bath text-primary me-2"></i>2 Bath |</small>
                <small class="feature-icon"><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
            </div>
            <table border-collapse="collapse">
                <tr>
                    <td>Bed Size</td>
                    <td>:</td>
                    <td> 1.2m x 2m (Two Single beds)</td>
                </tr>
                <tr>
                    <td>Kapasitas</td>
                    <td>:</td>
                    <td>2 Person</td>
                </tr>
                <tr>
                    <td>Space</td>
                    <td>:</td>
                    <td>120 m2</td>
                </tr>
                <tr>
                    <td>View</td>
                    <td>:</td>
                    <td>Kota, Kebun atau Kolam Renang</td>
                </tr>
            </table>
            <a href="{{ url('rooms/family-suite') }}" class="hero1-content-btn">Lihat Detail</a>
        </div>
        <div class="feature2">
            <img src="{{ asset('img/EXECUTIVE/EXECUTIVE (1).jpg') }}" alt="eksekutif-king">
            <div class="harga">Rp600.000/Malam</div>
            <h3>Executive Suite</h3>
            <div class="ps-2">
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
                <small class="fa fa-star checked"></small>
            </div>
            <div class="d-flex-mb-3">
                <small class="feature-icon"><i class="fa fa-bed text-primary me-2"></i>1 Bed |</small>
                <small class="feature-icon"><i class="fa fa-bath text-primary me-2"></i>2 Bath |</small>
                <small class="feature-icon"><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
            </div>
            <table border-collapse="collapse">
                <tr>
                    <td>Bed Size</td>
                    <td>:</td>
                    <td>2m x 2m(One king-sized bed)</td>
                </tr>
                <tr>
                    <td>Kapasitas</td>
                    <td>:</td>
                    <td>2 Person</td>
                </tr>
                <tr>
                    <td>Space</td>
                    <td>:</td>
                    <td>140 m2</td>
                </tr>
                <tr>
                    <td>View</td>
                    <td>:</td>
                    <td>Kota, Kebun atau Kolam Renang</td>
                </tr>
            </table>
            <a href="{{ url('rooms/executive-suite') }}" class="hero1-content-btn">Lihat Detail</a>
        </div>
    </section>
</div>

@push('script')
<script src="{{ asset('js/slider.js') }}"></script>
@endpush
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateToday() {
            const today = new Date().toLocaleDateString('en-CA'); // Menggunakan format 'YYYY-MM-DD'
            document.getElementById('check-in').setAttribute('min', today);
            document.getElementById('check-out').setAttribute('min', today);
        }
        // Memperbarui 'today' setiap menit
        setInterval(updateToday, 60000);
        // Panggil sekali saat memuat
        updateToday();
        const checkInInput = document.getElementById('check-in');
        const checkOutInput = document.getElementById('check-out');
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
</script>

<script>
    function validateAndSubmitForm() {


        // Ambil nilai dari form
        var checkIn = document.getElementById('check-in').value;
        var checkOut = document.getElementById('check-out').value;
        var jenisKamar = document.getElementById('jenis_kamar').value;

        var jumlahKamar = document.getElementById('jumlah_kamar').value;

        // Membuat pesan konfirmasi
        var pesanKonfirmasi =
            'Check-In: ' + checkIn + '<br>' +
            'Check-Out: ' + checkOut + '<br>' +
            'Tipe Kamar: ' + jenisKamar + '<br>' +
            'Jumlah Kamar: ' + jumlahKamar;

        Swal.fire({
            title: 'Booking Confirmation',
            html: pesanKonfirmasi, // Gunakan 'html' bukan 'text'
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Book Now',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reservationForm').submit();
            }
        });


        return false;
    }
</script>
@if(session('message'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Informasi Reservasi',
            text: "{{ session('message') }}",
            icon: 'success',
            confirmButtonText: 'OK',
            showCancelButton: true, // Menampilkan tombol cancel
            cancelButtonText: 'Lihat Pesanan', // Teks untuk tombol tambahan
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                // Jika tombol tambahan diklik, arahkan ke halaman pesanan
                window.location.href = '/pesanan';
            }
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
