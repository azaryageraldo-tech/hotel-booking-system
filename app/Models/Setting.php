<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Setting extends Model
    {
        use HasFactory;

        protected $primaryKey = 'key'; // Gunakan 'key' sebagai primary key
        public $incrementing = false; // Karena primary key bukan integer
        protected $keyType = 'string'; // Tipe data primary key adalah string
        public $timestamps = false; // Kita tidak butuh created_at/updated_at

        protected $fillable = ['key', 'value'];
    }
    