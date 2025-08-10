@extends('layouts.receptionist')

@section('title', 'Dashboard Resepsionis')
@section('subtitle', 'Aktivitas operasional hotel untuk hari ini.')

@section('content')

@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
        <p class="font-bold">Sukses!</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Kolom Check-in Hari Ini -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <i class="fa-solid fa-person-walking-arrow-right text-2xl text-green-500 mr-3"></i>
            <h2 class="text-xl font-bold text-slate-800">Tamu Akan Check-in ({{ $checkInsToday->count() }})</h2>
        </div>
        <div class="space-y-4">
            @forelse ($checkInsToday as $booking)
                <div class="bg-slate-50 p-4 rounded-lg flex justify-between items-center">
                    <div>
                        <p class="font-semibold text-slate-700">{{ $booking->user->name }}</p>
                        <p class="text-sm text-slate-500">Kamar {{ $booking->room->type }} (No. {{ $booking->room->room_number }})</p>
                    </div>
                    <!-- Tombol Check-in menjadi Form -->
                    <form action="{{ route('receptionist.bookings.checkin', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-3 rounded-lg text-sm">
                            Check-in
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center py-10 text-slate-500">
                    <i class="fa-solid fa-calendar-check text-4xl mb-3"></i>
                    <p>Tidak ada tamu yang check-in hari ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Kolom Check-out Hari Ini -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <i class="fa-solid fa-person-walking-arrow-left text-2xl text-red-500 mr-3"></i>
            <h2 class="text-xl font-bold text-slate-800">Tamu Akan Check-out ({{ $checkOutsToday->count() }})</h2>
        </div>
        <div class="space-y-4">
            @forelse ($checkOutsToday as $booking)
                <div class="bg-slate-50 p-4 rounded-lg flex justify-between items-center">
                    <div>
                        <p class="font-semibold text-slate-700">{{ $booking->user->name }}</p>
                        <p class="text-sm text-slate-500">Kamar {{ $booking->room->type }} (No. {{ $booking->room->room_number }})</p>
                    </div>
                    <!-- Tombol Check-out menjadi Form -->
                    <form action="{{ route('receptionist.bookings.checkout', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded-lg text-sm">
                            Check-out
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center py-10 text-slate-500">
                    <i class="fa-solid fa-calendar-times text-4xl mb-3"></i>
                    <p>Tidak ada tamu yang check-out hari ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
