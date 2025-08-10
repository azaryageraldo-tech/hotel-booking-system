<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Gilda+Display&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Poppins', sans-serif; }
            .font-display { font-family: 'Gilda Display', serif; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            <!-- Kolom Kiri (Form) -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8">
                <div class="w-full max-w-md">
                    <a href="/" class="text-3xl font-bold font-display text-gray-800 mb-8 block text-center">
                        Hotel<span class="text-amber-500">Hebat</span>
                    </a>
                    {{ $slot }}
                </div>
            </div>

            <!-- Kolom Kanan (Gambar) -->
            <div class="hidden lg:block lg:w-1/2 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=1780&auto=format&fit=crop');">
                <div class="w-full h-full bg-black/30"></div>
            </div>
        </div>
    </body>
</html>
