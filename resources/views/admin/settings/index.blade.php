    @extends('layouts.admin')

    @section('title', 'Pengaturan Sistem')
    @section('subtitle', 'Kelola konfigurasi utama untuk sistem booking hotel Anda.')

    @section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="space-y-8">
            <!-- Metode Pembayaran -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold text-slate-700 mb-4">Metode Pembayaran</h3>
                <div class="space-y-3">
                    @php $paymentMethods = $settings['payment_methods'] ?? []; @endphp
                    <label class="flex items-center"><input type="checkbox" name="payment_methods[]" value="transfer_bank" class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500" {{ in_array('transfer_bank', $paymentMethods) ? 'checked' : '' }}> <span class="ml-2 text-slate-600">Transfer Bank</span></label>
                    <label class="flex items-center"><input type="checkbox" name="payment_methods[]" value="kartu_kredit" class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500" {{ in_array('kartu_kredit', $paymentMethods) ? 'checked' : '' }}> <span class="ml-2 text-slate-600">Kartu Kredit</span></label>
                    <label class="flex items-center"><input type="checkbox" name="payment_methods[]" value="e_wallet" class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500" {{ in_array('e_wallet', $paymentMethods) ? 'checked' : '' }}> <span class="ml-2 text-slate-600">E-Wallet (GoPay, OVO, dll)</span></label>
                </div>
            </div>

            <!-- Pajak & Biaya Layanan -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold text-slate-700 mb-4">Pajak & Biaya Layanan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tax_percentage" class="block text-sm font-medium text-slate-700 mb-1">Pajak (%)</label>
                        <input type="number" step="0.01" name="tax_percentage" id="tax_percentage" value="{{ $settings['tax_percentage'] ?? '10' }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                    <div>
                        <label for="service_fee_percentage" class="block text-sm font-medium text-slate-700 mb-1">Biaya Layanan (%)</label>
                        <input type="number" step="0.01" name="service_fee_percentage" id="service_fee_percentage" value="{{ $settings['service_fee_percentage'] ?? '5' }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                </div>
            </div>

            <!-- Promo & Diskon -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold text-slate-700 mb-4">Promo & Diskon</h3>
                <div>
                    <label for="promos" class="block text-sm font-medium text-slate-700 mb-1">Informasi Promo Aktif</label>
                    <textarea name="promos" id="promos" rows="4" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">{{ $settings['promos'] ?? '' }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">Tulis informasi promo yang akan ditampilkan ke tamu. Pisahkan dengan baris baru.</p>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end">
                <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-6 rounded-lg transition-colors">
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </form>
    @endsection
    