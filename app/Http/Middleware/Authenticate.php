<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            // Mengatur session flash message yang akan digunakan nanti di halaman login
            session()->flash('loginAlert', 'Silakan login terlebih dahulu untuk melakukan reservasi.');

            // Mengembalikan URL ke halaman login
            return route('login');
        }
    }
}
