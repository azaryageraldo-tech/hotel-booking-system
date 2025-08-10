<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request, Room $room)
    {
        $request->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
        ]);

        $checkinDate = Carbon::parse($request->checkin);
        $checkoutDate = Carbon::parse($request->checkout);

        $isBooked = Booking::where('room_id', $room->id)
            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                $query->where('check_in_date', '<', $checkoutDate)
                      ->where('check_out_date', '>', $checkinDate);
            })->exists();

        if ($isBooked) {
            return back()->with('error', 'Maaf, kamar tidak tersedia pada tanggal yang Anda pilih.');
        }

        // --- INI PERUBAHANNYA ---
        $nights = $checkinDate->diffInDays($checkoutDate);
        $subtotal = $nights * $room->price_per_night;
        
        // Ambil nilai pajak dan service fee dari helper
        $taxPercentage = setting('tax_percentage', 10); // Default 10% jika tidak ada
        $serviceFeePercentage = setting('service_fee_percentage', 5); // Default 5% jika tidak ada

        $taxAmount = $subtotal * ($taxPercentage / 100);
        $serviceFeeAmount = $subtotal * ($serviceFeePercentage / 100);
        
        $totalPrice = $subtotal + $taxAmount + $serviceFeeAmount;
        // --- AKHIR PERUBAHAN ---

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in_date' => $checkinDate,
            'check_out_date' => $checkoutDate,
            'total_price' => $totalPrice, // Gunakan total harga yang baru
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking Anda berhasil! Mohon tunggu konfirmasi dari kami.');
    }
}
