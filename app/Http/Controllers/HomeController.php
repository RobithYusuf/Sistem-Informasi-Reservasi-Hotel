<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'jenisKamar' => $this->getJenisKamar(request()),
        ]);
    }

    public function getJenisKamar(Request $request)
    {
        $tanggalCheckIn = Carbon::parse($request->input('check_in'));
        $tanggalCheckOut = Carbon::parse($request->input('check_out'));

        // Query untuk mendapatkan jenis kamar beserta jumlah kamar yang tersedia
        $jenisKamarTersedia = Kamar::with('stokKamar')->get()->map(function ($kamar) use ($tanggalCheckIn, $tanggalCheckOut) {
            $kamarTersediaPerHari = [];

            // Inisialisasi jumlah kamar tersedia untuk setiap hari dalam rentang
            for ($tanggal = clone $tanggalCheckIn; $tanggal->lte($tanggalCheckOut); $tanggal->addDay()) {
                $kamarTersediaPerHari[$tanggal->format('Y-m-d')] = $kamar->stokKamar->jumlah;
            }

            // Menghitung jumlah kamar yang terpakai dan menguranginya dari stok per hari
            $reservasi = DB::table('kamar_reservasi')
                ->where('kamar_id', $kamar->kode_kamar)
                ->whereDate('tanggal_check_in', '<=', $tanggalCheckOut)
                ->whereDate('tanggal_check_out', '>=', $tanggalCheckIn)
                ->get();

            foreach ($reservasi as $booking) {
                for ($tanggal = Carbon::parse($booking->tanggal_check_in); $tanggal->lt(Carbon::parse($booking->tanggal_check_out)); $tanggal->addDay()) {
                    if (isset($kamarTersediaPerHari[$tanggal->format('Y-m-d')])) {
                        $kamarTersediaPerHari[$tanggal->format('Y-m-d')] -= $booking->jumlah_kamar;
                    }
                }
            }

            // Menemukan jumlah kamar tersedia minimum dalam rentang tanggal
            $kamar->jumlah_kamar_tersedia = $kamarTersediaPerHari[$tanggalCheckIn->format('Y-m-d')];
            return $kamar;
        });

        return response()->json($jenisKamarTersedia);
    }
}
