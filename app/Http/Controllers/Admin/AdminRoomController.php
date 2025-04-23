<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function dashboard()
    {
        $rooms = Room::all(); 
        return view('admin.dashboard', compact('rooms'));
    }

    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $rooms = Room::all(); 
        return view('admin.rooms.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'room_capacity' => 'required|integer|min:1',
            'facilities' => 'required|string',
            'has_view' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/rooms'), $imageName);
            $imagePath = 'assets/images/rooms/' . $imageName; 
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

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string',
            'price' => 'required|numeric',
            'room_capacity' => 'required|integer',
            'facilities' => 'nullable|string',
            'has_view' => 'required|boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $room = Room::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if needed (optional)
            if ($room->image && file_exists(public_path($room->image))) {
                unlink(public_path($room->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/rooms'), $imageName);
            $room->image = 'assets/images/rooms/' . $imageName; 
        }

        $room->room_name = $request->room_name;
        $room->room_type = $request->room_type;
        $room->price = $request->price;
        $room->room_capacity = $request->room_capacity;
        $room->facilities = $request->facilities;
        $room->has_view = $request->has_view;
        $room->save();

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        // Deleting the image before deleting the room record (optional)
        if ($room->image && file_exists(public_path($room->image))) {
            unlink(public_path($room->image));
        }
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully!');
    }
}
