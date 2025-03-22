<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageBooking;
use App\Models\Package; // Ensure the Package model is imported

class UserBookingPackageController extends Controller
{
    public function bookPackage(Request $request)
    {
        // Validate the request
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:15',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'payment_method' => 'required|in:Pay at Arrival,Online Payment,Partial Payment',
            'special_requests' => 'nullable|string|max:500',
        ]);

        // Store the booking
        PackageBooking::create([
            'full_name' => $request->user_name,
            'email' => $request->user_email,
            'phone' => $request->user_phone,
            'package_id' => $request->package_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'payment_method' => $request->payment_method,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->back()->with('success', 'Package booked successfully!');
    }
}
