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
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $monthlyBookingsCount }}</p>
                </div>
                <div class="bg-sky-100 p-3 rounded-full">
                    <i class="fa-solid fa-book-bookmark text-xl text-sky-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm">Okupansi Bulan Ini</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($occupancyRate, 1) }}%</p>
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
                    <p class="text-3xl font-bold text-slate-800 mt-1">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
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
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $checkInsTodayCount }}</p>
                </div>
                <div class="bg-indigo-100 p-3 rounded-full">
                    <i class="fa-solid fa-person-walking-arrow-right text-xl text-indigo-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Aktivitas Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
        <!-- Grafik Tren Reservasi -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4 text-slate-700">Grafik Tren Reservasi (6 Bulan Terakhir)</h3>
            <div>
                <canvas id="bookingChart"></canvas>
            </div>
        </div>
        
        <!-- Aktivitas Terbaru -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4 text-slate-700">Aktivitas Terbaru</h3>
            <div class="space-y-5">
                @forelse($recentActivities as $booking)
                    <div class="flex items-start space-x-4">
                        <div class="bg-slate-100 p-3 rounded-full"><i class="fa-solid fa-receipt text-slate-500"></i></div>
                        <div>
                            <p class="text-sm text-slate-700">Booking baru oleh <span class="font-bold">{{ $booking->user->name }}</span> untuk Kamar {{ $booking->room->room_number }}.</p>
                            <p class="text-xs text-slate-400">{{ $booking->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 text-center py-4">Tidak ada aktivitas terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('bookingChart').getContext('2d');
            const bookingChart = new Chart(ctx, {
                type: 'line', // Tipe grafik: garis
                data: {
                    labels: {!! $chartLabels !!}, // Ambil data label dari controller
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: {!! $chartData !!}, // Ambil data jumlah dari controller
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.4, // Membuat garis lebih melengkung
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                // Pastikan sumbu Y hanya menampilkan angka bulat
                                callback: function(value) {if (value % 1 === 0) {return value;}}
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legenda
                        }
                    }
                }
            });
        });
    </script>
@endsection
