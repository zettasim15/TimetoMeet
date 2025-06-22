<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan profil pengguna
    public function showProfile()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('user.profile', compact('user'));
    }

    // Menampilkan form edit profil pengguna
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    // Menyimpan perubahan profil pengguna
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update data user
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        // Update password jika diubah
        if ($request->has('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // Menampilkan form untuk mengganti password
    public function changePasswordForm()
    {
        return view('user.change-password');
    }

    // Mengupdate password pengguna
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah password lama benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Password berhasil diubah!');
    }
}
