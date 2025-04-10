<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageBooking;

class AdminBookingPackageController extends Controller {
    public function index() {
        $bookings = PackageBooking::all(); 
        return view('admin.bookingspackages.index', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = PackageBooking::findOrFail($id);
        return view('admin.bookingspackages.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = PackageBooking::findOrFail($id);
        $booking->package_name = $request->package_name;
        $booking->price = $request->price;
        $booking->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/packages'), $imageName);

            // Save the image path relative to the public folder
            $booking->image = 'assets/images/packages/' . $imageName;
        }

        $booking->save();

        return redirect()->route('admin.bookingspackages.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy($id) {
        PackageBooking::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }
}
