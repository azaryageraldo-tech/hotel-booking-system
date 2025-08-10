    @extends('layouts.receptionist')

    @section('title', 'Status Kamar')
    @section('subtitle', 'Lihat dan kelola status semua kamar secara real-time.')

    @section('content')
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach ($rooms as $room)
            <div class="rounded-xl shadow-lg p-4 flex flex-col justify-between
                @if($room->status == 'tersedia') bg-green-100 border-l-4 border-green-500
                @elseif($room->status == 'terisi') bg-sky-100 border-l-4 border-sky-500
                @elseif($room->status == 'dibersihkan') bg-yellow-100 border-l-4 border-yellow-500
                @elseif($room->status == 'perbaikan') bg-red-100 border-l-4 border-red-500
                @endif">
                <div>
                    <p class="font-bold text-lg text-slate-800">No. {{ $room->room_number }}</p>
                    <p class="text-xs text-slate-500">{{ $room->type }}</p>
                </div>
                <div class="mt-3">
                    <form action="{{ route('receptionist.rooms.status.update', $room->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="w-full text-xs rounded-md border-slate-300 shadow-sm focus:border-teal-500 focus:ring-teal-500
                            @if($room->status == 'tersedia') bg-green-200 text-green-800 @endif
                            @if($room->status == 'terisi') bg-sky-200 text-sky-800 @endif
                            @if($room->status == 'dibersihkan') bg-yellow-200 text-yellow-800 @endif
                            @if($room->status == 'perbaikan') bg-red-200 text-red-800 @endif">
                            <option value="tersedia" {{ $room->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="terisi" {{ $room->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                            <option value="dibersihkan" {{ $room->status == 'dibersihkan' ? 'selected' : '' }}>Dibersihkan</option>
                            <option value="perbaikan" {{ $room->status == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                        </select>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    @endsection
    