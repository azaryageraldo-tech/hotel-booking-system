<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Guest\RoomController as GuestRoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Receptionist\DashboardController as ReceptionistDashboardController;
use App\Http\Controllers\Receptionist\BookingController as ReceptionistBookingController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Guest\ReviewController as GuestReviewController;
use App\Http\Controllers\Receptionist\RoomStatusController; 
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\GoogleLoginController;

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
    Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
        Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
    });



// ## Rute Publik yang bisa diakses SEMUA ORANG ##
Route::get('/rooms', [GuestRoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room}', [GuestRoomController::class, 'show'])->name('rooms.show');
Route::post('/bookings/{room}', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');


// ## Rute yang memerlukan LOGIN ##

// Grup Rute untuk Pengguna dengan Peran "Tamu"
Route::middleware(['auth', 'verified', 'role:tamu'])->group(function () {
    // Rute ini sekarang menjadi "rumah" bagi tamu yang sudah login
    Route::get('/dashboard', function () {
        $bookings = Auth::user()->bookings()->with('room')->latest()->get();
        return view('dashboard', compact('bookings'));
    })->name('dashboard');
    
    Route::get('/reviews/{booking}/create', [GuestReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/{booking}', [GuestReviewController::class, 'store'])->name('reviews.store');
    });    


// Grup Rute untuk Pengguna dengan Peran "Admin"
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
    Route::resource('rooms', AdminRoomController::class);
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/excel', [AdminReportController::class, 'exportExcel'])->name('reports.exportExcel');
    Route::get('/reports/pdf', [AdminReportController::class, 'exportPdf'])->name('reports.exportPdf');
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::resource('users', AdminUserController::class);
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

// Grup Rute untuk Pengguna dengan Peran "Resepsionis"
Route::middleware(['auth', 'verified', 'role:resepsionis'])->prefix('receptionist')->name('receptionist.')->group(function () {
    Route::get('/dashboard', [ReceptionistDashboardController::class, 'index'])->name('dashboard');
    Route::patch('/bookings/{booking}/checkin', [ReceptionistBookingController::class, 'checkIn'])->name('bookings.checkin');
    Route::patch('/bookings/{booking}/checkout', [ReceptionistBookingController::class, 'checkOut'])->name('bookings.checkout');
    Route::get('/bookings', [ReceptionistBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [ReceptionistBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [ReceptionistBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [ReceptionistBookingController::class, 'show'])->name('bookings.show');
    Route::get('/rooms/status', [RoomStatusController::class, 'index'])->name('rooms.status.index');
    Route::patch('/rooms/{room}/status', [RoomStatusController::class, 'update'])->name('rooms.status.update');
});

// Rute Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rute Autentikasi Bawaan Laravel Breeze
require __DIR__.'/auth.php';
