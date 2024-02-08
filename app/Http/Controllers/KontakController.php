<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika tidak ada user, redirect atau tangani sesuai kebutuhan
        if (!$user) {

            redirect('home')->with('error', 'Anda harus login terlebih dahulu!');
        }

        $latestReservasi = $user->reservasi()->latest()->first() ?? null; // Menggunakan null coalescing operator

        return view('Kontak', ['latestReservasi' => $latestReservasi]);
    }




    public function kirimPesan(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'subject' => 'required',
        ]);

        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Mendapatkan reservasi terbaru pengguna
        $latestReservasi = $user->reservasi()->latest()->first();

        $pesan = new Pesan();
        $pesan->kode_reservasi = $latestReservasi->kode_reservasi;
        $pesan->Nama = $request->input('nama');
        $pesan->kontak = $request->input('kontak');
        $pesan->subject = $request->input('subject');
        $pesan->save();

        return redirect('kontak')->with('success', 'Pesan berhasil terkirim!');
    }
}
