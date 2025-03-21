<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageBooking;

class AdminBookingPackageController extends Controller {
    public function index() {
        $bookings = PackageBooking::all();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function update(Request $request, $id) {
        $booking = PackageBooking::findOrFail($id);
        $booking->update($request->all());
        return redirect()->back()->with('success', 'Booking updated successfully!');
    }

    public function destroy($id) {
        PackageBooking::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }
}

