<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->type }} - Detail Kamar - HotelHebat</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Gilda+Display&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-display { font-family: 'Gilda Display', serif; }
    </style>
</head>
<body class="bg-slate-50">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-bold font-display text-gray-800">Hotel<span class="text-amber-500">Hebat</span></a>
            <div class="flex items-center space-x-2">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="px-4 py-2 text-sm font-medium bg-amber-600 text-white rounded-full hover:bg-amber-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-amber-600">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-amber-600 text-white rounded-full hover:bg-amber-700">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-12">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-4">
            <a href="{{ route('rooms.index') }}" class="hover:text-amber-600">Daftar Kamar</a>
            <span class="mx-2">/</span>
            <span>{{ $room->type }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Galeri & Deskripsi -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                    <img src="{{ $room->image_url ?? 'https://placehold.co/1200x800/e2e8f0/94a3b8?text=HotelHebat' }}" alt="{{ $room->type }}" class="w-full h-auto object-cover">
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h1 class="text-4xl font-bold font-display text-gray-800">{{ $room->type }}</h1>
                    <p class="text-lg text-gray-500 mt-2">Nomor Kamar: {{ $room->room_number }}</p>
                    <div class="border-t my-6"></div>
                    <h2 class="text-2xl font-bold text-gray-700 mb-4">Deskripsi Kamar</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $room->description }}</p>
                    <div class="border-t my-6"></div>
                    <h2 class="text-2xl font-bold text-gray-700 mb-4">Fasilitas</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-gray-600">
                        <div class="flex items-center"><i class="fa-solid fa-wifi text-amber-500 mr-3"></i> Wi-Fi Cepat</div>
                        <div class="flex items-center"><i class="fa-solid fa-tv text-amber-500 mr-3"></i> TV Layar Datar</div>
                        <div class="flex items-center"><i class="fa-solid fa-wind text-amber-500 mr-3"></i> AC</div>
                        <div class="flex items-center"><i class="fa-solid fa-bath text-amber-500 mr-3"></i> Shower Air Panas</div>
                        <div class="flex items-center"><i class="fa-solid fa-mug-saucer text-amber-500 mr-3"></i> Kopi & Teh</div>
                        <div class="flex items-center"><i class="fa-solid fa-lock text-amber-500 mr-3"></i> Brankas</div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Form Booking (INI PERUBAHANNYA) -->
            <aside class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-lg sticky top-24">
                    <p class="text-2xl font-bold text-gray-900">
                        Rp {{ number_format($room->price_per_night, 0, ',', '.') }}
                        <span class="font-normal text-base text-gray-500">/malam</span>
                    </p>
                    <div class="border-t my-4"></div>

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    
                    {{-- Tampilkan form booking HANYA JIKA user sudah login --}}
                    @auth
                        <form action="{{ route('bookings.store', $room->id) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="checkin" class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                                    <input type="date" id="checkin" name="checkin" value="{{ request('checkin') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" required>
                                </div>
                                <div>
                                    <label for="checkout" class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                                    <input type="date" id="checkout" name="checkout" value="{{ request('checkout') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" required>
                                </div>
                                <button type="submit" class="w-full bg-amber-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-amber-700 transition duration-300 shadow-md">
                                    Pesan Sekarang
                                </button>
                            </div>
                        </form>
                    @endauth

                    {{-- Tampilkan tombol login JIKA user BELUM login --}}
                    @guest
                        <div class="space-y-4 text-center">
                            <p class="text-gray-600">Anda harus login terlebih dahulu untuk dapat memesan kamar ini.</p>
                            <a href="{{ route('login') }}" class="w-full inline-block bg-amber-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-amber-700 transition duration-300 shadow-md">
                                Login untuk Memesan
                            </a>
                        </div>
                    @endguest
                </div>
            </aside>
        </div>
    </main>
</body>
</html>
