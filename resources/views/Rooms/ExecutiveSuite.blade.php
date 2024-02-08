@extends('Layout.Semua')

@section('Title', 'Executive Suite Room')

@section('Konten')
<section class="hero6">
        <div class="hero6-content">
            <h1>Executive Suite <span>Room</span></h1>
        </div>
    </section>

    <!-- Bagian Galeri Foto -->
    <div class="container-gallery">
        <div class="gallery-left">
            <div class="gallery-item">
                <img src="{{ asset('img/EXECUTIVE/EXECUTIVE (1).jpg') }}" alt="Photo 1">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 6" style="width: 33%; height: auto;">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 7" style="width: 33%; height: auto;">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 8" style="width: 33%; height: auto;">  
            </div>
        </div>
        <div class="gallery-right">
            <div class="gallery-item">
                <img src="{{ asset('img/EXECUTIVE/EXECUTIVE (2).jpg') }}" alt="Photo 2">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/EXECUTIVE/EXECUTIVE (3).jpg') }}" alt="Photo 3">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/EXECUTIVE/EXECUTIVE (4).jpg') }}" alt="Photo 4">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/EXECUTIVE/EXECUTIVE (5).jpg') }}" alt="Photo 5" style="height: 88.5%;">
            </div>
        </div>
    </div>

    <div class="container-fas-hotel">
        <h2>Fasilitas Hotel yang Menggoda</h2>

        <section class="cards">
            <div class="card">
                <i class="fas fa-bed"></i>
                <h3>Kamar yang Nyaman</h3>
                <p>Rasakan kenyamanan di kamar kami yang luas dan dilengkapi dengan segala kebutuhan untuk istirahat
                    yang sempurna.</p>
            </div>
            <div class="card">
                <i class="fas fa-wifi"></i>
                <h3>Wi-Fi Gratis</h3>
                <p>Tetap terhubung dengan Wi-Fi berkecepatan tinggi secara gratis di seluruh area hotel.</p>
            </div>
            <div class="card">
                <i class="fas fa-utensils"></i>
                <h3>Restoran Mewah</h3>
                <p>Menikmati hidangan lezat di restoran mewah kami yang menawarkan pengalaman kuliner yang tak
                    terlupakan.</p>
            </div>
        </section>
    </div><br>

    <div class="container-Deskripsi">
        <h3>Dengan Balkon</h3>
        <p>Kamar Executive Suite menawarkan suasana yang didambakan para tamu yang ingin menikmati kenyamanan bersantai
            dari keramaian dan kesibukan. Kamar Executive Suite didesain dengan interior modern dan dilengkapi pemandangan yang
            hijau dan indah dari balkoni. Connecting room tersedia dan ketersediaannya dapat dilihat saat check-in.
            Tersedia kasur anak tambahan gratis di dalam kamar.</p>
    </div>
    
    <div class="fasilitas">
        <h3>Fasilitas Dalam Kamar</h3>
    </div>
    <section class="facility">
        <div class="fas">
            <p>Untuk Kemudahan Anda</p>
            <ul class="a">
                <li>Ruang penyimpanan laptop</li>
                <li>Telepon IDD dan voicemail</li>
                <li>Gratis internet berkecepatan tinggi</li>
                <li>Setrika dan papan setrika</li>
                <li>Meja Kerja</li>
                <li>Socket Internasional</li>
            </ul>
        </div>
        <div class="fas">
            <p>Untuk kenyamanan anda</p>
            <ul class="b">
                <li>Perlengkapan mandi standar</li>
                <li>Jubah mandi dan sandal</li>
                <li>Pengering rambut</li>
                <li>Shower</li>
                <li>AC dengan pengontrol suhu</li>
            </ul>
        </div>
        <div class="fas">
            <p>Untuk memanjakan anda</p>
            <ul class="c">
                <li>Fasilitas membuat kopi dan teh</li>
                <li>Bakpia gratis</li>
                <li>Televisi kabel 42 inci dilengkapi dengan 50 saluran</li>
                <li>Balkon pribadi</li>
                <li>Permintaan connecting room berdasarkan ketersediaan pada saat check-in.</li>
            </ul>
        </div>
    </section><br>
@endsection
