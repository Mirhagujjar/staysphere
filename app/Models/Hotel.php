<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public $timestamps = false; // Disable timestamps

    protected $fillable = ['name', 'email', 'phone', 'check_in', 'check_out', 'room_type', 'guests'];
}
