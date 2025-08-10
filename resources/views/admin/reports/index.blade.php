    @extends('layouts.admin')

    @section('title', 'Laporan Hotel')
    @section('subtitle', 'Analisis performa pendapatan dan okupansi hotel Anda.')

    @section('content')
    <!-- Form Filter Tanggal -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
        <form action="{{ route('admin.reports.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $startDate->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $endDate->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <button type="submit" class="w-full bg-sky-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-sky-700 transition duration-300">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Kartu Ringkasan Laporan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-amber-500">
            <p class="text-slate-500 text-sm">Total Pendapatan</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-sky-500">
            <p class="text-slate-500 text-sm">Total Booking</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalBookings }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-green-500">
            <p class="text-slate-500 text-sm">Tingkat Okupansi</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($occupancyRate, 2) }}%</p>
        </div>
    </div>

    
     <!-- Tombol Ekspor (Fungsional) -->
    <div class="mt-8 text-right">
        <a href="{{ route('admin.reports.exportExcel', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mr-2">
            <i class="fa-solid fa-file-excel mr-2"></i> Ekspor ke Excel
        </a>
        <a href="{{ route('admin.reports.exportPdf', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
            <i class="fa-solid fa-file-pdf mr-2"></i> Ekspor ke PDF
        </a>
    </div>
    @endsection
    