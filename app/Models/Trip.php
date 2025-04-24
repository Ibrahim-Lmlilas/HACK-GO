<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'destination_id',
        'start_date',
        'end_date',
        'capacity',
        'hotel_id' // Added hotel_id to fillable attributes
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'decimal:2'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Add relationship to Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }
}
