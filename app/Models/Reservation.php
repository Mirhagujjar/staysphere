<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $dates = ['deleted_at'];


    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'check_in',
        'check_out',
        'room_type',
        'guests',
        'room_id',
        'status',
    ];

    /**
     * Relationship: A reservation belongs to a user.
     */
    
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }

    /**
     * Relationship: A reservation belongs to a room.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Check if the room is booked during a specific date range.
     */
    // public function isBooked()
    // {
    //     return Reservation::where('room_id', $this->room_id)
    //         ->where('status', 'confirmed')
    //         ->where(function ($query) {
    //             $query->whereBetween('check_in', [now(), now()])
    //                   ->orWhereBetween('check_out', [now(), now()]);
    //         })
    //         ->exists();
    // }

    public function scopeAvailableBetween($query, $roomId, $checkIn, $checkOut, $excludeId = null)
{
    return $query->where('room_id', $roomId)
        ->when($excludeId, function($q) use ($excludeId) {
            $q->where('id', '!=', $excludeId);
        })
        ->where(function($q) use ($checkIn, $checkOut) {
            $q->where('check_in', '<', $checkOut)
              ->where('check_out', '>', $checkIn);
        });
}

}
