<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Kamar - HotelHebat</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Gilda+Display&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-display {
            font-family: 'Gilda Display', serif;
        }

        .text-shadow {
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Header yang Konsisten dengan Landing Page (SUDAH DIPERBAIKI) -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-bold font-display text-gray-800">Hotel<span
                    class="text-amber-500">Hebat</span></a>
            <div class="flex items-center space-x-2">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                        class="px-4 py-2 text-sm font-medium bg-amber-600 text-white rounded-full hover:bg-amber-700 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-amber-600">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-sm font-medium bg-amber-600 text-white rounded-full hover:bg-amber-700 transition-colors">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Latar Belakang Gradien di Atas -->
    <div class="h-64 bg-gradient-to-b from-gray-800 to-gray-600"></div>

    <main class="container mx-auto px-6 pb-12 -mt-48">

        <!-- Area Filter dan Konten -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Kolom Filter -->
            <aside class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-2xl sticky top-24">
                    <h3 class="text-xl font-bold font-display text-gray-800 mb-4">Cari Kamar</h3>
                    <form action="{{ route('rooms.index') }}" method="GET">
                        <div class="space-y-4">
                            <div>
                                <label for="checkin"
                                    class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                                <input type="date" id="checkin" name="checkin"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            </div>
                            <div>
                                <label for="checkout"
                                    class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                                <input type="date" id="checkout" name="checkout"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe
                                    Kamar</label>
                                <select id="type" name="type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                    <option value="">Semua Tipe</option>
                                    <option value="Deluxe Suite">Deluxe Suite</option>
                                    <option value="Premier Room">Premier Room</option>
                                    <option value="Standard Room">Standard Room</option>
                                </select>
                            </div>
                            <button type="submit"
                                class="w-full bg-amber-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-amber-700 transition duration-300 shadow-md">
                                <i class="fa-solid fa-magnifying-glass mr-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Daftar Kamar -->
            <div class="lg:col-span-3">
                <div class="bg-white p-6 rounded-xl shadow-2xl">
                    <h1 class="text-3xl font-bold font-display text-gray-800">Pilihan Kamar</h1>
                    <p class="text-gray-500 mt-1">Menampilkan {{ $rooms->count() }} dari {{ $rooms->total() }} kamar
                        yang tersedia.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mt-6">
                        @forelse ($rooms as $room)
                            <div
                                class="bg-white rounded-lg border border-gray-200 overflow-hidden group flex flex-col transition-shadow hover:shadow-xl">
                                <div class="overflow-hidden">
                                    <img src="{{ $room->image_url ?? 'https://placehold.co/600x400/e2e8f0/94a3b8?text=HotelHebat' }}"
                                        alt="{{ $room->type }}"
                                        class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="p-5 flex flex-col flex-grow">
                                    <h3 class="text-2xl font-bold font-display text-gray-800">{{ $room->type }}</h3>
                                    <p class="text-sm text-gray-400">No. Kamar: {{ $room->room_number }}</p>
                                    <p class="mt-4 text-xl font-bold text-gray-900">
                                        Rp {{ number_format($room->price_per_night, 0, ',', '.') }}
                                        <span class="font-normal text-sm text-gray-500">/malam</span>
                                    </p>
                                    <div class="mt-6 flex-grow flex items-end">
                                        <!-- INI PERUBAHANNYA -->
                                        <a href="{{ route('rooms.show', $room->id) }}"
                                            class="w-full text-center inline-block bg-gray-800 text-white font-bold py-2.5 px-4 rounded-md hover:bg-amber-600 transition duration-300">
                                            Lihat Detail & Pesan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="md:col-span-2 xl:col-span-3 text-center py-16 text-gray-500">
                                <i class="fa-solid fa-bed-pulse text-6xl mb-4 text-gray-400"></i>
                                <p class="text-xl font-medium">Kamar Tidak Ditemukan</p>
                                <p class="text-sm mt-1">Maaf, tidak ada kamar yang tersedia dengan kriteria Anda.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer yang Konsisten dengan Landing Page -->
    <footer id="contact" class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-display mb-4">HotelHebat</h3>
                    <p class="text-gray-400 max-w-md">Sebuah ikon kemewahan dan keramahan, didedikasikan untuk
                        menciptakan kenangan tak terlupakan bagi Anda.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i
                                class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i
                                class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} HotelHebat. Semua Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Set tanggal minimal untuk check-in dan check-out
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            const checkinInput = document.getElementById('checkin');
            const checkoutInput = document.getElementById('checkout');

            if (checkinInput) {
                checkinInput.setAttribute('min', today);
                checkinInput.addEventListener('change', function() {
                    if (!this.value) {
                        checkoutInput.value = '';
                        checkoutInput.setAttribute('min', today);
                        return;
                    }
                    let checkinDate = new Date(this.value);
                    checkinDate.setDate(checkinDate.getDate() + 1);
                    const nextDay = checkinDate.toISOString().split('T')[0];
                    checkoutInput.setAttribute('min', nextDay);
                    if (checkoutInput.value < this.value) {
                        checkoutInput.value = nextDay;
                    }
                });
            }
        });
    </script>
</body>

</html>
