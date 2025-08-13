<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'room_number',
        'service_id',
        'notes',
        'user_id',
        'status',
    ];

    // Agar tumhein related Service chahiye:
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}


}
