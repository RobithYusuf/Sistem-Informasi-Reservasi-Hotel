<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Reservasi;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PesananController extends Controller
{
    public function Pesanan()
    {
        $data = Reservasi::where('user_id', auth()->user()->id)->get();
        return view('Pesanan', ['data' => $data]);
    }


    public function hapus_pesanan($id)
    {
        $reservasi = Reservasi::where('kode_reservasi', $id)->first();

        if ($reservasi) {
            // Hapus entri dari tabel pivot
            DB::table('kamar_reservasi')->where('reservasi_id', $id)->delete();

            // Menghapus pembayaran terkait
            $reservasi->pembayaran()->delete();

            // Menghapus reservasi
            $reservasi->delete();

            return redirect('/pesanan')->with('success', 'Pesanan berhasil dihapus');
        }

        return redirect('/pesanan')->with('error', 'Pesanan tidak ditemukan');
    }



    // Fungsi untuk melakukan pembayaran pesanan berdasarkan kode reservasi
    public function bayarPesanan($id)
    {
        // Mengambil data reservasi dengan pembayaran terkait menggunakan Eloquent ORM
        $data = Reservasi::with('pembayaran')->where('kode_reservasi', $id)->first();

        // Memeriksa apakah reservasi ditemukan
        if (!$data) {
            return response()->json(['error' => 'Reservasi tidak ditemukan'], 404);
        }

        // Memeriksa apakah pembayaran sudah dilakukan
        if ($data->pembayaran && $data->pembayaran->status == 'Paid') {
            return response()->json(['message' => 'Pembayaran sudah dilakukan sebelumnya', 'status' => 'paid']);
        }

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        // Mencoba mendapatkan status pembayaran dari Midtrans
        try {
            $status = \Midtrans\Transaction::status($data->kode_reservasi);
            $midtransStatus = $this->translateMidtransStatus($status->transaction_status);

            // Memeriksa apakah status transaksi Midtrans termasuk dalam kategori 'Pending', 'Expired', atau 'Cancelled'
            if (in_array($midtransStatus, ['Pending', 'Expired', 'Cancelled'])) {
                // Jika ya, maka update status pembayaran pada tabel pembayaran (Reservasi)
                $data->pembayaran->status = $midtransStatus;
                // Menyimpan perubahan status pembayaran ke dalam database
                $data->pembayaran->save();
                // Mengembalikan respons JSON dengan pesan status Midtrans dan status yang baru diupdate
                return response()->json(['message' => $this->getStatusMessage($status->transaction_status), 'status' => $midtransStatus]);
            }
        } catch (\Exception $e) {
            // Menangani kesalahan saat mendapatkan status pembayaran dari Midtrans
            if ($e->getCode() == 404 && ($data->pembayaran->status == 'Unpaid' || is_null($data->pembayaran->status))) {
                // Menyiapkan data untuk pembayaran baru jika belum dilakukan sebelumnya
                $grossAmount = $data->pembayaran->jumlah_bayar;

                $params = [
                    'transaction_details' => [
                        'order_id' => $data->kode_reservasi,
                        'gross_amount' => $grossAmount,
                    ],
                    'item_details' => [
                        [
                            'id' => $data->kode_reservasi,
                            'price'  => $grossAmount,
                            'quantity' => 1,
                            'name' => 'Pembayaran Reservasi ' . $data->jenis_kamar
                        ]
                    ],
                    'customer_details' => [
                        'first_name' => $data->nama_tamu,
                        'email' => $data->user->email,
                        'phone' => $data->no_hp,
                    ],
                ];

                try {
                    // Mendapatkan token pembayaran Snap dari Midtrans
                    $snapToken = Snap::getSnapToken($params);
                    return response()->json(['snapToken' => $snapToken]);
                } catch (\Exception $e) {
                    // Menangani kesalahan saat mendapatkan token Snap
                    return response()->json(['error' => 'Pembayaran gagal, terjadi kesalahan pada sistem.'], 500);
                }
            } else {
                // Menangani kesalahan umum
                if ($e->getCode() == 500) {
                    return response()->json(['error' => 'Terdapat masalah pada server, silakan coba lagi nanti.'], 500);
                } else {
                    return response()->json(['error' => 'Pembayaran gagal, terjadi kesalahan pada sistem, silakan coba lagi nanti'], 500);
                }
            }
        }
    }

    // Fungsi untuk memeriksa status pembayaran berdasarkan ID pesanan
    public function checkPaymentStatus($orderId)
    {
        // Konfigurasi Midtranscus
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        // Mencoba mendapatkan status pembayaran dari Midtrans
        try {
            $status = \Midtrans\Transaction::status($orderId);
            $pembayaran = Pembayaran::where('kode_reservasi', $orderId)->first();

            // Memperbarui status pembayaran di database jika pembayaran ditemukan
            if ($pembayaran) {
                $pembayaran->status = $this->translateMidtransStatus($status->transaction_status);
                $pembayaran->metode_bayar = $status->payment_type;
                $pembayaran->save();
            }

            // Mengembalikan respons JSON dengan status dan pesan yang sesuai
            return response()->json([
                'status' => $this->translateMidtransStatus($status->transaction_status),
                'message' => $this->getStatusMessage($status->transaction_status)
            ]);
        } catch (\Exception $e) {
            // Menangani kesalahan saat mendapatkan status pembayaran dari Midtrans
            return response()->json(['error' => 'Gagal memeriksa status pembayaran'], 500);
        }
    }

    // Fungsi untuk menerjemahkan status Midtrans ke status pemabayaran lokal
    private function translateMidtransStatus($status)
    {
        switch ($status) {
            case 'settlement':
                return 'Paid';
            case 'pending':
                return 'Pending';
            case 'expire':
            case 'cancel':
                return 'Expired';
            default:
                return 'Unknown';
        }
    }

    // Fungsi untuk menambahan notifikasi pesan berdasarkan status Midtrans
    private function getStatusMessage($status)
    {
        switch ($status) {
            case 'settlement':
                return 'Pembayaran berhasil';
            case 'pending':
                return 'Pembayaran pending, silakan menghubungi admin untuk pembayaran';
            case 'expire':
            case 'cancel':
                return 'Pembayaran dibatalkan karena kedaluwarsa';
            default:
                return 'Pembayaran dibatalkan karena kedaluwarsa';
        }
    }

    public function lihatReservasi($kode_reservasi)
    {
        $reservasi = Reservasi::with('pembayaran', 'kamar')
            ->where('kode_reservasi', $kode_reservasi)
            ->firstOrFail();

        return view('tampilanReservasi', compact('reservasi'));
    }

    public function lihatBuktiPembayaran($kode_reservasi)
    {
        $pembayaran = Pembayaran::where('kode_reservasi', $kode_reservasi)
            ->firstOrFail();

        return view('tampilanBuktiPembayaran', compact('pembayaran'));
    }
}
