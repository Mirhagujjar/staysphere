<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageBooking;

class AdminBookingPackageController extends Controller {
    public function index() {
        $bookings = PackageBooking::all(); 
        // dd($bookings); 
        return view('admin.bookingspackages.index', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = PackageBooking::findOrFail($id);
        return view('admin.bookingspackages.edit', compact('booking'));
    }

    // 🟢 Update Booking
    public function update(Request $request, $id)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $booking = PackageBooking::findOrFail($id);
        $booking->package_name = $request->package_name;
        $booking->price = $request->price;
        $booking->status = $request->status;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('package_images', 'public');
            $booking->image = $imagePath;
        }

        $booking->save();

        return redirect()->route('admin.bookingspackages.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy($id) {
        PackageBooking::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }
}
