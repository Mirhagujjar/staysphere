<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'room_type',
        'price',
        'room_capacity',
        'facilities',
        'has_view',
        'image',
    ];

    protected $casts = [
        'has_view' => 'boolean',
        'facilities' => 'array', // Facilities stored as JSON
    ];

    /**
     * Relationship: A room has many reservations.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Check if the room is booked for a given date range.
     */
    public function isBooked($checkIn = null, $checkOut = null)
    {
        if (!$checkIn || !$checkOut) {
            return false; // Assume room is available if no dates are provided
        }
    
        return $this->reservations()
            ->where('status', 'confirmed')
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })
            ->exists();
    }
    
}
