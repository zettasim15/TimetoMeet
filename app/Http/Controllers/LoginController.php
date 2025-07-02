<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // tampilkan form login
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Ambil user yang login
        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'Manager') {
            return redirect('/manager-dashboard');
        } elseif ($user->role === 'Member') {
            return redirect('/member-dashboard');
        }

        // Jika role tidak dikenali, fallback ke dashboard umum
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
