<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Menyimpan booking baru ke database.
     */
    public function store(Request $request, Room $room)
    {
        // 1. Validasi input dari form
        $request->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
        ]);

        $checkinDate = Carbon::parse($request->checkin);
        $checkoutDate = Carbon::parse($request->checkout);

        // 2. Cek ulang ketersediaan kamar untuk mencegah double booking
        $isBooked = Booking::where('room_id', $room->id)
            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                $query->where('check_in_date', '<', $checkoutDate)
                      ->where('check_out_date', '>', $checkinDate);
            })->exists();

        if ($isBooked) {
            return back()->with('error', 'Maaf, kamar tidak tersedia pada tanggal yang Anda pilih. Silakan pilih tanggal lain.');
        }

        // 3. Hitung total harga
        $numberOfNights = $checkinDate->diffInDays($checkoutDate);
        $totalPrice = $numberOfNights * $room->price_per_night;

        // 4. Buat dan simpan data booking
        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in_date' => $checkinDate,
            'check_out_date' => $checkoutDate,
            'total_price' => $totalPrice,
            'status' => 'pending', // Status awal, nanti bisa dikonfirmasi oleh admin/resepsionis
        ]);

        // 5. Redirect ke dashboard tamu dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Booking Anda berhasil! Mohon tunggu konfirmasi dari kami.');
    }
}
