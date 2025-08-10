<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang Kembali - HotelHebat</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Gilda+Display&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-display { font-family: 'Gilda Display', serif; }
    </style>
</head>
<body class="bg-slate-100">

    <!-- Header untuk Tamu yang Sudah Login -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-bold font-display text-gray-800">Hotel<span class="text-amber-500">Hebat</span></a>
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-3">
                    <span class="font-semibold text-slate-600 hidden sm:block">{{ Auth::user()->name }}</span>
                    <img class="h-9 w-9 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="User avatar">
                </button>
                <div x-show="open" @click.away="open = false" 
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-20" style="display: none;">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"><i class="fa-solid fa-tachometer-alt w-6"></i>Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"><i class="fa-solid fa-user-edit w-6"></i>Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                            <i class="fa-solid fa-right-from-bracket w-6"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Konten Utama -->
    <main>
        <!-- Panel Sambutan dengan Latar Belakang Gradien -->
        <section class="bg-gradient-to-r from-slate-800 to-slate-900 text-white pt-16 pb-12">
            <div class="container mx-auto px-6">
                <h1 class="text-4xl font-bold font-display">Selamat datang, {{ Auth::user()->name }}!</h1>
                <p class="text-slate-300 mt-1">Siap untuk petualangan Anda berikutnya? Temukan kamar terbaik di bawah ini.</p>
            </div>
        </section>

        <!-- Form Pencarian yang Menonjol -->
        <section class="container mx-auto px-6 -mt-10">
            <div class="bg-white p-6 rounded-xl shadow-2xl border">
                <form action="{{ route('rooms.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="checkin" class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                        <input type="date" id="checkin" name="checkin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label for="checkout" class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                        <input type="date" id="checkout" name="checkout" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tamu</label>
                        <select id="guests" name="guests" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option>1 Tamu</option><option selected>2 Tamu</option><option>3 Tamu</option><option>4 Tamu</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-amber-600 text-white font-bold py-3 px-4 rounded-md hover:bg-amber-700 transition duration-300 h-11 shadow-lg shadow-amber-500/20">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i>Cari Kamar
                    </button>
                </form>
            </div>
        </section>

        <!-- Konten Dashboard -->
        <section class="container mx-auto px-6 py-12">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Utama: Perjalanan & Rekomendasi -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Perjalanan Anda Berikutnya -->
                    <div>
                        <h2 class="text-2xl font-bold text-slate-700 mb-4">Perjalanan Anda Berikutnya</h2>
                        @php
                            $upcomingBooking = $bookings->whereIn('status', ['confirmed', 'checked-in'])->sortBy('check_in_date')->first();
                        @endphp

                        @if($upcomingBooking)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-shadow hover:shadow-2xl">
                                <div class="grid grid-cols-1 md:grid-cols-3">
                                    <img src="{{ $upcomingBooking->room->image_url ?? 'https://placehold.co/600x400' }}" alt="{{ $upcomingBooking->room->type }}" class="md:col-span-1 h-full w-full object-cover">
                                    <div class="md:col-span-2 p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="text-3xl font-bold font-display">{{ $upcomingBooking->room->type }}</h3>
                                                <p class="text-slate-500">No. Kamar {{ $upcomingBooking->room->room_number }}</p>
                                            </div>
                                            <span class="py-1 px-3 rounded-full text-xs font-bold
                                                @if($upcomingBooking->status == 'confirmed') bg-green-100 text-green-700
                                                @elseif($upcomingBooking->status == 'checked-in') bg-sky-100 text-sky-700
                                                @endif">
                                                {{ ucfirst(str_replace('-', ' ', $upcomingBooking->status)) }}
                                            </span>
                                        </div>
                                        <div class="border-t my-4"></div>
                                        <div class="flex space-x-6 text-slate-600">
                                            <div class="flex items-center"><i class="fa-solid fa-calendar-check text-amber-500 mr-2"></i> <div><p class="text-xs">Check-in</p><p class="font-semibold">{{ \Carbon\Carbon::parse($upcomingBooking->check_in_date)->format('d M Y') }}</p></div></div>
                                            <div class="flex items-center"><i class="fa-solid fa-calendar-times text-amber-500 mr-2"></i> <div><p class="text-xs">Check-out</p><p class="font-semibold">{{ \Carbon\Carbon::parse($upcomingBooking->check_out_date)->format('d M Y') }}</p></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-white rounded-xl shadow-lg p-8 text-center border-2 border-dashed">
                                <i class="fa-solid fa-suitcase-rolling text-5xl text-slate-400 mb-4"></i>
                                <p class="text-lg font-semibold text-slate-700">Anda tidak memiliki perjalanan yang akan datang.</p>
                                <p class="text-slate-500">Waktunya merencanakan liburan baru!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Kolom Kanan: Riwayat Booking -->
                <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold text-slate-700 mb-4">Riwayat Booking</h2>
            <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                @forelse ($bookings as $booking)
                    <div class="border-b border-slate-100 pb-4">
                        <div class="flex justify-between items-center">
                            <p class="font-semibold text-slate-800">{{ $booking->room->type }}</p>
                            <p class="text-sm font-bold 
                                @if($booking->status == 'completed') text-slate-500
                                @elseif($booking->status == 'cancelled') text-red-500
                                @else text-green-600 @endif">
                                {{ ucfirst(str_replace('-', ' ', $booking->status)) }}
                            </p>
                        </div>
                        <p class="text-sm text-slate-500">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') }}</p>
                        
                        <!-- INI PERUBAHANNYA: Tombol Tulis Ulasan -->
                        @if($booking->status == 'completed' && !$booking->review)
                            <a href="{{ route('reviews.create', $booking->id) }}" class="mt-2 inline-block text-sm text-amber-600 hover:text-amber-700 font-semibold">
                                <i class="fa-solid fa-pencil-alt mr-1"></i> Tulis Ulasan
                            </a>
                        @endif
                    </div>
                @empty
                    <p class="text-slate-500 text-center py-8">Tidak ada riwayat booking.</p>
                @endforelse
            </div>
        </div>
    </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-6 py-16">
            <div class="border-t border-gray-700 pt-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} HotelHebat. Semua Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
