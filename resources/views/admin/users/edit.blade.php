@extends('layouts.admin')

@section('title', 'Edit Pengguna')
@section('subtitle', 'Perbarui detail untuk akun ' . $user->name)

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg max-w-2xl mx-auto">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-slate-700">Peran (Role)</label>
                <select name="role" id="role" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="resepsionis" {{ old('role', $user->role) == 'resepsionis' ? 'selected' : '' }}>Resepsionis</option>
                    <option value="tamu" {{ old('role', $user->role) == 'tamu' ? 'selected' : '' }}>Tamu</option>
                </select>
            </div>
            <div class="border-t pt-6">
                <p class="text-sm text-slate-500 mb-2">Kosongkan password jika Anda tidak ingin mengubahnya.</p>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                 <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.users.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-2.5 px-5 rounded-lg">Batal</a>
            <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-5 rounded-lg">Update Pengguna</button>
        </div>
    </form>
</div>
@endsection
