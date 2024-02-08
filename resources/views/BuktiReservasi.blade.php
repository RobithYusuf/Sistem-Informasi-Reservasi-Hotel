@extends('Layout.Semua')

@section('Title', 'Bukti Reservasi')

@section('Konten')

<div class="container mt-3" align='center'>
    <section class="features">
        <div class="feature1" style="width:60%;">
            <h3 class="mb-4">Data Reservasi Anda</h3>

            <div class="p-4" id="buktiRes" style="background-color: #f8f9fa; border: 1px solid #e3e6f0; border-radius: .35rem;  text-overflow: ellipsis;  overflow: hidden;">
                <!-- Hotel Info and Details -->
                <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
                    <tr>
                        <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                            <span style='font-size:13pt'><b>Family Inn Hotel</b></span><br>
                            Jln. Jend sudirman Km. 2, Simpang 4 Kantor Bupati Merangin,<br>Kota Bangko, Kabupaten Merangin, Provinsi Jambi 37313 <br>
                            telp: +62 822-8520-0054
                        </td>
                        <td width='30%' align='left' style='vertical-align:top'>
                            <b><span style='font-size:13pt'>Details</span></b><br>
                            Kode Reservasi : <span style="border-bottom: 1px solid red;">{{ $latestReservasi->kode_reservasi }}</span><br>
                            Tanggal : {{ $latestReservasi->created_at->format('d F Y') }}<br>
                            Jumlah Kamar : {{ $latestReservasi->jumlah_kamar }}
                        </td>
                    </tr>
                </table>

                <!-- Customer Info -->
                <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse; margin-top: 10px; margin-bottom: 10px;' border='0'>
                    <tr>
                        <td width='30%' align='left' style='padding-right:80px; vertical-align:top'>
                            Nama Pelanggan : {{ $latestReservasi->nama_tamu }}<br>
                            No Telp : {{ $latestReservasi->no_hp }}
                        </td>
                    </tr>
                </table>

                <!-- Reservation Details -->
                <div class="table-responsive" style="margin-top: -10px;">
                    <table cellspacing='0' style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='1' class="detailsRes mt-3">
                        <tr align='center' style="background-color: #a7a7a7">
                            <td style="border: 1px solid black;" width='20%'>Tipe Kamar</td>
                            <td style="border: 1px solid black;" width='20%'>Harga/Kamar</td>
                            <td style="border: 1px solid black;" width='20%'>Check-In</td>
                            <td style="border: 1px solid black;" width='20%'>Check-Out</td>
                            <td style="border: 1px solid black;" width='20%'>Total Harga</td>
                        </tr>
                        <tr align='center' style="background-color: #ffffff;">
                            <td style="border: 1px solid black;">{{ $latestReservasi->jenis_kamar }}</td>
                            <td style="border: 1px solid black;">{{ 'Rp ' . number_format($latestReservasi->harga, 0, ',', '.') }}</td>
                            <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($latestReservasi->checkIn)->format('d M Y') }}</td>
                            <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($latestReservasi->checkOut)->format('d M Y') }}</td>
                            <td style="border: 1px solid black;">{{ 'Rp ' . number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                        </tr>
                        <tr style="background-color: #ffffff; border: 1px solid black;">
                            <td colspan='6' style='text-align:right; padding:5px;'>
                                <b>Total Yang Harus Dibayar : <span style="border-bottom: 1px solid red;">{{ 'Rp ' . number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span></b>
                            </td>
                        </tr>

                    </table>
                </div>
                <small style="font-size: 9pt; font-family: calibri; margin-top: 2px; display: block;">Note:<br>
                    <small style="font-size:8pt; font-style:italic;">*Silahkan lakukan pembayaran pada menu pesanan<br>
                        *atau datang langsung ke hotel dengan menunjukan bukti Reservasi</small></small>
            </div>
            <div class="button-bukti mt-3 d-flex justify-content-end">
                <button class="btn btn-success" onclick="redirectToBeranda()">Selesai</button>
                <button class="btn btn-success" onclick="redirectToPesanan()">Bayar Sekarang</button>
                <button class="btn btn-primary" onclick="printBuktiRes()">Print Reservasi</button>
            </div>
        </div>
    </section>
</div>
<script>
    function redirectToBeranda() {
        window.location.href = '/redirect-to-home';
    }

    function redirectToPesanan() {
        window.location.href = '/redirect-to-pesanan';
    }


    function printBuktiRes() {
        // Buka jendela baru
        var newWindow = window.open('', '_blank');

        // Isi konten jendela baru dengan HTML bukti reservasi
        newWindow.document.write('<title>Bukti Reservasi</title>');
        newWindow.document.write(document.getElementById('buktiRes').innerHTML);

        // Panggil fungsi print pada jendela baru
        newWindow.print();

        // Tutup jendela baru setelah pencetakan
        newWindow.close();
    }
</script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

@endsection
