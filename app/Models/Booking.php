<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_name',
        'booked_at',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
