<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user tamu dan kamar pertama yang tersedia untuk contoh
        $user = User::where('role', 'tamu')->first();
        $roomForCheckIn = Room::find(1); // Ambil kamar dengan ID 1
        $roomForCheckOut = Room::find(2); // Ambil kamar dengan ID 2

        // Pastikan user dan kamar ada
        if (!$user || !$roomForCheckIn || !$roomForCheckOut) {
            $this->command->info('Pastikan ada minimal 1 user tamu dan 2 kamar di database.');
            return;
        }

        // Nonaktifkan foreign key untuk membersihkan tabel
        Schema::disableForeignKeyConstraints();
        Booking::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Buat data dummy untuk tamu yang akan CHECK-IN HARI INI
        Booking::create([
            'user_id' => $user->id,
            'room_id' => $roomForCheckIn->id,
            'check_in_date' => Carbon::today(), // Tanggal hari ini
            'check_out_date' => Carbon::today()->addDays(2),
            'total_price' => 2 * $roomForCheckIn->price_per_night,
            'status' => 'confirmed', // Status harus 'confirmed' agar muncul di daftar check-in
        ]);

        // 2. Buat data dummy untuk tamu yang akan CHECK-OUT HARI INI
        Booking::create([
            'user_id' => $user->id,
            'room_id' => $roomForCheckOut->id,
            'check_in_date' => Carbon::today()->subDays(3), // Check-in 3 hari yang lalu
            'check_out_date' => Carbon::today(), // Check-out hari ini
            'total_price' => 3 * $roomForCheckOut->price_per_night,
            'status' => 'checked-in', // Statusnya seolah-olah sudah check-in
        ]);

        $this->command->info('Data booking dummy untuk resepsionis berhasil dibuat.');
    }
}
