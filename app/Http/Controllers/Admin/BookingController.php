<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Booking;
    use Illuminate\Http\Request;

    class BookingController extends Controller
    {
        public function index()
        {
            $bookings = Booking::with(['user', 'room'])->latest()->paginate(10);
            return view('admin.bookings.index', compact('bookings'));
        }

        /**
         * Memperbarui status booking.
         */
        public function updateStatus(Request $request, Booking $booking)
        {
            // 1. Validasi input status
            $request->validate([
                'status' => 'required|string|in:pending,confirmed,cancelled',
            ]);

            // 2. Update status booking di database
            $booking->update([
                'status' => $request->status,
            ]);

            // 3. Redirect kembali dengan pesan sukses
            return redirect()->route('admin.bookings.index')->with('success', 'Status booking berhasil diperbarui.');
        }
    }
    