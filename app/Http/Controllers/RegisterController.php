<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // tampilkan form register
    }

    public function register(Request $request)
{
    dd($request->all()); // ⬅️ Tambahkan baris ini dulu

    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:50|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:6',
        'role' => 'required|in:Manager,Member',
    ]);

    // ... lanjut bikin user dll


   $user = User::create([
    'name' => $request->name,
    'username' => $request->username,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => $request->role,
]);

Auth::login($user); // Sekarang $user udah didefinisikan


        return redirect('/dashboard');
    }
}

