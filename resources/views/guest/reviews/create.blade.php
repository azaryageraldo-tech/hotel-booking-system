    <x-layouts.guest-layout>
        <div class="bg-slate-100">
            <!-- Header Halaman -->
            <div class="bg-white shadow-sm">
                <div class="container mx-auto px-6 py-8">
                    <h1 class="text-3xl font-bold font-display text-slate-800">Tulis Ulasan</h1>
                    <p class="text-slate-500 mt-1">Bagikan pengalaman menginap Anda di kamar {{ $booking->room->type }}.</p>
                </div>
            </div>

            <div class="container mx-auto px-6 py-8">
                <div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                    <form action="{{ route('reviews.store', $booking->id) }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <!-- Rating Bintang Interaktif -->
                            <div x-data="{ rating: 0, hoverRating: 0 }" class="text-center">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Rating Anda</label>
                                <div class="flex justify-center items-center space-x-1">
                                    <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                                        <button type="button" @click="rating = star" @mouseover="hoverRating = star" @mouseleave="hoverRating = 0"
                                                class="text-3xl text-gray-300 transition-colors"
                                                :class="{'!text-amber-400': hoverRating >= star || rating >= star}">
                                            <i class="fa-solid fa-star"></i>
                                        </button>
                                    </template>
                                </div>
                                <input type="hidden" name="rating" x-model="rating">
                                @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Komentar -->
                            <div>
                                <label for="comment" class="block text-sm font-medium text-slate-700 mb-1">Ulasan Anda (Opsional)</label>
                                <textarea name="comment" id="comment" rows="5" placeholder="Ceritakan pengalaman Anda..." class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"></textarea>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex justify-end pt-4 border-t">
                                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2.5 px-6 rounded-lg transition-colors">
                                    Kirim Ulasan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-layouts.guest-layout>
    