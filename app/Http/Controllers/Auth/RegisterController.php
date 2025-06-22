<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Menampilkan Form Register
    public function showRegistrationForm()
{
    return view('auth.register');
}


    // Menyimpan data user baru
    public function register(Request $request)
    {
        // Validasi input pengguna
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Member', // Default role
            'is_first_login' => 1, // Menandakan ini adalah login pertama
        ]);

        // Setelah registrasi berhasil, login pengguna
        auth()->guard('web')->login($user);


        return redirect()->route('home'); // Redirect ke halaman utama setelah berhasil login
    }
}
