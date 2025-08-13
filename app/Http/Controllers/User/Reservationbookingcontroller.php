<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\Room;


class Reservationbookingcontroller extends Controller
{




    // Show form
    public function create()
    {
        $rooms = Room::all(); // show all rooms in dropdown
        return view('user.profilereservation.create', compact('rooms'));
    }

    // Handle form submission
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending'; // default status

        Reservation::create($data);

    }
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->latest()
            ->with('room') // agar room ka relation chahiye
            ->get();

        return view('user.profilereservation.index', compact('reservations'));
    }
}


