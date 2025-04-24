<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;

class UserRoomController extends Controller 
{
    public function index(Request $request) 
    {
        $query = Room::query();

        // Filter by room type
        if ($request->filled('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by facilities
        if ($request->filled('facilities')) {
            $facilities = explode(',', $request->facilities);
            foreach ($facilities as $facility) {
                $query->where('facilities', 'LIKE', "%$facility%");
            }
        }
        // Sort order
        if ($request->filled('sort_order')) {
            $query->orderBy('price', $request->sort_order);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Get the filtered rooms
        $rooms = $query->get();

        return view('user.rooms.index', compact('rooms'));
    }

    public function show($id) 
    {
        $room = Room::findOrFail($id);
        return view('user.rooms.details', compact('room'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        // Create a new reservation
        $reservation = new Reservation();
        $reservation->room_id = $request->room_id;
        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->check_in = $request->check_in;
        $reservation->check_out = $request->check_out;
        $reservation->status = 'booked'; // Default status
        $reservation->save();

        // Mark the room as booked
        $room = Room::find($request->room_id);
        $room->is_booked = true;  // Mark the room
        $room->save();

        return redirect()->route('user.reservations.show', $reservation->id)
                         ->with('success', 'Room booked successfully!');
    }
}