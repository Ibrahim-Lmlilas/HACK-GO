<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'type_id');
    }
}
