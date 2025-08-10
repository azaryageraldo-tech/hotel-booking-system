    @extends('layouts.admin')

    @section('title', 'Edit Kamar')

    @section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Formulir Edit Kamar: {{ $room->type }} - No. {{ $room->room_number }}</h2>

        <!-- Menampilkan Error Validasi -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
            @csrf <!-- Token Keamanan Laravel -->
            @method('PUT') <!-- Method Spoofing untuk request UPDATE -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div>
                    <!-- Nomor Kamar -->
                    <div class="mb-4">
                        <label for="room_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Kamar:</label>
                        <input type="text" name="room_number" id="room_number" value="{{ old('room_number', $room->room_number) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- Tipe Kamar -->
                    <div class="mb-4">
                        <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Kamar:</label>
                        <input type="text" name="type" id="type" value="{{ old('type', $room->type) }}" placeholder="Contoh: Deluxe, Superior" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- Harga per Malam -->
                    <div class="mb-4">
                        <label for="price_per_night" class="block text-gray-700 text-sm font-bold mb-2">Harga per Malam (Rp):</label>
                        <input type="number" name="price_per_night" id="price_per_night" value="{{ old('price_per_night', $room->price_per_night) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div>
                    <!-- Status Kamar -->
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                        <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="tersedia" {{ old('status', $room->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dipesan" {{ old('status', $room->status) == 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                            <option value="dibersihkan" {{ old('status', $room->status) == 'dibersihkan' ? 'selected' : '' }}>Sedang Dibersihkan</option>
                            <option value="perbaikan" {{ old('status', $room->status) == 'perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                        </select>
                    </div>

                    <!-- URL Gambar -->
                    <div class="mb-4">
                        <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">URL Gambar Utama:</label>
                        <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $room->image_url) }}" placeholder="https://example.com/image.jpg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <p class="text-xs text-gray-500 mt-1">Untuk saat ini, masukkan link gambar dari internet.</p>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $room->description) }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.rooms.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Kamar
                </button>
            </div>
        </form>
    </div>
    @endsection
    