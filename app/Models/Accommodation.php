<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'destination_id',
        'name',
        'description',
        'price_per_night',
        'address',
        'images',
        'amenities',
    ];

    protected $casts = [
        'images' => 'array',
        'amenities' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(AccommodationType::class, 'type_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(AccommodationReview::class);
    }
}
