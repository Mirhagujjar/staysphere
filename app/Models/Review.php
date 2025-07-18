<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'email', 'rating', 'comment' , 'is_approved','reservation_id',
        'user_id'];
public function booking()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

    public function reservations()
{
    return $this->hasMany(R\App\Models\Reservation::class);
}
}
