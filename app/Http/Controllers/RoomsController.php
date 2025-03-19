<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
class RoomsController extends Controller
{
    // public function showRooms()
    // {
    //     return view('rooms'); 
    // }
    // public function index() {
    //     $rooms = Rooms::all();
    //     return view('rooms', compact('rooms'));
    // }
    // public function showRoom() {
    //     $rooms = Room::all(); 
    //     return view('rooms', compact('rooms'));
    // }
    



    public function index(Request $request) {
        $query = Room::query();

        // Filtering by Room Type
        if ($request->has('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        // Filtering by Price Range
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Filtering by Facilities
        if ($request->has('facilities')) {
            $facilities = explode(',', $request->facilities);
            foreach ($facilities as $facility) {
                $query->where('facilities', 'LIKE', "%$facility%");
            }
        }

        // Filtering by Room Capacity
        if ($request->has('room_capacity')) {
            $query->where('room_capacity', '>=', $request->room_capacity);
        }

        // Sorting Order (Ascending or Descending)
        $sortOrder = $request->input('sort_order', 'asc');
        $query->orderBy('price', $sortOrder);

        $rooms = $query->get();

        return view('user.rooms.index', compact('rooms'));
    }
}
