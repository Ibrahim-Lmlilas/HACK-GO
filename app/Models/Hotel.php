<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'rating',
        'price_mad',
        'image_url',
        'address',
        'description'
    ];

    protected $casts = [
        'rating' => 'float',
        'price_mad' => 'decimal:2'
    ];

    public function hotelImages(): HasMany
    {
        return $this->hasMany(HotelImage::class);
    }
}