<?php

    namespace App\Http\Controllers\Receptionist;

    use App\Http\Controllers\Controller;
    use App\Models\Room;
    use Illuminate\Http\Request;

    class RoomStatusController extends Controller
    {
        /**
         * Menampilkan halaman status semua kamar.
         */
        public function index()
        {
            $rooms = Room::orderBy('room_number', 'asc')->get();
            return view('receptionist.rooms.status', compact('rooms'));
        }

        /**
         * Memperbarui status kamar secara manual.
         */
        public function update(Request $request, Room $room)
        {
            $request->validate([
                'status' => 'required|string|in:tersedia,terisi,dibersihkan,perbaikan',
            ]);

            $room->update(['status' => $request->status]);

            return redirect()->route('receptionist.rooms.status.index')->with('success', "Status Kamar No. {$room->room_number} berhasil diubah.");
        }
    }
    