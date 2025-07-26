<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageBooking;
use Illuminate\Support\Facades\Auth;

class UserFormPackageController extends Controller
{
    // Show form view
    public function create()
    {
        $packages = Package::all();
        return view('user.packagebooking.create', compact('packages'));
    }

    // Store booking data
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email',
            'user_phone' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'payment_method' => 'required',
            'special_requests' => 'nullable|string',
        ]);

        PackageBooking::create([
            'package_id' => $request->package_id,
            'user_id' => Auth::id(), // user_id column ka use
            'full_name' => $request->user_name,
            'email' => $request->user_email,
            'phone' => $request->user_phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'payment_method' => $request->payment_method,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->back()->with('success', 'Package booked successfully!');
    }

    // Show user's bookings
    public function index()
    {
        // Bookings related to the logged-in user
        $bookings = PackageBooking::with('package')
            ->where('user_id', Auth::id())
            ->get();

        return view('user.packagebooking.index', compact('bookings'));
    }
}
