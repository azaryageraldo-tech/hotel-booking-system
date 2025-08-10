<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HotelHebat Admin</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- TAMBAHKAN INI: Library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Alpine.js untuk Interaktivitas -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #a8a8a8;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #888;
        }
    </style>
</head>

<body class="bg-slate-100 antialiased">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="w-64 bg-slate-900 text-slate-300 flex flex-col fixed h-full transition-transform duration-300 ease-in-out z-30">

            <!-- Logo -->
            <div class="px-6 py-4 border-b border-slate-700/50">
                <h2 class="text-2xl font-bold text-white">Hotel<span class="text-sky-400">Hebat</span></h2>
            </div>

            <!-- Navigasi -->
            <nav class="flex-1 px-4 py-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-sky-600 text-white' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-home w-6 text-center"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.rooms.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.rooms.*') ? 'bg-sky-600 text-white' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-hotel w-6 text-center"></i>
                    <span class="ml-3">Kelola Kamar</span>
                </a>
                <a href="{{ route('admin.bookings.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.bookings.*') ? 'bg-sky-600 text-white' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-book-bookmark w-6 text-center"></i>
                    <span class="ml-3">Reservasi</span>
                </a>

                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-sky-600 text-white' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-users w-6 text-center"></i>
                    <span class="ml-3">Pengguna</span>
                </a>
                <a href="{{ route('admin.reports.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.reports.*') ? 'bg-sky-600 text-white' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-chart-line w-6 text-center"></i>
                    <span class="ml-3">Laporan</span>
                </a>
                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-sky-600 text-white' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-cog w-6 text-center"></i>
                    <span class="ml-3">Pengaturan</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div :class="sidebarOpen ? 'ml-64' : 'ml-0'"
            class="flex-1 flex flex-col transition-all duration-300 ease-in-out">
            <!-- Header -->
            <header
                class="bg-white/80 backdrop-blur-sm shadow-sm p-4 flex justify-between items-center sticky top-0 z-20">
                <!-- Tombol Toggle Sidebar -->
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-600 hover:text-sky-600">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>

                <!-- Menu Dropdown Pengguna -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-3">
                        <span class="font-semibold text-slate-600 hidden sm:block">{{ Auth::user()->name }}</span>
                        <img class="h-9 w-9 rounded-full object-cover"
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                            alt="User avatar">
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-20"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        style="display: none;">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"><i
                                class="fa-solid fa-user-edit w-6"></i>Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                <i class="fa-solid fa-right-from-bracket w-6"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Area Konten Utama -->
            <main class="flex-1 p-6 lg:p-8">
                <!-- Judul Halaman -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-slate-800">@yield('title')</h1>
                    <p class="text-slate-500">@yield('subtitle')</p>
                </div>

                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
