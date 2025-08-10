    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('settings', function (Blueprint $table) {
                $table->string('key')->primary(); // Nama pengaturan, e.g., 'tax_percentage'
                $table->text('value')->nullable(); // Nilai pengaturan
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('settings');
        }
    };
    