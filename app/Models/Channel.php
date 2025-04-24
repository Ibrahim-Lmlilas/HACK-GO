<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'name',
        'description'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
