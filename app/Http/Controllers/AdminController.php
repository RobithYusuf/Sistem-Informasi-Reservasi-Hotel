<?php

namespace App\Http\Controllers;

use log;
use DatePeriod;
use DateInterval;
use App\Models\Kamar;
use App\Models\Pesan;
use App\Models\Reservasi;
use App\Models\StokKamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil data reservasi
        $data = Reservasi::orderBy('created_at', 'desc')->take(10)->get();

        // Hitung jumlah reservasi
        $bookingCount = Reservasi::whereMonth('created_at', Carbon::now()->month)
            ->count();


        // Dapatkan bulan dan tanggal saat ini
        $currentMonth = Carbon::now()->translatedFormat('F');
        $currentDay = Carbon::now()->translatedFormat('l');

        // Ambil data reservasi yang memiliki status "paid" untuk bulan ini
        $currentMonthEarnings = Pembayaran::join('reservasi', 'pembayaran.kode_reservasi', '=', 'reservasi.kode_reservasi')
            ->where('pembayaran.status', 'Paid')
            ->whereMonth('reservasi.checkOut', Carbon::now()->month)
            ->sum('pembayaran.jumlah_bayar');

        // Ambil kamar yang sedang digunakan pada hari ini
        $roomsInUse = Reservasi::where('status_reservasi', 0)
            ->whereDate('checkIn', Carbon::today())
            ->sum('jumlah_kamar');

        // Set target reservasi per bulan
        $targetReservasiPerBulan = 20;

        // Ambil jumlah reservasi yang memiliki status "paid" untuk bulan ini
        $jumlahReservasiBulanIni = Reservasi::join('pembayaran', 'reservasi.kode_reservasi', '=', 'pembayaran.kode_reservasi')
            ->where('pembayaran.status', 'Paid') // Hanya transaksi yang statusnya Paid'

            ->whereMonth('reservasi.created_at', Carbon::now()->month)
            ->count();

        // Hitung persentase pencapaian target
        $persentaseTercapai = ($jumlahReservasiBulanIni / $targetReservasiPerBulan) * 100;

        // Batasi persentase menjadi maksimal 100%
        $persentaseTercapai = min(100, $persentaseTercapai);

        $startOfYear = now()->subYear()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Mendapatkan data transaksi
        $transaksiData = Pembayaran::join('reservasi', 'pembayaran.kode_reservasi', '=', 'reservasi.kode_reservasi')
            ->select(
                DB::raw('SUM(pembayaran.jumlah_bayar) as total'),
                DB::raw("DATE_FORMAT(reservasi.checkOut, '%Y-%m') as bulan")
            )
            ->where('pembayaran.status', 'Paid')
            ->where('reservasi.status_reservasi', 1)
            ->whereBetween('reservasi.checkOut', [$startOfYear, $endOfMonth])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('total', 'bulan');

        // Membuat label dan data untuk setiap bulan
        $labelsBulanan = collect();
        $dataBulanan = collect();
        for ($date = $startOfYear->copy(); $date->lte($endOfMonth); $date->addMonth()) {
            $bulanFormat = $date->format('Y-m');
            $labelsBulanan->push($date->format('F Y'));
            $dataBulanan->push($transaksiData->get($bulanFormat, 0));
        }
        $labelsBulanan = $labelsBulanan->toArray();
        $dataBulanan = $dataBulanan->toArray();


        // chart pie (perhari)
        $transaksiHarian = Pembayaran::join('reservasi', 'pembayaran.kode_reservasi', '=', 'reservasi.kode_reservasi')
            ->select(
                DB::raw('SUM(pembayaran.jumlah_bayar) as total'),
                DB::raw("DATE_FORMAT(reservasi.checkOut, '%d %b %Y') as tanggal") // Format tanggal diubah
            )
            ->where('pembayaran.status', 'Paid') // Hanya transaksi yang statusnya Paid'
            ->where('reservasi.status_reservasi', 1) // Hanya reservasi yang statusnya 1 (checkout)
            ->whereDate('reservasi.checkOut', now()->format('Y-m-d')) // Hanya data dari hari ini
            ->groupBy(DB::raw("DATE_FORMAT(reservasi.checkOut, '%d %b %Y')"))
            ->get();
        $labelsHarian = $transaksiHarian->pluck('tanggal');
        $dataHarian = $transaksiHarian->pluck('total');

        // Kirim data ke view
        return view('Admin.Dashboard', [
            'data' => $data,
            'currentMonth' => $currentMonth,
            'currentDay' => $currentDay,
            'currentMonthEarnings' => $currentMonthEarnings,
            'roomsInUse' => $roomsInUse,
            'persentaseTercapai' => $persentaseTercapai,
            'targetReservasiPerBulan' => $targetReservasiPerBulan,
            'bookingCount' => $bookingCount,
            'labelsBulanan' => $labelsBulanan,
            'dataBulanan' => $dataBulanan,
            'labelsHarian' => $labelsHarian,
            'dataHarian' => $dataHarian,
        ]);
    }

    public function reservasi()
    {
        $data = Reservasi::with('pembayaran')->where('status_reservasi', null)->orWhere('status_reservasi', 0)->get();
        return view('Admin.Reservasi', ['data' => $data]);
    }

    public function checkIn()
    {
        $checkins = Reservasi::with('pembayaran')->where('status_reservasi', 0)->get();
        return view('Admin.Reservasi-checkIn', compact('checkins'));
    }

    public function checkOut()
    {
        $checkouts = Reservasi::with('pembayaran')->where('status_reservasi', 1)->get();
        return view('Admin.Reservasi-checkOut', compact('checkouts'));
    }

    public function prosesCheckIn($kode_reservasi)
    {
        // Retrieve the reservation with its payment details
        $reservation = Reservasi::with('pembayaran')->find($kode_reservasi);

        // Check if the reservation exists
        if (!$reservation) {
            return back()->with('error', 'Reservasi tidak ditemukan');
        }

        // Check if payment details are available
        $payment = $reservation->pembayaran;
        // \Log::info('Reservation: ', $reservation->toArray());
        // \Log::info('Payment: ', $payment->toArray());

        if (!$payment) {
            return back()->with('error', 'Pembayaran belum diselesaikan');
        }

        // Handle different payment statuses
        switch ($payment->status) {
            case 'Expired':
                return back()->with('error', 'Check-in tidak dapat dilakukan karena cancel.');

            case 'Paid':
                // Update reservation status to checked in (0)
                $reservation->update(['status_reservasi' => 0]);
                return back()->with('success', 'Check-in berhasil');

            case 'Unpaid':
            case 'Pending':
                // Update payment status to 'Paid' and reservation status to checked in (0)
                $payment->update(['status' => 'Paid']);
                $payment->update(['metode_bayar' => 'checkin']);
                $reservation->update(['status_reservasi' => 0]);
                return back()->with('success', 'Check-in berhasil');

            default:
                // Handle unexpected payment status
                return back()->with('error', 'Status pembayaran tidak diketahui');
        }
    }

    public function prosesCheckOut($kode_reservasi)
    {
        $reservation = Reservasi::find($kode_reservasi);

        if ($reservation) {
            // Update status reservasi menjadi check out
            $reservation->status_reservasi = 1; // Anggap 1 berarti checked out
            $reservation->save();

            // Update jumlah kamar pada tabel kamar_reservasi menjadi nol
            DB::table('kamar_reservasi')
                ->where('reservasi_id', $kode_reservasi)
                ->update(['jumlah_kamar' => 0]);

            return back()->with('success', 'Check-out berhasil');
        } else {
            return back()->with('error', 'Reservasi tidak ditemukan');
        }
    }

    public function kamar()
    {
        $kamar = Kamar::with('stokKamar')->get();
        return view('Admin.Kamar', ['data' => $kamar]);
    }

    public function tambahkamar()
    {
        return view('Admin.TambahKamar');
    }

    // ke halaman tambah reservasi
    public function tambahReservasi()
    {
        // Fetch room types and prices from the Kamar model
        $kamar = Kamar::select('jenis_kamar', 'harga')->get();

        // Pass this data to your view
        return view('Admin.TambahReservasi', compact('kamar'));
    }

    private function formatToInteger($harga)
    {
        // Remove "Rp" and any non-numeric characters except for the decimal separator
        $formatted = preg_replace('/[^\d.]/', '', $harga);
        // Convert to integer
        return (int)str_replace('.', '', $formatted);
    }

    // store reservasi
    public function prosesReservasi(Request $request)
    {

        $validatedData = $request->validate([
            'no_ktp' => 'required|min:16',
            'nama_tamu' => 'required|max:255',
            'no_hp' => 'required|min:8',
            'jenis_kamar' => 'required',
            'checkIn' => 'required|date',
            'checkOut' => 'required|date|after:checkIn',
            'jumlah_kamar' => 'required|numeric',
            'harga_per_kamar' => 'required',
            'total_harga' => 'required',
            'status_reservasi' => 'nullable',

        ], [
            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'no_ktp.min' => 'Nomor KTP harus memiliki setidaknya :min karakter.',
            'nama_tamu.required' => 'Nama Tamu wajib diisi.',
            'nama_tamu.max' => 'Nama Tamu tidak boleh melebihi :max karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.min' => 'Nomor HP harus memiliki setidaknya :min karakter.',
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

            // Convert 'total_harga' to an integer
            $totalHargaInteger = $this->formatToInteger($validatedData['total_harga']);
            // Set 'batas_waktu_pembayaran' to be the same as 'checkIn' date
            $batasWaktuPembayaran = Carbon::parse($validatedData['checkIn'])->setTime(23, 59);

            $reservasi = new Reservasi();
            $reservasi->no_ktp = $validatedData['no_ktp'];
            $reservasi->nama_tamu = $validatedData['nama_tamu'];
            $reservasi->no_hp = $validatedData['no_hp'];
            $reservasi->jenis_kamar = $validatedData['jenis_kamar'];
            $reservasi->harga = $validatedData['harga_per_kamar'];
            $reservasi->checkIn = $validatedData['checkIn'];
            $reservasi->checkOut = $validatedData['checkOut'];
            $reservasi->jumlah_kamar = $validatedData['jumlah_kamar'];
            $reservasi->status_reservasi = $validatedData['status_reservasi'];
            $reservasi->user_id = auth()->user()->id;
            $reservasi->save();

            // Assuming there's a relationship set up in Reservasi model to link with Kamar
            // Get the Kamar record
            $kamar = Kamar::where('jenis_kamar', $validatedData['jenis_kamar'])->first();

            if ($kamar) {
                $pivotData = [
                    'reservasi_id' => $reservasi->kode_reservasi,
                    'kamar_id' => $kamar->kode_kamar,
                    'tanggal_check_in' => $validatedData['checkIn'],
                    'tanggal_check_out' => $validatedData['checkOut'],
                    'jumlah_kamar' => $validatedData['jumlah_kamar'],
                    // Additional fields...
                ];

                // Debugging: Dump the data to be inserted
                // \Log::info('Inserting into pivot table: ', $pivotData);
                // dd($pivotData);

                DB::table('kamar_reservasi')->insert($pivotData);

                // Debugging: Retrieve and log the inserted data
                $insertedData = DB::table('kamar_reservasi')
                    ->where('reservasi_id', $reservasi->kode_reservasi)
                    ->where('kamar_id', $kamar->kode_kamar)
                    ->first();
                // \Log::info('Inserted data: ', (array) $insertedData);
                // dd($insertedData);
            }

            $paymentStatus = ($validatedData['status_reservasi'] == '0') ? 'Paid' : 'Unpaid';
            $pembayaran = new Pembayaran([
                'kode_reservasi' => $reservasi->kode_reservasi,
                'jumlah_bayar' => $totalHargaInteger,
                'status' => $paymentStatus,
                'metode_bayar' => 'checkin',
                'metode_pembayaran' => 'checkin',
                'batas_waktu_pembayaran' => $batasWaktuPembayaran,

            ]);
            $pembayaran->save();

            DB::commit();
            return redirect()->route('reservasi')->with('success', 'Reservasi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function destroy($kodeReservasi)
    {
        try {
            DB::transaction(function () use ($kodeReservasi) {
                $reservasi = Reservasi::with('pembayaran', 'kamar')->findOrFail($kodeReservasi);

                // Delete related records
                if ($reservasi->pembayaran) {
                    $reservasi->pembayaran()->delete();
                }

                // Detach the related 'kamar' records from the pivot table
                $reservasi->kamar()->detach();

                // Delete the reservation
                $reservasi->delete();
            });

            return redirect()->back()->with('success', 'Reservasi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus reservasi: ' . $e->getMessage());
        }
    }


    public function insert(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'kode_kamar' => 'required',
            'jenis_kamar' => 'required',
            'no_kamar' => 'required',
            'fasilitas' => 'required',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer'
        ]);

        // Create new Kamar
        $kamar = new Kamar();
        $kamar->kode_kamar = $validatedData['kode_kamar'];
        $kamar->jenis_kamar = $validatedData['jenis_kamar'];
        $kamar->no_kamar = $validatedData['no_kamar'];
        $kamar->fasilitas = $validatedData['fasilitas'];
        $kamar->harga = $validatedData['harga'];
        $kamar->save();

        // Create new StokKamar
        $stokKamar = new StokKamar();
        $stokKamar->jenis_kamar = $kamar->jenis_kamar;
        $stokKamar->jumlah = $validatedData['jumlah'];
        // $stokKamar->status = $validatedData['jumlah'] > 0 ? 'tersedia' : 'tidak tersedia';
        $stokKamar->save();

        return redirect('/kamar')->with('success', 'Data kamar berhasil ditambahkan');
    }


    public function hapuskamar($id)
    {
        try {
            DB::transaction(function () use ($id) {
                // Temukan kamar berdasarkan kode_kamar
                $kamar = Kamar::where('kode_kamar', $id)->firstOrFail();

                // Dapatkan semua reservasi yang terkait dengan kamar ini
                $reservasiIds = $kamar->reservasi()->pluck('kode_reservasi');

                // Hapus semua pembayaran yang terkait dengan reservasi ini
                Pembayaran::whereIn('kode_reservasi', $reservasiIds)->delete();

                // Hapus semua reservasi yang terkait dengan kamar ini
                Reservasi::whereIn('kode_reservasi', $reservasiIds)->delete();

                // Hapus kamar
                $kamar->delete();
            });

            return redirect('/kamar')->with('success', 'Data kamar berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/kamar')->with('error', 'Terjadi kesalahan saat menghapus kamar: ' . $e->getMessage());
        }
    }


    public function update($id)
    {
        $kamar = Kamar::where('kode_kamar', $id)->first();
        return view('Admin.Ubahkamar', compact('kamar'));
    }

    public function ubah(Request $request, $id)
    {
        $kamar = Kamar::with('stokKamar')->where('kode_kamar', $id)->first();

        // Update data kamar
        $kamar->jenis_kamar = $request->input('jenis_kamar');
        $kamar->no_kamar = $request->input('no_kamar');
        $kamar->fasilitas = $request->input('fasilitas');
        $kamar->harga = $request->input('harga');

        // Update stok kamar
        $jumlahStok = $request->input('jumlah_stok');
        if ($kamar->stokKamar) {
            $kamar->stokKamar->jumlah = $jumlahStok;
            $kamar->stokKamar->status = $jumlahStok > 0 ? 'tersedia' : 'tidak tersedia';
            $kamar->stokKamar->save();
        }

        $kamar->save();

        return redirect('/kamar')->with('success', 'Data kamar berhasil diubah');
    }


    public function pesan()
    {
        $pesan = Pesan::all();
        return view('Admin.Pesan', ['data' => $pesan]);
    }

    public function report()
    {
        $report = Reservasi::where('status_reservasi', 1)->get();
        return view('Admin.Report', ['data' => $report]);
    }
    public function cetakPDF(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        // Filter data berdasarkan checkOut
        $report = Reservasi::where('status_reservasi', 1)
            ->whereBetween('checkOut', [$request->startDate, $request->endDate])
            ->get();

        // Filter data berdasarkan updated_at
        // $endOfDay = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();

        // $report = Reservasi::where('status_reservasi', 1)
        //     ->whereBetween('updated_at', [$startDate, $endOfDay])
        //     ->get();

        $totalRows = $report->count();
        return view('Admin.cetak-pdf', [
            'data' => $report,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalRows' => $totalRows
        ]);
    }

    public function getStokKamarPerTanggal(Request $request, $jenisKamar)
    {
        try {
            $tanggalMulai = new Carbon($request->query('start', Carbon::now()->startOfMonth()->toDateString()));
            $tanggalAkhir = new Carbon($request->query('end', Carbon::now()->endOfMonth()->toDateString()));

            $ketersediaan = [];
            $interval = new DateInterval('P1D');
            $period = new DatePeriod($tanggalMulai, $interval, $tanggalAkhir->add($interval));

            foreach ($period as $date) {
                $tanggal = $date->format('Y-m-d');

                // Mendapatkan stok kamar untuk jenis kamar dan tanggal tertentu
                $stokKamar = DB::table('stok_kamar')
                    ->where('jenis_kamar', $jenisKamar)
                    ->first();

                $stokTotal = $stokKamar ? $stokKamar->jumlah : 0;
                $ketersediaan[$tanggal] = $stokTotal;

                // Mengurangi stok berdasarkan reservasi yang ada
                $jumlahKamarTereservasi = DB::table('kamar_reservasi')
                    ->join('reservasi', 'kamar_reservasi.reservasi_id', '=', 'reservasi.kode_reservasi')
                    ->where('reservasi.jenis_kamar', $jenisKamar)
                    ->where(function ($query) use ($tanggal) {
                        $query->where('tanggal_check_in', '<=', $tanggal)
                            ->where('tanggal_check_out', '>', $tanggal);
                    })
                    ->sum('kamar_reservasi.jumlah_kamar');

                $ketersediaan[$tanggal] = max(0, $stokKamar->jumlah - $jumlahKamarTereservasi);  // Memastikan tidak negatif
            }

            // Dapatkan informasi tambahan tentang jenis kamar dari tabel kamar
            $infoKamar = Kamar::where('jenis_kamar', $jenisKamar)->first();

            // Buat array untuk menampung keterangan
            $keterangan = [
                'jenisKamar' => $infoKamar->jenis_kamar,
                'harga' => number_format($infoKamar->harga, 0, ',', '.'),
                'periode' => $tanggalMulai->format('F Y') . ' - ' . $tanggalAkhir->format('F Y'),
            ];

            // Gabungkan ketersediaan dan keterangan dalam satu response
            $response = [
                'kalender' => $ketersediaan,
                'keterangan' => $keterangan,
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            // cek eror pada log
            dd($e->getMessage());
            // Jika terjadi kesalahan, kirimkan pesan error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
