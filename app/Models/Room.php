<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_name',
        'room_type',
        'price',
        'room_capacity',
        'facilities',
        'has_view',
        'image',
    ];

    // Facilities ko array ke form me store/read karne ke liye
    protected $casts = [
        'has_view' => 'boolean',
    ];
}
