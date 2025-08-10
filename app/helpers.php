    <?php

    use App\Models\Setting;

    if (!function_exists('setting')) {
        /**
         * Mengambil nilai dari tabel settings.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed
         */
        function setting($key, $default = null)
        {
            $setting = Setting::find($key);
            return $setting ? $setting->value : $default;
        }
    }
    