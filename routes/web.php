<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Menampilkan Form Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Mengirim Data Register
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    // Profil pengguna
    Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::get('/user/edit', [UserController::class, 'editProfile'])->name('user.edit');
    Route::post('/user/edit', [UserController::class, 'updateProfile']);

    // Ganti password
    Route::get('/user/change-password', [UserController::class, 'changePasswordForm'])->name('user.change-password');
    Route::post('/user/change-password', [UserController::class, 'changePassword']);
});
