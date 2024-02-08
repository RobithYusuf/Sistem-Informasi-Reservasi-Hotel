@extends('Layout.Semua')

@section('Title', 'Bukti Pembayaran')

@section('Konten')

<div class="container mt-3" align='center'>
    <section class="features">
        <div class="feature1" style="width:60%;">
            <h3 class="mb-4">Bukti Pembayaran Reservasi</h3>

            <div class="p-4" id="buktiPemb" style="background-color: #f8f9fa; border: 1px solid #e3e6f0; border-radius: .35rem;  text-overflow: ellipsis;  overflow: hidden;">

                <!-- Hotel Info -->
                <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
                    <tr>
                        <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                            <span style='font-size:13pt'><b>Family Inn Hotel</b></span><br>
                            Jln. Jend sudirman Km. 2, Simpang 4 Kantor Bupati Merangin,<br>Kota Bangko, Kabupaten Merangin, Provinsi Jambi 37313 <br>
                            Telpon : +62 822-8520-0054
                        </td>
                        <td width='30%' align='left' style='vertical-align:top'>
                            <b><span style='font-size:13pt'>Details</span></b><br>
                            Metode Pembayaran : <span style="border-bottom: 1px solid red;">{{ UcFirst($pembayaran->metode_bayar) }}</span><br>
                            Tanggal :{{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d-m-Y') }}<br>
                        </td>
                        </td>
                    </tr>
                </table>

                <!-- Payment Info -->
                <div class="table-responsive">
                    <table cellspacing='0' style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='1' class="detailsPay mt-3">
                        <tr align='center' style="background-color: #a7a7a7">

                            <td style="border: 1px solid black;">Kode Reservasi</td>
                            <td style="border: 1px solid black;">Nama Tamu</td>
                            <td style="border: 1px solid black;">Tanggal Reservasi</td>
                            <td style="border: 1px solid black;">Jumlah Bayar</td>
                            <td style="border: 1px solid black;">Status</td>
                        </tr>
                        <tr align='center' style="background-color: #ffffff;">
                            <td style="border: 1px solid black;">{{ $pembayaran->reservasi->kode_reservasi }}</td>
                            <td style="border: 1px solid black;">{{ $pembayaran->reservasi->nama_tamu }}</td>
                            <td style="border: 1px solid black;"> {{ \Carbon\Carbon::parse($pembayaran->reservasi->checkIn)->format('d-m-Y') }} - {{\Carbon\Carbon::parse($pembayaran->reservasi->checkOut)->format('d-m-Y')}}</td>
                            <td style="border: 1px solid black;">{{ 'Rp ' . number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                            <td style="border: 1px solid black;">{{ $pembayaran->status }}</td>
                        </tr>
                    </table>
                </div>

                <small style="font-size: 9pt; font-family: calibri; margin-top: 2px; display: block;">Note:<br>
                    <small style="font-size:8pt; font-style:italic;">*Harap simpan bukti pembayaran ini<br>
                        *Hubungi kami jika ada pertanyaan mengenai pembayaran</small></small>
            </div>
            <div class="button-bukti mt-3 d-flex justify-content-end">
                <button class="btn btn-success" onclick="redirectToBeranda()">Kembali ke Pesanan</button>
                <button class="btn btn-primary" onclick="printBuktiPembayaran()">Print Bukti Pembayaran</button>

            </div>
        </div>
    </section>
</div>
<script>
    function redirectToBeranda() {
        window.location.href = '/pesanan';
    }

    function printBuktiPembayaran() {
    // Open a new window or tab
    var newWindow = window.open('', '_blank');

    // Get the HTML content of the payment proof
    var content = document.getElementById('buktiPemb').innerHTML;

    // Write the HTML content to the new window or tab
    newWindow.document.write('<html><head><title>Bukti Pembayaran</title>');
    newWindow.document.write('<style>body { font-family: Arial, sans-serif; }</style>'); // Add any required styles here
    newWindow.document.write('</head><body>');
    newWindow.document.write(content);
    newWindow.document.write('</body></html>');

    // Close the document to finish writing the HTML content
    newWindow.document.close();

    // Wait for the content to load and then call the print function
    newWindow.onload = function() {
        newWindow.focus(); // Focus on the new window to ensure the print dialog appears on top
        newWindow.print(); // Trigger the print dialog
        newWindow.onafterprint = function() {
            newWindow.close(); // Close the new window after printing
        };
    };
}

</script>

@endsection
