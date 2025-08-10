@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('subtitle', 'Kelola semua akun pengguna di sistem Anda.')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.users.create') }}" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-5 rounded-lg flex items-center transition-colors">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Pengguna
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold">Gagal!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-slate-200">
        <table class="min-w-full bg-white">
            <thead class="bg-slate-50">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Nama</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Email</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-slate-600">Peran (Role)</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-slate-700 divide-y divide-slate-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="py-3 px-4 font-medium">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <span class="py-1 px-3 rounded-full text-xs font-bold
                                @if($user->role == 'admin') bg-red-100 text-red-700
                                @elseif($user->role == 'resepsionis') bg-sky-100 text-sky-700
                                @else bg-slate-100 text-slate-700 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-slate-200 hover:bg-slate-300 text-slate-600 py-1.5 px-3 rounded-md text-sm font-medium">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </a>
                                @if(Auth::id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 py-1.5 px-3 rounded-md text-sm font-medium">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $users->links() }}</div>
</div>
@endsection
