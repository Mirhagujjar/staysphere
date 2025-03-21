<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageBooking;

class UserBookingPackageController extends Controller {
    public function index() {
        $bookings = PackageBooking::all();
        return view('user.bookings.index', compact('bookings'));
    }

    public function bookPackage(Request $request) {
        // Booking logic
    }
}

