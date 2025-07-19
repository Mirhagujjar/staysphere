<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserEvent extends Model
{



    use HasFactory;

    // Table name agar model ka naam match nahi karta
    protected $table = 'user_event_bookings';

    // Mass assignable fields
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'guests',
        'event_date',
        'event_type',
        'title',
        'description',
        'status',
    ];
}


