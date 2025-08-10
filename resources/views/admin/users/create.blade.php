    @extends('layouts.admin')

    @section('title', 'Tambah Pengguna Baru')
    @section('subtitle', 'Buat akun baru untuk Admin atau Resepsionis.')

    @section('content')
    <div class="bg-white p-6 rounded-xl shadow-lg max-w-2xl mx-auto">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700">Peran (Role)</label>
                    <select name="role" id="role" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                        <option value="admin">Admin</option>
                        <option value="resepsionis">Resepsionis</option>
                    </select>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-2.5 px-5 rounded-lg">Batal</a>
                <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-5 rounded-lg">Simpan Pengguna</button>
            </div>
        </form>
    </div>
    @endsection
    