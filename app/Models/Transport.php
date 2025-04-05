<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'capacity',
        'price_per_day',
        'image',
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2',
        'capacity' => 'integer',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
