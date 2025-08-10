<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
    {
        use HasFactory;

        protected $fillable = [
            'room_number', 'type', 'description', 'price_per_night', 'status', 'image_url',
        ];

        /**
         * Mendapatkan semua booking untuk kamar ini.
         */
        public function bookings(): HasMany
        {
            return $this->hasMany(Booking::class);
        }

        public function reviews() 
        { 
            return $this->hasMany(Review::class); 
        }
    }
