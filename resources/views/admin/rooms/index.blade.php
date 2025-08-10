@extends('layouts.admin')

@section('title', 'Kelola Kamar')
@section('subtitle', 'Atur semua kamar yang tersedia di hotel Anda.')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.rooms.create') }}" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-5 rounded-lg flex items-center transition-colors">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Kamar
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-slate-200">
        <table class="min-w-full bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">No. Kamar</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Tipe</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Harga/Malam</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Status</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-slate-700 divide-y divide-slate-200">
                @forelse ($rooms as $room)
                    <tr>
                        <td class="py-3 px-4 font-medium">{{ $room->room_number }}</td>
                        <td class="py-3 px-4">{{ $room->type }}</td>
                        <td class="py-3 px-4">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <span class="
                                @if($room->status == 'tersedia') bg-green-100 text-green-700
                                @elseif($room->status == 'dipesan') bg-amber-100 text-amber-700
                                @elseif($room->status == 'dibersihkan') bg-sky-100 text-sky-700
                                @else bg-red-100 text-red-700
                                @endif
                                py-1 px-3 rounded-full text-xs font-bold">
                                {{ ucfirst($room->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.rooms.edit', $room->id) }}" class="bg-slate-200 hover:bg-slate-300 text-slate-600 py-1.5 px-3 rounded-md text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus kamar ini? Tindakan ini tidak dapat dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 py-1.5 px-3 rounded-md text-sm font-medium transition-colors">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-16 text-slate-500">
                            <i class="fa-solid fa-box-open text-5xl mb-4"></i>
                            <p class="text-lg font-medium">Belum Ada Kamar</p>
                            <p class="text-sm">Silakan tambahkan data kamar baru untuk memulai.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $rooms->links() }}
    </div>
</div>
@endsection
