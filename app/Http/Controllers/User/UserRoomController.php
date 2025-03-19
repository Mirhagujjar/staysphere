<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;  

use App\Models\Room;
use Illuminate\Http\Request;

class UserRoomController extends Controller {
    
    public function index(Request $request) {
        $query = Room::query();
    
        // ✅ Agar koi filter apply nahi kiya gaya to saare rooms show karna
        if (!$request->hasAny(['room_type', 'min_price', 'max_price', 'facilities', 'room_capacity', 'sort_order'])) {
            $rooms = Room::all();
            return view('user.rooms.index', compact('rooms'));
        }
    
        // ✅ Filter by Room Type
        if ($request->filled('room_type')) {
            $query->where('room_type', $request->room_type);
        }
    
        // ✅ Filter by Min & Max Price (Allow Individual)
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
    
        // ✅ Sorting Order (Default to Newest)
        if ($request->filled('sort_order')) {
            $query->orderBy('price', $request->sort_order);
        } else {
            $query->orderBy('created_at', 'desc'); // Default sorting
        }
    
        $rooms = $query->get(); // Filtered results lo
    
        return view('user.rooms.index', compact('rooms'));
    }
    
    
    
    

    //  Show Room Details
    public function show($id) {
        $room = Room::findOrFail($id);
        return view('user.rooms.details', compact('room'));
    }
}
