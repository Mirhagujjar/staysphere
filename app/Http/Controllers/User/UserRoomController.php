<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Filter;

class UserRoomController extends Controller 
{
   public function index(Request $request)
{
    // Get all active filters with their options
    $filters = Filter::with(['options' => function($query) {
        $query->whereHas('rooms')->orderBy('order');
    }])->where('is_active', true)->orderBy('order')->get();

    // Filter rooms using scopes from your existing Room model
    $rooms = Room::withFilters($request->filters)
               ->priceRange($request->min_price, $request->max_price)
               ->with('filterOptions')
                ->select(['id', 'room_name', 'room_type', 'price', 'room_capacity', 'size', 'image'])
                 // Ensure size is selected

               ->paginate(12);

    return view('user.rooms.index', compact('rooms', 'filters'));
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