<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model {
    use HasFactory;

    protected $fillable = [
        'full_name', 'email', 'phone', 'package_id', 
        'check_in', 'check_out', 'payment_method', 'special_requests'
    ];

    public function package() {
        return $this->belongsTo(Package::class);
    }
}
