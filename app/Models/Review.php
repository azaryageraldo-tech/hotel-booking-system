<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Review extends Model
    {
        use HasFactory;

        protected $fillable = [
            'user_id',
            'room_id',
            'booking_id',
            'rating',
            'comment',
        ];

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        public function room(): BelongsTo
        {
            return $this->belongsTo(Room::class);
        }

        public function booking(): BelongsTo
        {
            return $this->belongsTo(Booking::class);
        }
    }
    