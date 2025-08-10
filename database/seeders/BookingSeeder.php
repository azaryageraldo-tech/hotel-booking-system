<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
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
            // Ambil semua user dengan role 'tamu' dan semua kamar yang ada
            $users = User::where('role', 'tamu')->get();
            $rooms = Room::all();

            // Pastikan ada user dan kamar sebelum membuat booking
            if ($users->isEmpty() || $rooms->isEmpty()) {
                $this->command->info('Tidak ada user tamu atau kamar untuk membuat booking dummy. Silakan buat user tamu terlebih dahulu.');
                return;
            }

            // Buat 3 data booking dummy
            for ($i = 0; $i < 3; $i++) {
                $room = $rooms->random();
                $user = $users->random();

                $checkin = Carbon::now()->addDays(rand(1, 10));
                $checkout = $checkin->copy()->addDays(rand(1, 5));
                $nights = $checkin->diffInDays($checkout);

                Booking::create([
                    'user_id' => $user->id,
                    'room_id' => $room->id,
                    'check_in_date' => $checkin,
                    'check_out_date' => $checkout,
                    'total_price' => $nights * $room->price_per_night,
                    'status' => 'pending',
                ]);
            }
        }
    }
    