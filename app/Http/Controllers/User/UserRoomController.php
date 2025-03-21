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

        // ✅ Filter by Room Type
        if ($request->filled('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        // ✅ Filter by Min & Max Price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // ✅ Filter by Facilities
        if ($request->filled('facilities')) {
            $facilities = explode(',', $request->facilities);
            foreach ($facilities as $facility) {
                $query->where('facilities', 'LIKE', "%$facility%");
            }
        }

        // ✅ Filter by Room Capacity
        if ($request->filled('room_capacity')) {
            $query->where('room_capacity', '>=', $request->room_capacity);
        }

        // ✅ Exclude already booked rooms
        $query->whereNotIn('id', function ($subquery) {
            $subquery->select('room_id')
                ->from('reservations')
                ->whereDate('check_in', '<=', now())
                ->whereDate('check_out', '>=', now());
        });

        // ✅ Sorting Order (Default: Newest)
        if ($request->filled('sort_order')) {
            $query->orderBy('price', $request->sort_order);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // ✅ Get final results
        $rooms = $query->get();

        return view('user.rooms.index', compact('rooms'));
    }

    // ✅ Show Room Details
    public function show($id) 
    {
        $room = Room::findOrFail($id);
        return view('user.rooms.details', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        // Naya reservation create karein
        $reservation = new Reservation();
        $reservation->room_id = $request->room_id;
        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->check_in = $request->check_in;
        $reservation->check_out = $request->check_out;
        $reservation->status = 'booked'; // Default status
        $reservation->save();

        // Room ko booked mark karein
        $room = Room::find($request->room_id);
        $room->is_booked = true;  // Room ko mark karein
        $room->save();

        return redirect()->route('user.reservations.show', $reservation->id)
                        ->with('success', 'Room booked successfully!');
    }

}
