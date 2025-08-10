    @extends('layouts.receptionist')

    @section('title', 'Tambah Booking Walk-in')
    @section('subtitle', 'Buat reservasi baru untuk tamu yang datang langsung.')

    @section('content')
    <div class="bg-white p-6 rounded-xl shadow-lg">
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Terjadi Kesalahan</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('receptionist.bookings.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pilih Tamu -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-slate-700 mb-1">Pilih Tamu</label>
                    <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                        <option value="">-- Pilih Tamu Terdaftar --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <!-- Pilih Kamar -->
                <div>
                    <label for="room_id" class="block text-sm font-medium text-slate-700 mb-1">Pilih Kamar Tersedia</label>
                    <select name="room_id" id="room_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                        <option value="">-- Pilih Kamar --</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->type }} - No. {{ $room->room_number }} (Rp {{ number_format($room->price_per_night) }})</option>
                        @endforeach
                    </select>
                </div>
                <!-- Tanggal Check-in -->
                <div>
                    <label for="check_in_date" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Check-in</label>
                    <input type="date" name="check_in_date" id="check_in_date" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                </div>
                <!-- Tanggal Check-out -->
                <div>
                    <label for="check_out_date" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Check-out</label>
                    <input type="date" name="check_out_date" id="check_out_date" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('receptionist.bookings.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-2.5 px-5 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2.5 px-5 rounded-lg transition-colors">
                    Simpan Booking
                </button>
            </div>
        </form>
    </div>
    @endsection
    