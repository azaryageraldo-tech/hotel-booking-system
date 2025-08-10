<?php

    namespace App\Http\Controllers\Guest;

    use App\Http\Controllers\Controller;
    use App\Models\Booking;
    use App\Models\Review;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class ReviewController extends Controller
    {
        /**
         * Menampilkan form untuk membuat ulasan baru.
         */
        public function create(Booking $booking)
        {
            // Otorisasi: Pastikan user yang login adalah pemilik booking
            if (Auth::id() !== $booking->user_id) {
                abort(403, 'Akses Ditolak');
            }

            // Pastikan booking sudah selesai dan belum diulas
            if ($booking->status !== 'completed' || $booking->review) {
                return redirect()->route('dashboard')->with('error', 'Booking ini tidak bisa diulas.');
            }

            return view('guest.reviews.create', compact('booking'));
        }

        /**
         * Menyimpan ulasan baru ke database.
         */
        public function store(Request $request, Booking $booking)
        {
            // Otorisasi
            if (Auth::id() !== $booking->user_id) {
                abort(403, 'Akses Ditolak');
            }
            
            // Validasi input
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000',
            ]);

            // Buat ulasan baru
            Review::create([
                'user_id' => Auth::id(),
                'room_id' => $booking->room_id,
                'booking_id' => $booking->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return redirect()->route('dashboard')->with('success', 'Terima kasih! Ulasan Anda telah berhasil dikirim.');
        }
    }
    