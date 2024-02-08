<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Title', 'Landing Page')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('css/Nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
    <link rel="stylesheet" href="{{ asset('css/FormReservasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Rooms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/team.css') }}">
    <link rel="stylesheet" href="{{ asset('css/panduan.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ url('/img/logo2.png') }}">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ Auth::check() ? '/home' : '/' }}">
                    <img src="{{ asset('img/Logo Family Inn1.png') }}" alt="logo" width="auto" height="auto">
                </a>
                <div class="menu-btn" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <i class="fas fa-bars"></i>
                </div>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @auth
                            <a class="nav-link {{ Request::is('home') ? 'active' : ''}}" href="/home"><i class="fas fa-home"></i> Home</a>
                            @else
                            <a class="nav-link {{ Request::is('home') ? 'active' : ''}}" href="/"><i class="fas fa-home"></i> Home</a>
                            @endauth
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('about') ? 'active' : ''}}" href="/about"><i class="fas fa-users"></i> About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('kontak') ? 'active' : ''}}" href="/kontak"><i class="fas fa-info-circle"></i> Kontak</a>
                        </li>
                        <li class="nav-item">
                            @auth
                            <a class="nav-link {{ Request::is('pesanan') ? 'active' : ''}}" href="/pesanan"><i class="fas fa-shopping-cart"></i> Pesanan</a>
                            @endauth
                        </li>

                        <li class="nav-item">
                            @auth
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/dashboard') }}" class="btn_Out" id="bl">
                                <i class="fas fa-grid"></i> Dashboard
                            </a>
                            @else
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" style="background-color: transparent; border: 0px"><a class="btn_Out" id="bl">Keluar! <i class="fas fa-sign-out-alt"></i></a></button>
                            </form>
                            @endif
                            @else
                            <form action="{{ url('/login') }}" method="GET">
                                @csrf
                                <button type="submit" style="background-color: transparent; border: 0px"><a class="btn_In" id="bl"><i class="fas fa-sign-in-alt"></i> Masuk!</a></button>
                            </form>
                            @endauth
                        </li>


                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('Konten')
    </main>
    <div class="floating-button-container">
        <a href="https://api.whatsapp.com/send?phone=+6281367175908&text=Hallo Admin!%0ASaya ingin memesan kamar.%0AApakah bisa?" class="floating-button">
            <i class="fab fa-whatsapp whatsapp-icon"></i>
            <span class="txt">Call Us</span>
        </a>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="{{ asset('img/logo2.png') }}" alt="footer_logo">
            </div>
            <div class="footer-links">
                <h3>Tentang Kami</h3>
                <ul>
                    <li><a href="/about">Sejarah</a></li>
                    <li><a href="/team">Tim Kami</a></li>
                    <li><a href="#">Karir</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h3>Bantuan</h3>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="/panduan">Panduan Pemesanan</a></li>
                    <li><a href="#">Layanan Pelanggan</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h3>Pembayaran</h3>
                <ul>
                    <li><a href="#">Metode Pembayaran</a></li>
                    <li><a href="#">Kebijakan Pembayaran</a></li>
                    <li><a href="#">Ketentuan Pembayaran</a></li>
                </ul>
            </div>
            <div class="footer-social">
                <h3>Temukan Kami</h3>
                <ul>
                    <li><a href="https://www.facebook.com/HotelFamilyInn/"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/familyinnhotell/"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=+6281367175908&text=Hallo Admin!%0ASaya ingin memesan kamar.%0AApakah bisa?"><i class="fab fa-whatsapp"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Hak Cipta &copy; 2024 Family Inn Hotel. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/nav.js') }}"></script>

<!-- <script src="{{ asset('js/slider.js') }}"></script> -->

    @stack('script')
</body>

</html>
