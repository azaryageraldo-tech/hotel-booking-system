<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HotelHebat' }}</title>
    
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
<body class="bg-slate-50">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
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
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-6 py-16">
            <div class="border-t border-gray-700 pt-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} HotelHebat. Semua Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
