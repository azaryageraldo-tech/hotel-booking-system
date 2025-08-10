<?php

    namespace App\Http\Controllers\Receptionist;

    use App\Http\Controllers\Controller;
    use App\Models\Booking;
    use App\Models\Room;
    use App\Models\User;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    class BookingController extends Controller
    {
        public function index()
        {
            $bookings = Booking::with(['user', 'room'])->latest()->paginate(10);
            return view('receptionist.bookings.index', compact('bookings'));
        }

        public function show(Booking $booking)
        {
            // Eager load relasi untuk memastikan data user dan kamar sudah terambil
            $booking->load(['user', 'room']);
            return view('receptionist.bookings.show', compact('booking'));
        }

        /**
         * Menampilkan form untuk membuat booking walk-in.
         */
        public function create()
        {
            // Ambil semua user dengan role 'tamu' untuk dipilih
            $users = User::where('role', 'tamu')->get();
            // Ambil semua kamar yang statusnya 'tersedia' atau 'dibersihkan'
            $rooms = Room::whereIn('status', ['tersedia', 'dibersihkan'])->get();

            return view('receptionist.bookings.create', compact('users', 'rooms'));
        }

        /**
         * Menyimpan booking walk-in baru.
         */
        public function store(Request $request)
        {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'room_id' => 'required|exists:rooms,id',
                'check_in_date' => 'required|date',
                'check_out_date' => 'required|date|after:check_in_date',
            ]);

            $room = Room::findOrFail($request->room_id);
            $checkinDate = Carbon::parse($request->check_in_date);
            $checkoutDate = Carbon::parse($request->check_out_date);

            // Hitung total harga
            $nights = $checkinDate->diffInDays($checkoutDate);
            $totalPrice = $nights * $room->price_per_night;

            // Buat booking baru
            Booking::create([
                'user_id' => $request->user_id,
                'room_id' => $request->room_id,
                'check_in_date' => $checkinDate,
                'check_out_date' => $checkoutDate,
                'total_price' => $totalPrice,
                'status' => 'confirmed', // Booking walk-in langsung dikonfirmasi
            ]);

            return redirect()->route('receptionist.bookings.index')->with('success', 'Booking walk-in berhasil ditambahkan.');
        }

        public function checkIn(Booking $booking)
        {
            $booking->update(['status' => 'checked-in']);
            $booking->room->update(['status' => 'terisi']);
            return redirect()->route('receptionist.dashboard')->with('success', 'Tamu berhasil check-in.');
        }

        public function checkOut(Booking $booking)
        {
            $booking->update(['status' => 'completed']);
            $booking->room->update(['status' => 'dibersihkan']);
            return redirect()->route('receptionist.dashboard')->with('success', 'Tamu berhasil check-out.');
        }
    }
    