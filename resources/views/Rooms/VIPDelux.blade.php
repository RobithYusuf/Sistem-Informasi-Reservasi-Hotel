@extends('Layout.Semua')

@section('Title', 'VIP Delux')

@section('Konten')
<section class="hero4">
        <div class="hero4-content">
            <h1>VIP Deluxe <span>Room</span></h1>
        </div>
    </section>

    <!-- Bagian Galeri Foto -->
    <div class="container-gallery">
        <div class="gallery-left">
            <div class="gallery-item">
                <img src="{{ asset('img/VIP DELUXE/VIP DELUXE (1).jpg') }}" alt="Photo 1">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 6" style="width: 33%; height: auto;">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 7" style="width: 33%; height: auto;">
                <img src="{{ asset('img/kamar.png') }}" alt="Photo 8" style="width: 33%; height: auto;">  
            </div>
        </div>
        <div class="gallery-right">
            <div class="gallery-item">
                <img src="{{ asset('img/VIP DELUXE/VIP DELUXE (2).jpg') }}" alt="Photo 2">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/VIP DELUXE/VIP DELUXE (3).jpg') }}" alt="Photo 3">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('img/VIP DELUXE/VIP DELUXE (4).jpg') }}" alt="Photo 4">
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
        <p>President Suite Cava Hotel dihadirkan untuk memenuhi kebutuhan tamu yang menginginkan pengalaman menginap dengan
            kamar eksklusif yang tidak lupa dengan sentuhan desain atmosfer ruangan yang hangat dan nyaman didalamnya. Kamar
            President Suite dilengkapi dengan interior mewah seperti lantai marmer dan balkoni pribadi yang luas untuk
            bersantai menikmati cerahnya langit Yogyakarta. Terletak di lantai 6 dengan akses connecting room dan lengkap
            dengan fasilitas yang menghibur di dalamnya.</p>
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
                <li>Bakpia gratis</li>
                <li>Televisi kabel 42 inci dilengkapi dengan 50 saluran</li>
                <li>Balkon pribadi</li>
                <li>Kursi lengan dan sandaran</li>
                <li>Ruang Tamu Terpisah</li>
                <li>Set Sofa</li>
            </ul>
        </div>
    </section><br>
@endsection