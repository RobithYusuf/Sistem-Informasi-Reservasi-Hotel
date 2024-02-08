@extends('Layout.Semua')

@section('Title', 'Kontak')

@section('Konten')
<div class="container5">
    <h3 class="kontak-title">Kontak Kami</h3>
        <div class="row">
            <div class="column">
                <h6 class="mt-1">Our Social Media:</h6>
                <div class="sosial-container">
                    <ul>
                        <li><a href="https://www.facebook.com/HotelFamilyInn/"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/familyinnhotell/"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://api.whatsapp.com/send?phone=+6281367175908&text=Hallo Admin!%0ASaya ingin memesan kamar.%0AApakah bisa?"><i class="fab fa-whatsapp"></i></a></li>
                        <li><a href="https://www.tiktok.com/@qmack.kau?is_from_webapp=1&sender_device=pc"><i class="fab fa-tiktok"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-telegram"></i></a></li>
                    </ul>
                </div>

                <h6 class="mt-1">Lokasi Kami:</h6>
                <div class="loc">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.242695389873!2d102.27079507448813!3d-2.05885493695751!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2e6d75b8d8b729%3A0xfa66737b4b69aa5!2sFAMILY%20INN%20HOTEL-BANGKO!5e0!3m2!1sid!2sid!4v1700364281952!5m2!1sid!2sid"
                        width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="column">
                <form action="{{ route('kirim.pesan') }}" method="POST" onsubmit="showPopup()">
                    @csrf
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Nama..">

                    <!-- Input tersembunyi untuk menyimpan kode reservasi -->


                    <label for="kode">Kode Reservasi</label>
                    <input type="text" id="kode" name="kode" value="{{ $latestReservasi->kode_reservasi ?? 'tidak ada pesanan' }}" style="background-color: rgb(234,236,244)" readonly>


                    <label for="kontak">Kontak Yang Dapat Dihubungi</label>
                    <input type="text" id="kontak" name="kontak" placeholder="Kontak..">

                    <label for="subject">Subjek</label>
                    <textarea id="subject" name="subject" placeholder="Ketik pesan.." style="height:100px"></textarea>
                    <input type="submit" value="Kirim">
                </form>
            </div>
        </div>
    </div>

    <script>
        function showPopup() {
            alert('Pesan berhasil terkirim!');
        }
    </script>

@endsection
