<?php

namespace App\Http\Controllers\User;
use App\Models\UserEventBooking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserEvent;

class UserEventBookingController extends Controller
{

     public function create()
        {
            return view('user.eventbooking.create');
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'full_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'guests' => 'required|integer|min:1',
                'event_date' => 'required|date',
                'title' => 'required',
                'event_type'   => 'required',

                'description' => 'required',
            ]);

            UserEvent::create($validated);

            return redirect()->route('user.dashboard')->with('success', 'Event Booking Request Submitted!');
        }
        public function index()
{
    $bookings = UserEvent::where('email', auth()->user()->email)->orderBy('created_at', 'desc')->get();

    return view('user.eventbooking.index', compact('bookings'));
}

    }



