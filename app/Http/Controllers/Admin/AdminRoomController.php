<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminRoomController extends Controller
 {
    public function dashboard()
    {
        $rooms = Room::all(); // Fetching all rooms

        return view('admin.dashboard', compact('rooms'));
    }
    //  Show All Rooms in Admin Dashboard
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    // Show Create Room Form
    public function create()
    {
        $rooms = Room::all(); // Fetch all rooms

        return view('admin.rooms.create', compact('rooms')); 
    }

    //  Store Room in Database
    public function store(Request $request) {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'room_capacity' => 'required|integer|min:1',
            'facilities' => 'required|string',
            'has_view' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('room_images', 'public');
        }

        Room::create([
            'room_name' => $request->room_name,
            'room_type' => $request->room_type,
            'price' => $request->price,
            'room_capacity' => $request->room_capacity,
            'facilities' => $request->facilities,
            'has_view' => $request->has_view ?? false,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Room added successfully!');
    }

    //  Show Edit Form
    public function edit($id) {
        $room = Room::findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');

    }

    // Update Room
    // public function update(Request $request, $id) {
    //     $room = Room::findOrFail($id);

    //     $request->validate([
    //         'room_name' => 'required|string|max:255',
    //         'room_type' => 'required|string',
    //         'price' => 'required|numeric|min:0',
    //         'room_capacity' => 'required|integer|min:1',
    //         'facilities' => 'required|string',
    //         'has_view' => 'boolean',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('room_images', 'public');
    //         $room->image = $imagePath;
    //     }

    //     $room->update([
    //         'room_name' => $request->room_name,
    //         'room_type' => $request->room_type,
    //         'price' => $request->price,
    //         'room_capacity' => $request->room_capacity,
    //         'facilities' => $request->facilities,
    //         'has_view' => $request->has_view ?? false,
    //     ]);

    //     return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
    // }


    public function update(Request $request, $id)
    {
        // Validate form data
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string',
            'price' => 'required|numeric',
            'room_capacity' => 'required|integer',
            'facilities' => 'nullable|string',
            'has_view' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048' // Image validation
        ]);
    
        // Find the room by ID
        $room = Room::findOrFail($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($room->image) {
                Storage::delete($room->image);
            }
    
            // Upload new image & store path
            $path = $request->file('image')->store('room_images', 'public');
            $room->image = $path; // Save new image path in database
        }
    
        

        // Update room details
        $room->room_name = $request->room_name;
        $room->room_type = $request->room_type;
        $room->price = $request->price;
        $room->room_capacity = $request->room_capacity;
        $room->facilities = $request->facilities;
        $room->has_view = $request->has_view;
        $room->save();
    
        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
    }
    


    //  Delete Room
    public function destroy($id) {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully!');
    }

    

 }