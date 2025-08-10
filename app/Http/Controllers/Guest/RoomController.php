<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
    {
        public function index(Request $request)
        {
            $query = Room::where('status', 'tersedia');

            if ($request->filled('type')) {
                $query->where('type', $request->type);
            }

            if ($request->filled('checkin') && $request->filled('checkout')) {
                $checkinDate = $request->checkin;
                $checkoutDate = $request->checkout;

                $query->whereDoesntHave('bookings', function ($q) use ($checkinDate, $checkoutDate) {
                    $q->where(function ($q2) use ($checkinDate, $checkoutDate) {
                        $q2->where('check_in_date', '<', $checkoutDate)
                           ->where('check_out_date', '>', $checkinDate);
                    });
                });
            }

            $rooms = $query->latest()->paginate(9)->withQueryString();

            return view('guest.rooms.index', compact('rooms'));
        }

        /**
         * Menampilkan halaman detail untuk satu kamar.
         */
        public function show(Room $room)
        {
            // Laravel akan otomatis mencari kamar berdasarkan ID dari URL (Route Model Binding)
            return view('guest.rooms.show', compact('room'));
        }
    }
