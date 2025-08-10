    @extends('layouts.receptionist')

    @section('title', 'Detail Reservasi')
    @section('subtitle', 'Informasi lengkap untuk booking #' . $booking->id)

    @section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Detail Booking & Kamar -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Detail Booking -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold text-slate-700 mb-4">Informasi Booking</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500">Tanggal Check-in</p>
                        <p class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Tanggal Check-out</p>
                        <p class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Total Harga</p>
                        <p class="font-semibold text-slate-800">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Status</p>
                        <span class="py-1 px-3 rounded-full text-xs font-bold
                            @if($booking->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($booking->status == 'confirmed') bg-green-100 text-green-700
                            @elseif($booking->status == 'checked-in') bg-sky-100 text-sky-700
                            @elseif($booking->status == 'completed') bg-slate-100 text-slate-700
                            @elseif($booking->status == 'cancelled') bg-red-100 text-red-700
                            @endif">
                            {{ ucfirst(str_replace('-', ' ', $booking->status)) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Detail Kamar -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold text-slate-700 mb-4">Informasi Kamar</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500">Tipe Kamar</p>
                        <p class="font-semibold text-slate-800">{{ $booking->room->type }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Nomor Kamar</p>
                        <p class="font-semibold text-slate-800">{{ $booking->room->room_number }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Harga per Malam</p>
                        <p class="font-semibold text-slate-800">Rp {{ number_format($booking->room->price_per_night, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Detail Tamu -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold text-slate-700 mb-4">Informasi Tamu</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-slate-500">Nama</p>
                        <p class="font-semibold text-slate-800">{{ $booking->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Email</p>
                        <p class="font-semibold text-slate-800">{{ $booking->user->email }}</p>
                    </div>
                    {{-- Nanti bisa ditambahkan nomor telepon di sini --}}
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('receptionist.bookings.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-2 px-4 rounded-lg transition-colors">
            &larr; Kembali ke Daftar Reservasi
        </a>
    </div>
    @endsection
    