<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'country',
        'city',
    ];

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
