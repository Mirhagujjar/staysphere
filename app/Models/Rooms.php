<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    public $timestamps = false; // Disable timestamps

    protected $fillable = ['name', 'price', 'capacity', 'type', 'window_view', 'services', 'image'];

}
