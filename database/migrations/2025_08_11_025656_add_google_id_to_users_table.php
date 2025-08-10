    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::table('users', function (Blueprint $table) {
                // Tambahkan kolom untuk menyimpan ID dari Google
                $table->string('google_id')->nullable()->after('id');
                // Buat kolom password menjadi tidak wajib (nullable)
                $table->string('password')->nullable()->change();
            });
        }

        public function down(): void
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('google_id');
                $table->string('password')->nullable(false)->change();
            });
        }
    };
    