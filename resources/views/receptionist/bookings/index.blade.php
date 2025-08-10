    @extends('layouts.receptionist')

    @section('title', 'Kelola Reservasi')
    @section('subtitle', 'Lihat, filter, dan kelola semua data booking.')

    @section('content')
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-slate-700">Semua Data Booking</h2>
                <!-- INI PERUBAHANNYA -->
                <a href="{{ route('receptionist.bookings.create') }}"
                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2.5 px-5 rounded-lg flex items-center transition-colors">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Booking (Walk-in)
                </a>
            </div>

            <!-- Tabel Daftar Booking -->
            <div class="overflow-x-auto rounded-lg border border-slate-200">
                <table class="min-w-full bg-white">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Nama Tamu</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Kamar</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Tanggal</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Status</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 divide-y divide-slate-200">
                        @forelse ($bookings as $booking)
                            <tr>
                                <td class="py-3 px-4 font-medium">{{ $booking->user->name }}</td>
                                <td class="py-3 px-4">{{ $booking->room->type }} (No. {{ $booking->room->room_number }})
                                </td>
                                <td class="py-3 px-4">
                                    <span class="font-semibold">Check-in:</span>
                                    {{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') }} <br>
                                    <span class="font-semibold">Check-out:</span>
                                    {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') }}
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="py-1 px-3 rounded-full text-xs font-bold
                                    @if ($booking->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($booking->status == 'confirmed') bg-green-100 text-green-700
                                    @elseif($booking->status == 'checked-in') bg-sky-100 text-sky-700
                                    @elseif($booking->status == 'completed') bg-slate-100 text-slate-700
                                    @elseif($booking->status == 'cancelled') bg-red-100 text-red-700 @endif">
                                        {{ ucfirst(str_replace('-', ' ', $booking->status)) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <!-- INI PERUBAHANNYA -->
                                    <a href="{{ route('receptionist.bookings.show', $booking->id) }}"
                                        class="bg-slate-200 hover:bg-slate-300 text-slate-600 py-1.5 px-3 rounded-md text-sm font-medium transition-colors">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-16 text-slate-500">
                                    <p class="text-lg font-medium">Belum Ada Reservasi</p>
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
