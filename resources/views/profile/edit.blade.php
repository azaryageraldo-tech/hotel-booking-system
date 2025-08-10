<x-layouts.guest-layout>
    <div class="bg-slate-100">
        <!-- Header Halaman -->
        <div class="bg-white shadow-sm">
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-3xl font-bold font-display text-slate-800">Profil Saya</h1>
                <p class="text-slate-500 mt-1">Kelola informasi akun dan preferensi Anda.</p>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <div class="max-w-3xl mx-auto space-y-8">
                
                <!-- Form Update Informasi Profil -->
                <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                    <section>
                        <header>
                            <h2 class="text-2xl font-bold font-display text-slate-800">
                                Informasi Profil
                            </h2>
                            <p class="mt-1 text-sm text-slate-600">
                                Perbarui informasi profil dan alamat email akun Anda.
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700">Nama</label>
                                <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                                <input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800">
                                            Alamat email Anda belum terverifikasi.
                                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Klik di sini untuk mengirim ulang email verifikasi.
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                Link verifikasi baru telah dikirim ke alamat email Anda.
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">Simpan</button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >Tersimpan.</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Form Update Password -->
                <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                    <section>
                        <header>
                            <h2 class="text-2xl font-bold font-display text-slate-800">
                                Perbarui Password
                            </h2>
                            <p class="mt-1 text-sm text-slate-600">
                                Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <label for="update_password_current_password" class="block text-sm font-medium text-slate-700">Password Saat Ini</label>
                                <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <label for="update_password_password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                                <input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <label for="update_password_password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">Simpan</button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >Tersimpan.</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Form Hapus Akun -->
                <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-2xl font-bold font-display text-red-700">
                                Hapus Akun
                            </h2>
                            <p class="mt-1 text-sm text-slate-600">
                                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
                            </p>
                        </header>

                        <button 
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors"
                        >Hapus Akun</button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    Apakah Anda yakin ingin menghapus akun Anda?
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                                </p>

                                <div class="mt-6">
                                    <label for="password" class="sr-only">Password</label>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="mt-1 block w-3/4 rounded-md border-slate-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                        placeholder="Password"
                                    />
                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <button type="button" x-on:click="$dispatch('close')" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-2 px-4 rounded-lg transition-colors">
                                        Batal
                                    </button>

                                    <button type="submit" class="ml-3 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                        Hapus Akun
                                    </button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest-layout>
