<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookingsExport; // Import kelas export yang kita buat
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Import fasad untuk Excel
use Barryvdh\DomPDF\Facade\Pdf;       // Import fasad untuk PDF

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan dengan data yang sudah dihitung.
     */
    public function index(Request $request)
    {
        // Tentukan rentang tanggal dari input filter, atau default ke bulan ini
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();

        // 1. Ambil data booking yang relevan (bukan pending atau cancelled)
        $bookings = Booking::whereIn('status', ['confirmed', 'checked-in', 'completed'])
                           ->whereBetween('check_in_date', [$startDate, $endDate])
                           ->get();

        // 2. Hitung Laporan Pendapatan
        $totalRevenue = $bookings->sum('total_price');
        $totalBookings = $bookings->count();

        // 3. Hitung Laporan Okupansi
        $totalRooms = Room::count();
        $totalDaysInRange = $startDate->diffInDays($endDate) + 1;
        $totalRoomNights = $totalRooms > 0 ? $totalRooms * $totalDaysInRange : 1; // Total "inventaris" kamar-malam

        $bookedRoomNights = 0;
        foreach ($bookings as $booking) {
            $checkin = Carbon::parse($booking->check_in_date);
            $checkout = Carbon::parse($booking->check_out_date);
            // Hitung berapa malam dari booking ini yang masuk dalam rentang tanggal laporan
            $nightsInRange = $checkin->diffInDays($checkout->min($endDate));
            $bookedRoomNights += $nightsInRange > 0 ? $nightsInRange : 1;
        }

        $occupancyRate = ($totalRoomNights > 0) ? ($bookedRoomNights / $totalRoomNights) * 100 : 0;

        // Kirim semua data yang sudah dihitung ke view
        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalBookings',
            'occupancyRate',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Menangani ekspor laporan ke Excel.
     */
    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();

        $fileName = 'Laporan_Booking_' . $startDate->format('d-m-Y') . '_-_' . $endDate->format('d-m-Y') . '.xlsx';

        // Panggil kelas BookingsExport yang sudah kita buat
        return Excel::download(new BookingsExport($startDate, $endDate), $fileName);
    }

    /**
     * Menangani ekspor laporan ke PDF.
     */
    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();

        // Ambil data booking yang relevan untuk dikirim ke view PDF
        $bookings = Booking::with(['user', 'room'])
            ->whereIn('status', ['confirmed', 'checked-in', 'completed'])
            ->whereBetween('check_in_date', [$startDate, $endDate])
            ->get();
        
        $data = [
            'bookings' => $bookings,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        // Buat PDF dari view 'admin.reports.pdf'
        $pdf = Pdf::loadView('admin.reports.pdf', $data);
        $fileName = 'Laporan_Booking_' . $startDate->format('d-m-Y') . '_-_' . $endDate->format('d-m-Y') . '.pdf';
        
        // Unduh file PDF
        return $pdf->download($fileName);
    }
}
