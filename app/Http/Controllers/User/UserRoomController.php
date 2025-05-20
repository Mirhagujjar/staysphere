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
        // Get all filters with their options
        $filters = Filter::with(['options' => function($query) {
            $query->orderBy('order');
        }])->orderBy('order')->get();

        // Prepare filters array with priority
        $filterParams = [];
        
        // Add price range if provided
        if ($request->filled('min_price')) {
            $filterParams['min_price'] = $request->min_price;
        }
        if ($request->filled('max_price')) {
            $filterParams['max_price'] = $request->max_price;
        }

        // Add room type if provided
        if ($request->filled('room_type')) {
            $filterParams['room_type'] = $request->room_type;
        }

        // Add view type if provided
        if ($request->filled('view_type')) {
            $filterParams['view_type'] = $request->view_type;
        }

        // Add other filters (Star Rating, Special Offers, Packages)
        if ($request->filled('filters')) {
            foreach ($request->filters as $filterSlug => $options) {
                if (!empty($options)) {
                    // Handle special cases for specific filter types
                    if ($filterSlug === 'star_rating') {
                        $filterParams['star_rating'] = $options;
                    } elseif ($filterSlug === 'special_offers') {
                        $filterParams['special_offers'] = $options;
                    } elseif ($filterSlug === 'packages') {
                        $filterParams['packages'] = $options;
                    } else {
                        $filterParams[$filterSlug] = $options;
                    }
                }
            }
        }

        // Filter rooms with priority and only show available rooms
        $rooms = Room::available()
                ->withFilters($filterParams)
                ->with('filterOptions')
                ->select(['id', 'room_name', 'room_type', 'price', 'room_capacity', 'size', 'image'])
                ->paginate(12);

        return view('user.rooms.index', compact('rooms', 'filters'));
    }



    public function show($id) 
    {
        $room = Room::with('filterOptions.filter')->findOrFail($id);
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