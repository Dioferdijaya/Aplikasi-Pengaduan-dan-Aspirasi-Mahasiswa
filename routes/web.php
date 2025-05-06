<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Autentikasi
Route::get('login', [AuthController::class,'showLoginForm'])->name('login');
Route::post('login', [AuthController::class,'login']);

// Group untuk mahasiswa/user
Route::middleware(['auth','can:isUser'])->prefix('user')->name('user.')->group(function(){
    Route::get('dashboard',    [UserController::class,'dashboard'])->name('dashboard');
    Route::get('pesan',        [UserController::class,'create'])->name('pesan');
    Route::post('pesan',       [UserController::class,'store']);
    Route::get('riwayat',      [UserController::class,'riwayat'])->name('riwayat');
});

// Group untuk admin
Route::middleware(['auth','can:isAdmin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('dashboard',    [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('pesan/{id}/balas',[AdminController::class,'showBalas'])->name('pesan.balas');
    Route::post('pesan/{id}/balas',[AdminController::class,'storeBalas']);
    Route::get('riwayat',      [AdminController::class,'riwayat'])->name('riwayat');
});
