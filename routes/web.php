<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PesananController;
use App\Models\Kamar;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk tamu sebelum login
Route::get('/', function () {
    $jenisKamar = Kamar::distinct('jenis_kamar')->get(['jenis_kamar']);
    return view('welcome', ['jenisKamar' => $jenisKamar]);
})->middleware('guest');

// Route untuk tamu sesudah login
Route::get('/home', [HomeController::class, 'index'])
    ->name('home');
// ->middleware('role:tamu');

Route::get('/get-jenis-kamar', [HomeController::class, 'getJenisKamar']);

// Route untuk about
Route::get('/about', function () {
    return view('About');
})->name('About')
    ->middleware('role:tamu');

// Route untuk Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('Kontak')->middleware('role:tamu');
Route::post('/kontak', [KontakController::class, 'kirimPesan'])->name('kirim.pesan')->middleware('role:tamu');

// Route untuk Pesanan
Route::get('/pesanan', [PesananController::class, 'Pesanan'])->name('Pesanan')->middleware('role:tamu');
Route::get('hapus_pesanan/{id}', [PesananController::class, 'hapus_pesanan'])->name('hapus.pesanan')->middleware('role:tamu');
Route::get('/bayar-pesanan/{id}', [PesananController::class, 'bayarPesanan'])->name('bayar.pesanan');
Route::get('/check-payment/{orderId}', [PesananController::class, 'checkPaymentStatus'])->name('check.payment');

// Route untuk link Footer
Route::get('/team', function () {
    return view('Footer.Team');
})->name('Team');

Route::get('/panduan', function () {
    return view('Footer.Panduan');
})->name('Panduan');

// Route untuk Kamar
Route::get('/rooms/superior-room', [RoomsController::class, 'SuperiorRoom']);
Route::get('/rooms/delux-room', [RoomsController::class, 'DeluxRoom']);
Route::get('/rooms/vip-delux', [RoomsController::class, 'VIPDelux']);
Route::get('/rooms/family-suite', [RoomsController::class, 'FamilySuite']);
Route::get('/rooms/executive-suite', [RoomsController::class, 'ExecutiveSuite']);

// proses book now pertama
Route::post('/form-reservasi/process', [ReservasiController::class, 'formReservasi'])->name('form.reservasi')->middleware('role:tamu');
Route::get('/form-reservasi/show', [ReservasiController::class, 'showFormKedua'])->name('show.form.kedua')->middleware('role:tamu');
Route::post('/store-reservasi', [ReservasiController::class, 'store'])->name('store.reservasi')->middleware('role:tamu');
Route::get('/bukti-reservasi', [ReservasiController::class, 'buktiReservasi'])->name('bukti.reservasi')->middleware('role:tamu');

// Route untuk melihat reservasi
Route::get('/lihat-reservasi/{kode_reservasi}', [ReservasiController::class, 'lihatReservasi'])->name('lihat.reservasi')->middleware('role:tamu');
// Route untuk melihat bukti pembayaran
Route::get('/lihat-bukti/{kode_reservasi}', [ReservasiController::class, 'lihatBuktiPembayaran'])->name('lihat.bukti')->middleware('role:tamu');

// Di dalam web.php atau api.php
Route::get('/redirect-to-pesanan', function () {
    return redirect('/pesanan')->with('message', 'Silahkan melakukan pembayaran sesuai dengan kode reservasi');
});
Route::get('/redirect-to-home', function () {
    return redirect('/home')->with('message', 'Untuk melihat riwayat reservasi, klik menu pesanan');
});

// Admin
// Route untuk Dashboard
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('role:admin');
// Route untuk Reservasi
Route::get('/reservation', [AdminController::class, 'reservasi'])->name('reservasi')->middleware('role:admin');
Route::get('/reservation/tambah', [AdminController::class, 'tambahReservasi'])->name('tambah.reservasi')->middleware('role:admin');
Route::post('/reservation/tambah/proses', [AdminController::class, 'prosesreservasi'])->name('admin.reservasi.store')->middleware('role:admin');

// proses checkin dan checkout
// index checkin dan checkout
Route::get('/reservasi-checkIn', [AdminController::class, 'checkIn'])->name('reservasi.checkIn')->middleware('role:admin');
Route::get('/reservasi-checkOut', [AdminController::class, 'checkOut'])->name('reservasi.checkOut')->middleware('role:admin');
// check in dan check out
Route::post('/reservasi/checkin/{kode_reservasi}', [AdminController::class, 'prosesCheckIn'])->name('reservasi.checkin')->middleware('role:admin');
Route::post('/reservasi/checkout/{kode_reservasi}', [AdminController::class, 'prosesCheckOut'])->name('reservasi.checkout')->middleware('role:admin');
Route::delete('/reservasi/{kode_reservasi}', [AdminController::class, 'destroy'])->name('reservasi.destroy');


// Route untuk kamar
// Route untuk tambah data kamar
Route::get('/kamar', [AdminController::class, 'kamar'])->name('datakamar')->middleware('role:admin');
Route::get('/kamar/tambahkamar', [AdminController::class, 'tambahkamar'])->name('tambahkamar')->middleware('role:admin');
Route::post('/insert', [AdminController::class, 'insert'])->name('insert')->middleware('role:admin');
Route::get('/kamar/hapus/{id}', [AdminController::class, 'hapus'])->name('hapus')->middleware('role:admin');
Route::get('/kamar/update/{id}', [AdminController::class, 'update'])->name('update')->middleware('role:admin');
Route::put('ubah/{id}', [AdminController::class, 'ubah'])->name('ubah')->middleware('role:admin');
// Route::get('/get-stok-bulanan/{jenisKamar}/{bulan}/{tahun}', [AdminController::class, 'getStokBulanan']);
Route::get('/stok-kamar/{jenisKamar}', [AdminController::class, 'getStokKamarPerTanggal'])->middleware('role:admin');





// pesan
Route::get('/pesan', [AdminController::class, 'pesan'])->name('pesan')->middleware('role:admin');

// laporan report transaksi chgeckout
Route::get('/report', [AdminController::class, 'report'])->name('Report')->middleware('role:admin');
Route::get('/cetak-pdf', [AdminController::class, 'cetakPDF'])->name('cetak.pdf')->middleware('role:admin');

// Route untuk Masuk
Route::get('login', [LoginController::class, 'index'])->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);

// Route untuk Daftar
Route::get('register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store']);

// Route untuk keluar
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('logout', function () {
    if (session()->has('nama')) {
        session()->pull('nama');
    }
    return redirect('/');
});

Route::get('/cetak-bukti', function () {
    return view('Cetak-Bukti');
})->name('cetak-bukti')
    ->middleware('role:tamu');


// Route::get('/cari-reservasi', [AdminController::class, 'cariReservasi'])
//     ->name('cariReservasi')
//     ->middleware('role:admin');
