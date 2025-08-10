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
            Schema::table('rooms', function (Blueprint $table) {
                // Menambahkan kolom status setelah 'price_per_night'
                $table->string('status')->default('tersedia')->after('price_per_night');
                
                // Menambahkan kolom untuk URL gambar utama setelah 'status'
                // Dibuat nullable artinya boleh kosong.
                $table->string('image_url')->nullable()->after('status');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('rooms', function (Blueprint $table) {
                // Logika untuk menghapus kolom jika migrasi di-rollback
                $table->dropColumn('status');
                $table->dropColumn('image_url');
            });
        }
    };
    