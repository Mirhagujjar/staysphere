<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    // use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_description',
        'hero_image',
    ];

}
