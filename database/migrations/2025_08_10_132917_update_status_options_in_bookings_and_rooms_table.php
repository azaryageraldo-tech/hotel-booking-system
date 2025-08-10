    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            // Mengubah kolom status di tabel bookings
            Schema::table('bookings', function (Blueprint $table) {
                // 'change()' digunakan untuk memodifikasi kolom yang sudah ada
                $table->string('status')->default('pending')->change();
            });

            // Mengubah kolom status di tabel rooms
            Schema::table('rooms', function (Blueprint $table) {
                $table->string('status')->default('tersedia')->change();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            // Logika untuk mengembalikan jika di-rollback
            Schema::table('bookings', function (Blueprint $table) {
                $table->string('status')->default('pending')->change();
            });
            Schema::table('rooms', function (Blueprint $table) {
                $table->string('status')->default('tersedia')->change();
            });
        }
    };
    