<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'year'];

        public function bookings()
        {
            return $this->hasMany(Booking::class);
        }

}
