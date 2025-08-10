<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Ambil booking yang check-in hari ini DAN statusnya 'confirmed'
        $checkInsToday = Booking::with(['user', 'room'])
            ->where('check_in_date', $today)
            ->where('status', 'confirmed')
            ->get();

        // INI PERBAIKANNYA:
        // Ambil booking yang check-out hari ini DAN statusnya masih 'checked-in'
        $checkOutsToday = Booking::with(['user', 'room'])
            ->where('check_out_date', $today)
            ->where('status', 'checked-in') // <-- Tambahkan kondisi ini
            ->get();

        return view('receptionist.dashboard', compact('checkInsToday', 'checkOutsToday'));
    }
}
