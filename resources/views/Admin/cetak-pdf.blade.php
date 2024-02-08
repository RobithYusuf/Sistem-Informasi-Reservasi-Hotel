<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan</title>
    <link rel="icon" type="image/x-icon" href="{{ url('/img/logo2.png') }}">
    <link href="{{ asset('css/CetakPDF.css') }}" rel="stylesheet">
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="logo left">
                <img src="{{ url('/img/logo.png') }}" alt="Left Logo">
            </div>
            <div class="title">
                <span class="logo-title">Sistem Informasi Pemesanan Hotel</span>
                <span class="alamat">Jalan. Jend sudirman Km. 2 , Simpang 4 Kantor Bupati Merangin, </span>
                <span class="alamat">Kota Bangko, Kabupaten Merangin, Provinsi Jambi 37313</span>
                <span class="kontak">Instagram: familyinnhotell, telp: +62 822-8520-0054</span>
            </div>

        </div>
        <hr>
        <div class="header">
            <div class="title2">
                <h3>Laporan Tamu Hotel</h3>
            </div>
        </div>
        <p class="info-text1">
            <b>Dari:</b> {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} <b>Sampai:</b> {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}
        </p>

        <p class="info-text2">
            <b> Total Data:</b> {{ $totalRows }}
        </p>

        <table class="info-table text-center text-nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Reservasi</th>
                    <th>Nama Tamu</th>
                    <th>No Handphone</th>
                    <th>Type Kamar</th>
                    <th>Harga</th>
                    <th>Check-in</th>
                    <th>Check-Out</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->kode_reservasi }}</td>
                    <td>{{ $row->nama_tamu }}</td>
                    <td>{{ $row->no_hp }}</td>
                    <td>{{ $row->jenis_kamar }}</td>
                    <td>{{ 'Rp ' . number_format($row->harga, 0, ',', '.') }}</td>
                    <td>{{ $row->checkIn }}</td>
                    <td>{{ $row->checkOut }}</td>
                    <td class="text-center">
                        {{ $row->pembayaran && $row->pembayaran->jumlah_bayar !== null
                ? 'Rp ' . number_format($row->pembayaran->jumlah_bayar, 0, ',', '.')
                : '-' }}
                    </td>
                    <td>
                        @if ($row->status_reservasi === null)
                        <span class="badge badge-custom bg-warning-custom">Belum Checkin</span>
                        @elseif ($row->status_reservasi == 0)
                        <span class="badge badge-custom bg-success-custom">Checkin</span>
                        @elseif ($row->status_reservasi == 1)
                        <span class="badge badge-custom bg-danger-custom">Checkout</span>
                        @else
                        Tidak diketahui!
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center">Tidak ada data reservasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <small class="date">Tanggal Laporan: {{ date('d/m/Y H:i') }} WIB</small>
        @auth
        <small style="float: right; font-size: 12px; color: #6c757d;">Dibuat oleh : {{ Auth::user()->name }}</small>
        @endauth
        <div class="footer">
            <p>&copy; 2024 Family Inn Hotel</p>
        </div>
        <script>
            window.onload = function() {
                window.print();
            }
        </script>
    </div>
</body>

</html>