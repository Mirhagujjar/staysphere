<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

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
        'reason',
        // 'service_id',
        'parent_id',
        'is_parent',
        
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
//     public function user()
// {
//     return $this->belongsTo(User::class);
// }


     public function parent()
    {
        return $this->belongsTo(Reservation::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Reservation::class, 'parent_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    

    public function scopeAvailableBetween($query, $roomId, $checkIn, $checkOut, $excludeId = null)
    {
        return $query->where('room_id', $roomId)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->where(function($q) use ($checkIn, $checkOut) {
                $q->where('check_in', '<', $checkOut)
                  ->where('check_out', '>', $checkIn);
            });
    }
    public function roomType()
    {
        return $this->belongsTo(\App\Models\FilterOption::class, 'room_type', 'id');
    }

   // Reservation.php model mein
    public function services()
    {
        return $this->belongsToMany(Service::class, 'reservation_service', 'reservation_id', 'service_id');
    }


    public function review()
    {
        return $this->hasOne(Review::class, 'reservation_id');
    }


    

}
