<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller {
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role'     => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])
                    ->where('role', $credentials['role'])
                    ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->intended($user->role === 'Manager' ? '/manager-dashboard' : '/member-dashboard');
        }

        return back()->withErrors([
            'login_error' => 'Username, password, atau role salah.'
        ])->withInput();
    }
}
