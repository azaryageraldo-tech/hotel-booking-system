<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use Illuminate\Http\Request;

    class SettingController extends Controller
    {
        public function index()
        {
            // Ambil semua settings dan ubah menjadi array asosiatif (key => value)
            $settings = Setting::pluck('value', 'key')->all();
            
            // Decode value metode pembayaran yang tersimpan sebagai JSON
            if (isset($settings['payment_methods'])) {
                $settings['payment_methods'] = json_decode($settings['payment_methods'], true) ?? [];
            } else {
                $settings['payment_methods'] = [];
            }

            return view('admin.settings.index', compact('settings'));
        }

        public function update(Request $request)
        {
            $settings = $request->except('_token');

            foreach ($settings as $key => $value) {
                // Jika value adalah array (dari checkbox), encode menjadi JSON
                if (is_array($value)) {
                    $value = json_encode($value);
                }

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
        }
    }
    