<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model {
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'full_name',
        'email',
        'phone',
        'check_in',
        'check_out',
        // 'payment_method',
        'special_requests',
        'status'
    ];

    // public function package() {
    //     return $this->belongsTo(Package::class);
    // }

    // app/Models/PackageBooking.php

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package() {
        return $this->belongsTo(Package::class, 'package_id');
    }

}
