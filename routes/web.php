<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Route;

// Root → login
Route::get('/', fn() => redirect()->route('login'));

// Autentikasi
Route::get('login',  [AuthController::class,'showLoginForm'])->name('login');
Route::post('login', [AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout'])
     ->name('logout')
     ->middleware('auth');


// Group untuk mahasiswa/user
Route::middleware(['auth'])
     ->prefix('user')->name('user.')
     ->group(function(){
    Route::get('dashboard', [UserController::class,'dashboard'])->name('dashboard');
    Route::get('pesan',     [UserController::class,'create'])   ->name('pesan');
    Route::post('pesan',    [UserController::class,'store']);
    Route::get('riwayat',   [UserController::class,'riwayat'])  ->name('riwayat');
});

// Group untuk admin
Route::middleware(['auth'])
     ->prefix('admin')->name('admin.')
     ->group(function(){
    Route::get('dashboard',        [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('pesan/{id}/balas', [AdminController::class,'showBalas'])  ->name('pesan.balas');
    Route::post('pesan/{id}/balas',[AdminController::class,'storeBalas']) ->name('pesan.balas.post');
    Route::get('riwayat',          [AdminController::class,'riwayat'])   ->name('riwayat');
});

Route::middleware('guest')->group(function () {
    // Registrasi
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Verifikasi OTP
    Route::get('/email/verify', [RegisterController::class, 'showVerificationForm'])->name('verification.notice');
    Route::post('/email/verify', [RegisterController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [RegisterController::class, 'resendOtp'])->name('verification.resend');
});
