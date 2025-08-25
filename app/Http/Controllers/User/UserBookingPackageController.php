<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageBooking;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserBookingPackageController extends Controller
{
    public function bookPackage(Request $request)
    {
        // Debug the request
        Log::info('Booking request received:', $request->all());
        // Debug what's actually coming in the request
        logger('Request data:', $request->all());
        dd($request->all()); // This will stop execution and show all data
        
        // Validate the request
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:15',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'special_requests' => 'nullable|string|max:500',
        ]);

        try {
            // Store the booking
            PackageBooking::create([
                'user_id' => Auth::id(),
                'package_id' => $validated['package_id'],
                'full_name' => $validated['user_name'],
                'email' => $validated['user_email'],
                'phone' => $validated['user_phone'],
                'check_in' => $validated['check_in'],
                'check_out' => $validated['check_out'],
                'special_requests' => $validated['special_requests'] ?? null,
            ]);

            return redirect()->back()->with('success', 'Package booked successfully!');
            
        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while booking. Please try again.');
        }
    }
}