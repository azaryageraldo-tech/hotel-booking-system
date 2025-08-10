<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    /**
     * Menampilkan daftar semua kamar.
     */
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Menampilkan form untuk membuat kamar baru.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Menyimpan kamar baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Kamar baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kamar.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Mengupdate data kamar di database.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => ['required', 'string', 'max:255', Rule::unique('rooms')->ignore($room->id)],
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Data kamar berhasil diperbarui.');
    }

    /**
     * Menghapus kamar dari database.
     */
    public function destroy(Room $room)
    {
        // 1. Hapus data kamar dari database
        $room->delete();

        // 2. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Kamar berhasil dihapus.');
    }
    
    // Method show() tidak kita gunakan, jadi bisa dibiarkan kosong
    public function show(Room $room)
    {
        //
    }
}
