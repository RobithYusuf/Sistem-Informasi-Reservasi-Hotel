<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\StokKamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{


    public function formReservasi(Request $request)
    {
        $validated = $request->validate([
            'jenis_kamar' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'jumlah_kamar' => 'required|numeric'
        ]);

        // cek kteresediaan kamar dari input
       $tanggalCheckIn = Carbon::parse($validated['check_in']);
    $tanggalCheckOut = Carbon::parse($validated['check_out'])->subDay(); // Kurangi satu hari dari tanggal check-out
    $jenisKamar = $validated['jenis_kamar'];
    $jumlahKamarDipesan = $validated['jumlah_kamar'];
    $tanggalTidakTersedia = [];


        // Cek ketersediaan kamar setiap hari dalam rentang tanggal
        for ($tanggal = clone $tanggalCheckIn; $tanggal->lte($tanggalCheckOut); $tanggal->addDay()) {
            $jumlahKamarTersedia = DB::table('stok_kamar')
                ->where('jenis_kamar', $jenisKamar)
                ->value('jumlah');

            $jumlahKamarTerpakai = DB::table('kamar_reservasi')
                ->join('reservasi', 'kamar_reservasi.reservasi_id', '=', 'reservasi.kode_reservasi')
                ->where('reservasi.jenis_kamar', $jenisKamar)
                ->whereDate('tanggal_check_in', '<=', $tanggal)
                ->whereDate('tanggal_check_out', '>', $tanggal)
                ->sum('kamar_reservasi.jumlah_kamar');

            if (($jumlahKamarTersedia - $jumlahKamarTerpakai) < $jumlahKamarDipesan) {
            $tanggalTidakTersedia[] = $tanggal->format('d-m-Y'); // Format tanggal ke d-m-Y
            }
        }
        if (!empty($tanggalTidakTersedia)) {
            // Jika ada tanggal di mana stok habis
            $pesanError = 'Stok kamar tidak tersedia pada tanggal: ' . implode(', ', $tanggalTidakTersedia) . '. Silakan pilih tanggal lain.';
            DB::rollback();
            return back()->withInput()->withErrors([$pesanError]);
        }

        // Simpan data ke sesi
        session(['formPertamaData' => $validated]);

        // Redirect ke form kedua
        return redirect()->route('show.form.kedua')->with('success', 'Booking berhasil, silahkan mengisi data diri.');
    }


    public function showFormKedua()
    {
        // Mengambil data dari sesi untuk formulir pertama
        $data = session('formPertamaData');

        // Jika data tidak ada, redirect ke halaman utama dengan pesan error
        if (!$data) {
            return redirect()->route('home')->with('error', 'Data booking tidak ditemukan.');
        }

        // Menghitung total harga berdasarkan data dari formulir pertama
        $checkInDate = \Carbon\Carbon::createFromFormat('Y-m-d', $data['check_in']);
        $checkOutDate = \Carbon\Carbon::createFromFormat('Y-m-d', $data['check_out']);
        $selisihHari = $checkOutDate->diffInDays($checkInDate);
        $dataKamar = Kamar::where('jenis_kamar', $data['jenis_kamar'])->firstOrFail();
        $harga = 'Rp ' . number_format($dataKamar->harga, 0, ',', '.');
        $totalHarga = $selisihHari * $dataKamar->harga * $data['jumlah_kamar'];

        // Mengirim data ke view formulir kedua
        return view('formReservasi', [
            'data' => $data,
            'harga' => $harga,
            'totalHarga' => $totalHarga
        ]);
    }
    private function formatHarga($currencyString)
    {
        // Hapus "Rp" dan pemisah ribuan, lalu ubah ke bilangan bulat
        return (int) str_replace(['Rp ', '.'], '', $currencyString);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'no_ktp' => 'required|min:16',
            'nama_tamu' => 'required|max:255',
            'no_hp' => 'required|min:8',
            'metode_pembayaran' => 'required|in:sekarang,checkin',
            'jenis_kamar' => 'required',
            'harga' => 'required',
            'checkIn' => 'required|date',
            'checkOut' => 'required|date|after:checkIn',
            'jumlah_kamar' => 'required|numeric',
            'total_harga' => 'required',

        ], [
            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'no_ktp.min' => 'Nomor KTP harus memiliki setidaknya :min karakter.',
            'nama_tamu.required' => 'Nama Tamu wajib diisi.',
            'nama_tamu.max' => 'Nama Tamu tidak boleh melebihi :max karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.min' => 'Nomor HP harus memiliki setidaknya :min karakter.',
            'metode_pembayaran.required' => 'Metode Pembayan wajib diisi.',
            'metode_pembayaran.max' => 'Metode pembayaran tidak boleh melebihi :max karakter.',
            'jenis_kamar.required' => 'Jenis Kamar wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'checkIn.required' => 'Tanggal Check-in wajib diisi.',
            'checkIn.date' => 'Format Tanggal Check-in tidak valid.',
            'checkOut.required' => 'Tanggal Check-out wajib diisi.',
            'checkOut.date' => 'Format Tanggal Check-out tidak valid.',
            'checkOut.after' => 'Tanggal Check-out harus setelah Tanggal Check-in.',
            'jumlah_kamar.required' => 'Jumlah Kamar wajib diisi.',
            'jumlah_kamar.numeric' => 'Jumlah Kamar harus berupa nilai numerik.',
            'total_harga.required' => 'Total Harga wajib diisi.',

        ]);

        $validatedData['harga'] = $this->formatHarga($request->input('harga'));
        $validatedData['total_harga'] = $this->formatHarga($request->input('total_harga'));
        $validatedData['user_id'] = auth()->user()->id;

        $tanggalCheckIn = Carbon::parse($validatedData['checkIn']);
        $tanggalCheckOut = Carbon::parse($validatedData['checkOut'])->subDay();
        $jenisKamar = $validatedData['jenis_kamar'];
        $jumlahKamarDipesan = $validatedData['jumlah_kamar'];
        $tanggalTidakTersedia = [];

        DB::beginTransaction();

        try {
            // Cek ketersediaan kamar setiap hari dalam rentang tanggal
            for ($tanggal = clone $tanggalCheckIn; $tanggal->lte($tanggalCheckOut); $tanggal->addDay()) {
                $jumlahKamarTersedia = DB::table('stok_kamar')
                    ->where('jenis_kamar', $jenisKamar)
                    ->value('jumlah');

                $jumlahKamarTerpakai = DB::table('kamar_reservasi')
                    ->join('reservasi', 'kamar_reservasi.reservasi_id', '=', 'reservasi.kode_reservasi')
                    ->where('reservasi.jenis_kamar', $jenisKamar)
                    ->whereDate('tanggal_check_in', '<=', $tanggal)
                    ->whereDate('tanggal_check_out', '>', $tanggal)
                    ->sum('kamar_reservasi.jumlah_kamar');

                if (($jumlahKamarTersedia - $jumlahKamarTerpakai) < $jumlahKamarDipesan) {
                    $tanggalTidakTersedia[] = $tanggal->format('d-m-Y'); // Format tanggal ke d-m-Y
                }
            }
            if (!empty($tanggalTidakTersedia)) {
                // Jika ada tanggal di mana stok habis
                $pesanError = 'Stok kamar tidak tersedia pada tanggal: ' . implode(', ', $tanggalTidakTersedia) . '. Silakan pilih tanggal lain.';
                DB::rollback();
                return back()->withInput()->withErrors([$pesanError]);
            }


            // Exclude 'total_harga' from the validated data
            $totalHarga = $validatedData['total_harga'];
            unset($validatedData['total_harga']);

            // Buat dan simpan data reservasi
            $latestReservasi = Reservasi::create($validatedData);

            // Tentukan batas waktu pembayaran
            $tanggalCheckIn = Carbon::parse($validatedData['checkIn']);
            $hariIni = Carbon::now();
            $batasWaktuPembayaran = $tanggalCheckIn->endOfDay(); // Default batas waktu adalah akhir hari check-in

            // Menyesuaikan batas waktu pembayaran berdasarkan metode pembayaran dan kapan pemesanan dibuat
            if ($validatedData['metode_pembayaran'] === 'sekarang') {
                if ($tanggalCheckIn->isTomorrow() || $tanggalCheckIn->isToday()) {
                    // Jika check-in adalah hari ini atau besok, batas waktu pembayaran adalah hari ini
                    $batasWaktuPembayaran = $hariIni->endOfDay();
                } else {
                    // Jika pemesanan dilakukan lebih awal dari H-1, batas waktu adalah H-1
                    $batasWaktuPembayaran = $tanggalCheckIn->subDay()->endOfDay();
                }
            }

            // Dapatkan kode_kamar berdasarkan jenis_kamar
            $kamar = Kamar::where('jenis_kamar', $validatedData['jenis_kamar'])->first();

            if ($kamar && $latestReservasi) {
                DB::table('kamar_reservasi')->insert([

                    'kamar_id' => $kamar->kode_kamar, // Gunakan kode_kamar yang valid
                    'reservasi_id' => $latestReservasi->kode_reservasi,
                    'tanggal_check_in' => $validatedData['checkIn'],
                    'tanggal_check_out' => $validatedData['checkOut'],
                    'jumlah_kamar' => $validatedData['jumlah_kamar'],
                ]);
            }

            // Buat data pembayaran
            $pembayaran = new Pembayaran([
                'kode_reservasi' => $latestReservasi->kode_reservasi,
                'jumlah_bayar' => $totalHarga,
                'batas_waktu_pembayaran' => $batasWaktuPembayaran,
                'metode_pembayaran' => $validatedData['metode_pembayaran'],
                // Data tambahan jika diperlukan
            ]);

            $pembayaran->save();

            DB::commit(); // Commit transaksi jika semua berjalan lancar

            return redirect('/bukti-reservasi')
                ->with([
                    'success' => 'Reservasi berhasil, Silahkan menyelesaikan pembayaran.',
                    'latestReservasi' => $latestReservasi,
                    'pembayaran' => $pembayaran
                ]);
        } catch (\Exception $e) {

            DB::rollback(); // Rollback transaksi jika terjadi kesalahan
            // dd($e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan saat melakukan pemesanan: ' . $e->getMessage());
        }
    }

    public function buktiReservasi()
    {

        $data = Reservasi::with('pembayaran')->latest()->first();

        if (!$data) {
            return redirect('/')->with('error', 'Data reservasi tidak ditemukan.');
        }

        return view('BuktiReservasi', [
            'latestReservasi' => $data,
            'pembayaran' => $data->pembayaran // asumsikan relasi 'pembayaran' ada di model Reservasi
        ]);
    }

    public function lihatReservasi($kode_reservasi)
    {
        $reservasi = Reservasi::with('pembayaran', 'kamar')->where('kode_reservasi', $kode_reservasi)->firstOrFail();
        $pembayaran = $reservasi->pembayaran;
        return view('Pesanan.LihatReservasi', compact('reservasi', 'pembayaran'));
    }

    public function lihatBuktiPembayaran($kode_reservasi)
    {
        $pembayaran = Pembayaran::where('kode_reservasi', $kode_reservasi)->firstOrFail();
        return view('Pesanan.BuktiPembayaran', compact('pembayaran'));
    }
}
