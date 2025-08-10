    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Saya') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Pesan Sukses -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        <p class="font-bold">Sukses!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Riwayat Booking Anda</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left py-2 px-4">Kamar</th>
                                        <th class="text-left py-2 px-4">Check-in</th>
                                        <th class="text-left py-2 px-4">Check-out</th>
                                        <th class="text-left py-2 px-4">Total Harga</th>
                                        <th class="text-left py-2 px-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr class="border-b">
                                            <td class="py-2 px-4">{{ $booking->room->type }} (No. {{ $booking->room->room_number }})</td>
                                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') }}</td>
                                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') }}</td>
                                            <td class="py-2 px-4">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                            <td class="py-2 px-4">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($booking->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                                    @if($booking->status == 'confirmed') bg-green-100 text-green-800 @endif
                                                    @if($booking->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">Anda belum memiliki riwayat booking.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    