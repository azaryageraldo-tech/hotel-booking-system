<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Guest\RoomController as GuestRoomController;
use App\Http\Controllers\BookingController; 
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ## Rute yang hanya bisa diakses oleh PENGUNJUNG (belum login) ##
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});


// ## Rute Publik yang bisa diakses SEMUA ORANG ##
Route::get('/rooms', [GuestRoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room}', [GuestRoomController::class, 'show'])->name('rooms.show');
Route::post('/bookings/{room}', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');

// ## Rute yang memerlukan LOGIN ##


// Grup Rute untuk Pengguna dengan Peran "Tamu"
    Route::middleware(['auth', 'verified', 'role:tamu'])->group(function () {
        Route::get('/dashboard', function () {
            // Ambil data booking milik user yang sedang login
            $bookings = Auth::user()->bookings()->latest()->get();
            return view('dashboard', compact('bookings'));
        })->name('dashboard');
    });


// Grup Rute untuk Pengguna dengan Peran "Admin"
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('rooms', AdminRoomController::class);
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    });

// Rute Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rute Autentikasi Bawaan Laravel Breeze
require __DIR__.'/auth.php';
