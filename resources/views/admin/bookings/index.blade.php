@extends('layouts.admin')

@section('title', 'Manajemen Reservasi')
@section('subtitle', 'Kelola semua reservasi yang masuk.')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-slate-200">
        <table class="min-w-full bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Nama Tamu</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Kamar</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Tanggal</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Total Harga</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Status</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-slate-700 divide-y divide-slate-200">
                @forelse ($bookings as $booking)
                    <tr>
                        <td class="py-3 px-4 font-medium">{{ $booking->user->name }}</td>
                        <td class="py-3 px-4">{{ $booking->room->type }} (No. {{ $booking->room->room_number }})</td>
                        <td class="py-3 px-4">
                            <span class="font-semibold">Check-in:</span> {{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') }} <br>
                            <span class="font-semibold">Check-out:</span> {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') }}
                        </td>
                        <td class="py-3 px-4">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <span class="py-1 px-3 rounded-full text-xs font-bold
                                @if($booking->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($booking->status == 'confirmed') bg-green-100 text-green-700
                                @elseif($booking->status == 'cancelled') bg-red-100 text-red-700
                                @else bg-slate-100 text-slate-700 @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <!-- INI PERUBAHANNYA: Dropdown Aksi -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="bg-slate-200 hover:bg-slate-300 text-slate-600 py-1.5 px-3 rounded-md text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" 
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-20 text-left"
                                     x-transition style="display: none;">
                                    
                                    <!-- Aksi Konfirmasi -->
                                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                            <i class="fa-solid fa-check-circle w-6 text-green-500"></i> Konfirmasi
                                        </button>
                                    </form>

                                    <!-- Aksi Batalkan -->
                                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                            <i class="fa-solid fa-times-circle w-6 text-red-500"></i> Batalkan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-16 text-slate-500">
                            <i class="fa-solid fa-book-bookmark text-5xl mb-4"></i>
                            <p class="text-lg font-medium">Belum Ada Reservasi</p>
                            <p class="text-sm">Saat ini tidak ada data reservasi yang masuk.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
