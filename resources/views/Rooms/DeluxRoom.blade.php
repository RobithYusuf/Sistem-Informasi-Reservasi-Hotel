@extends('Layout.Semua')

@section('Title', 'Deluxe Room')

@section('Konten')
<section class="hero3">
        <div class="hero3-content">
            <h1>Deluxe <span>Room</span></h1>
        </div>
    </section>

    <!-- Bagian Galeri Foto -->
    <div class="container-gallery">
        <div class="gallery-left">
            <div class="gallery-item">
                <img src="{{ asset('img/DELUXE/DELUXE (1).jpg') }}" alt="Photo 1">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 6" style="width: 33%; height: auto;">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 7" style="width: 33%; height: auto;">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 8" style="width: 33%; height: auto;">  
            </div>
        </div>
        <div class="gallery-right">
            <div class="gallery-item">
                <img src="{{ asset('img/DELUXE/DELUXE (2).jpg') }}" alt="Photo 2">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/DELUXE/DELUXE (3).jpg') }}" alt="Photo 3">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/DELUXE/DELUXE (4).jpg') }}" alt="Photo 4">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 5" style="height: 88.5%;">
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
        <p>Deluxe menawarkan pengalaman menginap dengan suasana kamar yang mewah dan memberikan penuh kenyamanan.
            Dilengkapi dengan balkoni pribadi yang dapat menjadi tempat bersantai di bawah hangatnya matahari saat menikmati
            pemandangan segarnya warna biru kolam renang. Kamar Deluxe menghadirkan desain interior yang elegan dari
            perpaduan warna-warna netral yang hangat dan akan membuat pengalaman menginap menjadi lebih tenang.</p>
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
                <li>Meja kerja</li>
                <li>Mini bar gratis (minuman non-alkohol saja)</li>
            </ul>
        </div>
        <div class="fas">
            <p>Untuk kenyamanan anda</p>
            <ul class="b">
                <li>Perlengkapan mandi standar</li>
                <li>Jubah mandi dan sandal</li>
                <li>Pengering rambut</li>
                <li>Shower dan bathtub</li>
                <li>AC dengan pengontrol suhu</li>
            </ul>
        </div>
        <div class="fas">
            <p>Untuk memanjakan anda</p>
            <ul class="c">
                <li>Mesin espresso</li>
                <li>Fasilitas membuat kopi dan teh</li>
                <li>Televisi kabel 42 inci dilengkapi dengan 50 saluran</li>
                <li>Balkon pribadi</li>
                <li>Kursi lengan dan sandaran</li>
            </ul>
        </div>
    </section><br>
@endsection