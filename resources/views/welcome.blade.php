@extends('Layout.Semua')

@section('Title', 'Family Inn Hotel')

@section('Konten')
<section class="heroOut">
    <div class="heroOut-content">
        <h1>Selamat Datang Di Family Inn Hotel</h1>
        <p>Nikmati pengalaman menginap yang tak terlupakan bersama kami</p>
        <a href="https://api.whatsapp.com/send?phone=+6281367175908&text=Hallo Admin!%0ASaya ingin memesan kamar.%0AApakah bisa?" class="heroOut-content-btn">Hubungi Kami</a>
    </div>
</section>

<section class="reservation">
    <div class="container">
        <form action="{{ url('/login') }}">
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
                <label for="Tipe" id="ti">Tipe</label>
                <select id="Tipe" name="Tipe" required>
                    <option value="Tipe">Pilih Tipe Kamar</option>
                    @foreach ($jenisKamar as $jenis)
                    <option value="{{ $jenis->jenis_kamar }}">{{ $jenis->jenis_kamar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_kamar">Jumlah Kamar</label>
                <input type="number" id="jumlah_kamar" name="jumlah_kamar" min="1" placeholder="Jumlah" required>
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


<!-- Bagian Galeri Foto -->
<div class="container-gallery">
    <div class="gallery-left">
        <div class="gallery-item">
            <img src="{{ asset('img/FOTO HOTEL/Hotel (1).jpg') }}" alt="Photo 1" id="slider">
            <a id="btnPrev" class="carousel-control-prev" role="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a id="btnNext" class="carousel-control-next" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="gallery-item">
            <img src="{{ asset('img/FOTO HOTEL/Hotel (5).jpg') }}" alt="Photo 6" style="width: 33%; height: auto;">
            <img src="{{ asset('img/FOTO HOTEL/Hotel (6).jpg') }}" alt="Photo 7" style="width: 33%; height: auto;">
            <img src="{{ asset('img/FOTO HOTEL/Hotel (7).jpg') }}" alt="Photo 8" style="width: 33%; height: auto;">
        </div>
    </div>
    <div class="gallery-right">
        <div class="gallery-item">
            <img src="{{ asset('img/FOTO HOTEL/Hotel (2).jpg') }}" alt="Photo 2">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('img/FOTO HOTEL/Hotel (3).jpg') }}" alt="Photo 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('img/FOTO HOTEL/Hotel (4).jpg') }}" alt="Photo 4">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('img/FOTO HOTEL/Hotel (8).jpg') }}" alt="Photo 5" style="height: 88.5%;">
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookNowButton = document.querySelector('.btn_book'); // Sesuaikan selector jika perlu
        bookNowButton.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah aksi default

            Swal.fire({
                title: 'Please Log In',
                text: 'You need to log in to make a reservation.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Log In',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/login') }}"; // Redirect to login page
                }
            });
        });
    });
</script>


@endsection
