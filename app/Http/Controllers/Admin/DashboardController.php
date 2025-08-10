<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Import DB Facade

class DashboardController extends Controller
{
    public function index()
    {
        // ... (Logika perhitungan kartu ringkasan tetap sama) ...
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $today = Carbon::today();
        $monthlyBookingsCount = Booking::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $monthlyRevenue = Booking::whereIn('status', ['confirmed', 'checked-in', 'completed'])->whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_price');
        $checkInsTodayCount = Booking::where('check_in_date', $today)->where('status', 'confirmed')->count();
        $totalRooms = Room::count();
        $totalDaysInMonth = $startOfMonth->daysInMonth;
        $totalRoomNights = $totalRooms > 0 ? $totalRooms * $totalDaysInMonth : 1;
        $bookedRoomNights = 0;
        $bookingsThisMonth = Booking::whereIn('status', ['confirmed', 'checked-in', 'completed'])->where(function ($query) use ($startOfMonth, $endOfMonth) {
            $query->where('check_in_date', '<=', $endOfMonth)->where('check_out_date', '>', $startOfMonth);
        })->get();
        foreach ($bookingsThisMonth as $booking) {
            $checkin = Carbon::parse($booking->check_in_date)->max($startOfMonth);
            $checkout = Carbon::parse($booking->check_out_date)->min($endOfMonth);
            $bookedRoomNights += $checkin->diffInDays($checkout);
        }
        $occupancyRate = ($totalRoomNights > 0) ? ($bookedRoomNights / $totalRoomNights) * 100 : 0;
        $recentActivities = Booking::with(['user', 'room'])->latest()->take(5)->get();

        // --- INI LOGIKA BARU UNTUK GRAFIK ---
        $bookingsChart = Booking::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(6))
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        $labels = [];
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthNumber = $month->month;
            $labels[] = $month->format('F'); // Nama bulan, e.g., "Juli", "Agustus"
            
            $bookingData = $bookingsChart->firstWhere('month', $monthNumber);
            $data[] = $bookingData ? $bookingData->count : 0;
        }

        $chartLabels = json_encode($labels);
        $chartData = json_encode($data);
        // --- AKHIR LOGIKA BARU ---

        return view('admin.dashboard', compact(
            'monthlyBookingsCount',
            'monthlyRevenue',
            'checkInsTodayCount',
            'occupancyRate',
            'recentActivities',
            'chartLabels', // Kirim data label ke view
            'chartData'   // Kirim data jumlah booking ke view
        ));
    }
}
