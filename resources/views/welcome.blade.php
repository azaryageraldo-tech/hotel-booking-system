<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelHebat | Pesan Kamar Impian Anda Sekarang</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Gilda+Display&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .font-display {
            font-family: 'Gilda Display', serif;
        }
        .hero-gradient {
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 70%, rgba(0,0,0,0) 100%);
        }
        .text-shadow {
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- 1. Header / Navigasi Utama (SUDAH DIPERBAIKI) -->
    <header x-data="{ scrolled: false }" @scroll.window="scrolled = (window.scrollY > 50)" 
            :class="{ 'bg-white shadow-lg': scrolled, 'bg-black/20 backdrop-blur-sm': !scrolled }"
            class="fixed w-full top-0 z-50 transition-all duration-300">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-bold font-display" :class="{'text-gray-800': scrolled, 'text-white text-shadow': !scrolled}">HotelHebat</a>
            <div class="hidden lg:flex items-center space-x-8">
                <a href="#hero" class="tracking-wider transition-colors" :class="{'text-gray-600 hover:text-amber-600': scrolled, 'text-white text-shadow hover:text-amber-300': !scrolled}">Beranda</a>
                <a href="{{ route('rooms.index') }}" class="tracking-wider transition-colors" :class="{'text-gray-600 hover:text-amber-600': scrolled, 'text-white text-shadow hover:text-amber-300': !scrolled}">Kamar</a>
                <a href="#facilities" class="tracking-wider transition-colors" :class="{'text-gray-600 hover:text-amber-600': scrolled, 'text-white text-shadow hover:text-amber-300': !scrolled}">Fasilitas</a>
                <a href="#promo" class="tracking-wider transition-colors" :class="{'text-gray-600 hover:text-amber-600': scrolled, 'text-white text-shadow hover:text-amber-300': !scrolled}">Promo</a>
                <a href="#contact" class="tracking-wider transition-colors" :class="{'text-gray-600 hover:text-amber-600': scrolled, 'text-white text-shadow hover:text-amber-300': !scrolled}">Kontak</a>
            </div>
            <div class="flex items-center space-x-2">
                <!-- Tombol hanya untuk pengunjung (guest) -->
                <a href="{{ route('login') }}" class="hidden sm:block px-4 py-2 text-sm font-medium border rounded-full transition-all duration-300" :class="{'text-amber-700 border-amber-700 hover:bg-amber-50': scrolled, 'text-white border-white hover:bg-white hover:text-gray-800': !scrolled}">Login</a>
                <a href="{{ route('register') }}" class="hidden sm:block px-4 py-2 text-sm font-medium border rounded-full transition-all duration-300" :class="{'text-amber-700 border-amber-700 hover:bg-amber-50': scrolled, 'text-white border-white hover:bg-white hover:text-gray-800': !scrolled}">Daftar</a>
                <a href="{{ route('rooms.index') }}" class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-full hover:bg-amber-700 transition-colors duration-300 shadow-md">Cari Kamar</a>
            </div>
        </nav>
    </header>

    <!-- 2. Banner / Hero Section -->
    @php
        $hero_image_url = 'https://qubikahotel.com/wp-content/uploads/2025/07/Slider-2.jpg';
    @endphp
    <section id="hero" class="relative h-screen flex flex-col items-center justify-center">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $hero_image_url }}');"></div>
        <div class="absolute inset-0 hero-gradient"></div>
        <div class="relative z-10 text-center text-white px-4 pt-20">
            <h1 class="text-5xl md:text-7xl font-display leading-tight mb-4 text-shadow">Pesan Kamar Impian Anda Sekarang</h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-12 font-light text-shadow">Nikmati kemewahan, kenyamanan, dan pelayanan tak tertandingi di destinasi terbaik.</p>
        </div>
        <!-- Form Pencarian Cepat -->
        <div id="search-form" class="relative z-20 w-full max-w-5xl mx-auto px-4">
            <div class="bg-white p-6 rounded-xl shadow-2xl">
                <form action="{{ route('rooms.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="checkin" class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                        <input type="date" id="checkin" name="checkin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" required>
                    </div>
                    <div>
                        <label for="checkout" class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                        <input type="date" id="checkout" name="checkout" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" required>
                    </div>
                    <div>
                        <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tamu</label>
                        <select id="guests" name="guests" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option>1 Tamu</option>
                            <option selected>2 Tamu</option>
                            <option>3 Tamu</option>
                            <option>4 Tamu</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-amber-600 text-white font-bold py-3 px-4 rounded-md hover:bg-amber-700 transition duration-300 h-11">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i>Cari
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- 3. Highlight Fasilitas Utama -->
    <section id="facilities" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="flex flex-col items-center">
                    <div class="bg-amber-100 text-amber-600 rounded-full p-4 mb-3 text-3xl"><i class="fa-solid fa-wifi"></i></div>
                    <h3 class="font-semibold">Wi-Fi Gratis</h3>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-amber-100 text-amber-600 rounded-full p-4 mb-3 text-3xl"><i class="fa-solid fa-utensils"></i></div>
                    <h3 class="font-semibold">Sarapan Gratis</h3>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-amber-100 text-amber-600 rounded-full p-4 mb-3 text-3xl"><i class="fa-solid fa-person-swimming"></i></div>
                    <h3 class="font-semibold">Kolam Renang</h3>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-amber-100 text-amber-600 rounded-full p-4 mb-3 text-3xl"><i class="fa-solid fa-square-parking"></i></div>
                    <h3 class="font-semibold">Parkir Aman</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Daftar Tipe Kamar Populer -->
    <section id="rooms" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-display text-gray-800">Tipe Kamar Populer</h2>
                <p class="text-gray-600 mt-2">Temukan ruang sempurna yang sesuai dengan gaya Anda.</p>
            </div>
            @php
                $popular_rooms = [
                    (object)['type' => 'Deluxe Suite', 'price' => 1500000, 'image_url' =>'https://www.sudamalaresorts.com/app/uploads/2023/12/deluxe-suite-1280x600-c-center.jpg'],
                    (object)['type' => 'Premier Room', 'price' => 950000, 'image_url' => 'https://www.padmahotelbandung.com/images/content/premier-room.jpg'],
                    (object)['type' => 'Standard Room', 'price' => 600000, 'image_url' =>'https://amorgoshotel.com/wp-content/uploads/2014/12/Amorgos-Standard-Room1-e1464286427430.jpg'],
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($popular_rooms as $room)
                <div class="bg-white rounded-lg shadow-xl overflow-hidden group">
                    <div class="overflow-hidden"><img src="{{ $room->image_url }}" alt="{{ $room->type }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"></div>
                    <div class="p-6">
                        <h3 class="text-2xl font-display">{{ $room->type }}</h3>
                        <p class="mt-4 text-xl font-bold text-gray-800">Rp {{ number_format($room->price, 0, ',', '.') }}<span class="font-normal text-sm text-gray-500">/malam</span></p>
                        <a href="{{ route('rooms.index') }}" class="mt-4 w-full text-center inline-block bg-gray-800 text-white font-bold py-2 px-4 rounded-md hover:bg-amber-600 transition duration-300">Lihat Semua Kamar</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. Promo & Diskon -->
    <section id="promo" class="py-20 bg-amber-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-display text-gray-800">Promo & Penawaran Spesial</h2>
                <p class="text-gray-600 mt-2">Nikmati lebih banyak keuntungan dengan penawaran eksklusif kami.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <i class="fa-solid fa-tags text-amber-500 text-4xl mb-4"></i>
                    <h3 class="text-2xl font-bold">Diskon Akhir Pekan</h3>
                    <p class="text-gray-600 my-2">Menginap minimal 2 malam di akhir pekan dan dapatkan diskon 20% untuk kamar Anda.</p>
                    <a href="{{ route('rooms.index') }}" class="font-bold text-amber-600 hover:underline">Klaim Promo</a>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <i class="fa-solid fa-calendar-days text-amber-500 text-4xl mb-4"></i>
                    <h3 class="text-2xl font-bold">Pesan Lebih Awal</h3>
                    <p class="text-gray-600 my-2">Pesan 30 hari sebelum kedatangan dan nikmati harga spesial serta sarapan gratis untuk 2 orang.</p>
                     <a href="{{ route('rooms.index') }}" class="font-bold text-amber-600 hover:underline">Lihat Detail</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Testimoni Tamu -->
    <section id="testimonials" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-display text-gray-800">Apa Kata Tamu Kami</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div>
                    <img src="https://randomuser.me/api/portraits/women/17.jpg" class="w-24 h-24 mx-auto rounded-full shadow-lg mb-4" alt="Tamu 1">
                    <div class="text-amber-500 mb-2"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-600 italic">"Pelayanan terbaik yang pernah saya rasakan. Kamarnya bersih, mewah, dan sangat nyaman."</p>
                    <h4 class="font-bold mt-4">Maria S.</h4>
                </div>
                <div>
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-24 h-24 mx-auto rounded-full shadow-lg mb-4" alt="Tamu 2">
                    <div class="text-amber-500 mb-2"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></div>
                    <p class="text-gray-600 italic">"Lokasi yang sempurna untuk liburan keluarga. Anak-anak sangat suka kolam renangnya."</p>
                    <h4 class="font-bold mt-4">Budi P.</h4>
                </div>
                <div>
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-24 h-24 mx-auto rounded-full shadow-lg mb-4" alt="Tamu 3">
                    <div class="text-amber-500 mb-2"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-600 italic">"Pengalaman check-in yang mulus dan staff yang sangat ramah. Makanan di restorannya juga luar biasa."</p>
                    <h4 class="font-bold mt-4">Citra L.</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Lokasi & Peta -->
    <section id="location" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-display text-gray-800 mb-6">Temukan Kami</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">Kami berada di lokasi strategis yang mudah dijangkau dari berbagai penjuru kota, dekat dengan pusat bisnis dan atraksi wisata populer.</p>
                <div class="space-y-3">
                    <p class="flex items-start"><i class="fa-solid fa-map-marker-alt text-amber-600 mt-1 mr-3"></i><span>Jl. Pahlawan No. 123, Jakarta Pusat,<br>DKI Jakarta, 10110, Indonesia</span></p>
                    <p class="flex items-center"><i class="fa-solid fa-phone text-amber-600 mr-3"></i><span>(021) 123-4567</span></p>
                    <p class="flex items-center"><i class="fa-solid fa-envelope text-amber-600 mr-3"></i><span>info@hotelhebat.com</span></p>
                </div>
            </div>
            <div class="h-96 rounded-lg overflow-hidden shadow-xl">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.66646698221!2d106.82496417500201!3d-6.175392393809341!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1723250000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- 8. Galeri Foto -->
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-display text-gray-800">Galeri HotelHebat</h2>
                <p class="text-gray-600 mt-2">Lihat lebih dekat keindahan dan kenyamanan yang kami tawarkan.</p>
            </div>
            @php
                $gallery_images = [
                    'https://images.unsplash.com/photo-1564501049412-61c2a3083791?q=80&w=1932&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?q=80&w=2070&auto=format&fit=crop',
                    'https://sp-ao.shortpixel.ai/client/to_auto,q_lossy,ret_img,w_890,h_444/https://www.flokq.com/blog/wp-content/uploads/2020/10/LINE_P20201015_234532294.png',
                    'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?q=80&w=2070&auto=format&fit=crop',
                ];
                $gallery_chunks = array_chunk($gallery_images, 2);
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($gallery_chunks as $chunk)
                <div class="grid gap-4">
                    @foreach ($chunk as $image_url)
                    <div><img class="h-auto max-w-full rounded-lg shadow-md" src="{{ $image_url }}" alt="Galeri HotelHebat"></div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 9. Ajakan Bertindak (CTA) -->
    <section class="bg-amber-600">
        <div class="container mx-auto px-6 py-16 text-center">
            <h2 class="text-3xl md:text-4xl font-display text-white">Siap untuk Pengalaman Tak Terlupakan?</h2>
            <p class="text-amber-100 mt-2 mb-6 max-w-2xl mx-auto">Jangan tunda lagi liburan impian Anda. Kamar terbaik kami menanti.</p>
            <a href="{{ route('rooms.index') }}" class="px-8 py-3 bg-white text-amber-700 font-bold rounded-full hover:bg-amber-50 transition duration-300 text-lg shadow-lg">Booking Sekarang & Nikmati Liburan Anda</a>
        </div>
    </section>

    <!-- 10. Footer -->
    <footer id="contact" class="bg-gray-800 text-white">
        <div class="container mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-display mb-4">HotelHebat</h3>
                    <p class="text-gray-400 max-w-md">Sebuah ikon kemewahan dan keramahan, didedikasikan untuk menciptakan kenangan tak terlupakan bagi Anda.</p>
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
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-twitter"></i></a>
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
