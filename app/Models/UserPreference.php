<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preferred_destinations',
        'budget_range',
        'travel_style',
        'interests',
    ];

    protected $casts = [
        'preferred_destinations' => 'array',
        'interests' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
