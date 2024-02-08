<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'tittle' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/dashboard')->with('success', 'Login Success');
            } else {
                $nama = $user->name;
                $request->session()->put('nama', $nama);
                return redirect()->intended('/home');
            }
        }

        return redirect()->to('/login')->with('loginError', 'Login Failed');
    }

    public function logout()
    {
        $role = Auth::user()->role;
        Auth::logout();
        Session::flush();

        if ($role === 'admin') {
            return redirect('/');
        } else {
            return redirect('/');
        }
    }
}
