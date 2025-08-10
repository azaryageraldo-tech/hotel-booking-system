<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; // <-- Tambahkan ini
use App\Models\Room;
use App\Models\Booking; // <-- Tambahkan ini

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Nonaktifkan sementara pemeriksaan foreign key
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan tabel (bookings dulu, baru rooms)
        Booking::truncate();
        Room::truncate();

        // 3. Aktifkan kembali pemeriksaan foreign key
        Schema::enableForeignKeyConstraints();

        // 4. Buat data kamar baru
        Room::create([
            'room_number' => '101',
            'type' => 'Deluxe Suite',
            'description' => 'Kamar mewah dengan pemandangan kota dan bathtub pribadi. Ruang tamu terpisah memberikan privasi dan kenyamanan ekstra.',
            'price_per_night' => 1500000,
            'status' => 'tersedia',
            'image_url' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=2070&auto=format&fit=crop'
        ]);

        Room::create([
            'room_number' => '102',
            'type' => 'Premier Room',
            'description' => 'Kamar yang luas dan nyaman dengan desain modern, dilengkapi dengan semua fasilitas yang Anda butuhkan untuk masa inap yang menyenangkan.',
            'price_per_night' => 950000,
            'status' => 'tersedia',
            'image_url' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?q=80&w=2070&auto=format&fit=crop'
        ]);

        Room::create([
            'room_number' => '201',
            'type' => 'Standard Room',
            'description' => 'Pilihan ekonomis yang tetap menawarkan kenyamanan dan kebersihan. Sempurna untuk solo traveler atau perjalanan bisnis singkat.',
            'price_per_night' => 600000,
            'status' => 'tersedia',
            'image_url' => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?q=80&w=2070&auto=format&fit=crop'
        ]);
    }
}
