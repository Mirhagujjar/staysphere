<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserEvent;

class AdminEventBookingController extends Controller
{



    public function index()
    {
        $bookings = UserEvent::orderBy('created_at', 'desc')->get();
        return view('admin.eventbooking.index', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = UserEvent::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        return redirect()->back()->with('success', 'Event Approved');
    }

    public function reject($id)
    {
        $booking = UserEvent::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return redirect()->back()->with('error', 'Event Rejected');
    }
}


