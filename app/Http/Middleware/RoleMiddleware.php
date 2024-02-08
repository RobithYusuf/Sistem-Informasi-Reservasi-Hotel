<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Jika pengguna belum login, redirect ke halaman login dengan pesan flash
            return redirect('/login')->with('loginAlert', 'Silakan login terlebih dahulu untuk melakukan reservasi.');
        }


        $user = Auth::user();

        // Memeriksa peran pengguna
        if ($user->role !== $role) {
            // Jika peran pengguna tidak sesuai, redirect ke halaman beranda atau dashboard sesuai dengan peran masing-masing
            if ($user->role === 'admin') {
                return redirect('/dashboard');
            } else if ($user->role === 'tamu') {
                return redirect('/home');
            } else {
                return redirect('welcome');
            }
        }

        // Jika peran pengguna sesuai, lanjutkan ke permintaan selanjutnya
        return $next($request);
    }
}
