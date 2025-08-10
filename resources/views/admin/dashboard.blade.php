@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan aktivitas hotel Anda hari ini.')

@section('content')
    <!-- Kartu Ringkasan Data -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-sky-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm">Booking Bulan Ini</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">120</p>
                </div>
                <div class="bg-sky-100 p-3 rounded-full">
                    <i class="fa-solid fa-book-bookmark text-xl text-sky-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm">Okupansi Kamar</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">75%</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fa-solid fa-chart-pie text-xl text-green-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-amber-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm">Pendapatan Bulan Ini</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">Rp 95jt</p>
                </div>
                <div class="bg-amber-100 p-3 rounded-full">
                    <i class="fa-solid fa-wallet text-xl text-amber-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-indigo-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm">Check-in Hari Ini</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">8</p>
                </div>
                <div class="bg-indigo-100 p-3 rounded-full">
                    <i class="fa-solid fa-person-walking-arrow-right text-xl text-indigo-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Aktivitas Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4 text-slate-700">Grafik Tren Reservasi</h3>
            <div class="bg-slate-200 h-80 flex items-center justify-center rounded-md">
                <p class="text-slate-500">[Placeholder untuk Grafik Chart.js]</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4 text-slate-700">Aktivitas Terbaru</h3>
            <div class="space-y-5">
                <div class="flex items-start space-x-4">
                    <div class="bg-green-100 p-3 rounded-full"><i class="fa-solid fa-plus text-green-600"></i></div>
                    <div>
                        <p class="text-sm text-slate-700">Booking baru oleh <span class="font-bold">Maria S.</span> untuk Kamar 101.</p>
                        <p class="text-xs text-slate-400">10 menit yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="bg-sky-100 p-3 rounded-full"><i class="fa-solid fa-key text-sky-600"></i></div>
                     <div>
                        <p class="text-sm text-slate-700"><span class="font-bold">Budi P.</span> telah check-in di Kamar 205.</p>
                        <p class="text-xs text-slate-400">1 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="bg-red-100 p-3 rounded-full"><i class="fa-solid fa-xmark text-red-600"></i></div>
                    <div>
                        <p class="text-sm text-slate-700">Booking #345 dibatalkan.</p>
                        <p class="text-xs text-slate-400">3 jam yang lalu</p>
                    </div>
                </div>
                 <div class="flex items-start space-x-4">
                    <div class="bg-amber-100 p-3 rounded-full"><i class="fa-solid fa-star text-amber-600"></i></div>
                    <div>
                        <p class="text-sm text-slate-700">Ulasan baru diterima dari <span class="font-bold">Citra L.</span></p>
                        <p class="text-xs text-slate-400">Kemarin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
