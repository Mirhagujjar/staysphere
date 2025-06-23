<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
   protected $fillable = [
    'title',
    'icon',
    'description',
    'image',
    'sort_order',
    'background_image',
    'is_active',
];
}
