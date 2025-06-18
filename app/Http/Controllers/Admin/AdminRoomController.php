<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Filter;
use App\Models\FilterOption;


class AdminRoomController extends Controller
{
    public function dashboard()
    {
        $rooms = Room::all(); 
        return view('admin.dashboard', compact('rooms'));
    }

    // Index method
    public function index()
    {
        $rooms = Room::with('filterOptions')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    // Edit method
    public function edit(Room $room)
    {
        $roomTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type');
        })->get();
        
        $viewTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'view-type');
        })->get();
        
        $featureFilters = Filter::whereNotIn('slug', ['room-type', 'view-type'])
            ->where('is_active', true)
            ->with(['options' => function($q) {
                $q->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        return view('admin.rooms.edit', compact('room', 'roomTypes', 'viewTypes', 'featureFilters'));
    }

    // Update method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'room_capacity' => 'required|integer|min:1',
            'size' => 'required|integer|min:0',
            'view_type' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'exists:filter_options,id'
        ]);

        // Handle image upload to public/assets/images/rooms
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('assets/images/rooms'), $imageName);
        $validated['image'] = 'assets/images/rooms/'.$imageName;

        // Create the room
        $room = Room::create($validated);

        // Attach features/facilities
        if ($request->has('features')) {
            $room->filterOptions()->attach($request->features);
        }

        return redirect()->route('admin.rooms.index')
               ->with('success', 'Room added successfully!');
    }

   public function update(Request $request, Room $room)
    {
        // Validate only the fields that are allowed to be updated
        $validated = $request->validate([
            'room_name' => 'nullable|string|max:255',
            'room_type' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'room_capacity' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:0',
            'view_type' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'exists:filter_options,id'
        ]);

        // Handle image upload if new image is provided in the request
        if ($request->has('image')) {
            // Delete the old image from the server if exists
            if (!empty($room->image)) {
                $imagePath = public_path($room->image);
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Upload the new image and store its path
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images/rooms'), $imageName);
            $validated['image'] = 'assets/images/rooms/' . $imageName;
        }

        // Update only the fields that are present in the request
        $room->update(array_filter($validated));

        // Sync features if features are provided
        if ($request->has('features')) {
            $room->filterOptions()->sync($request->features);
        }

        // If no features are provided, detach all current ones
        if (!$request->has('features')) {
            $room->filterOptions()->detach();
        }

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room updated successfully!');
    }



    // app/Http/Controllers/Admin/AdminRoomController.php
    public function create()
    {
        // Get room type options from your filter system
        $roomTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type');
        })->get();
        
        $viewTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'view-type');
        })->get();
        
        // Get other feature filters (excluding room type and view type)
        $featureFilters = Filter::whereNotIn('slug', ['room-type', 'view-type'])
            ->where('is_active', true)
            ->with(['options' => function($q) {
                $q->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        return view('admin.rooms.create', compact('roomTypes', 'viewTypes', 'featureFilters'));
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'room_name' => 'required|string|max:255',
    //         'room_type' => 'required|string',
    //         'price' => 'required|numeric|min:0',
    //         'room_capacity' => 'required|integer|min:1',
    //         'size' => 'required|integer|min:0',
    //         'view_type' => 'required|string',
    //         'description' => 'required|string',
    //         'image' => 'required|image|max:2048',
    //         'features' => 'nullable|array',
    //         'features.*' => 'exists:filter_options,id'
    //     ]);

    //     // Handle image upload
    //     $imagePath = $request->file('image')->store('room_images', 'public');
    //     $validated['image'] = $imagePath;

    //     // Create the room
    //     $room = Room::create($validated);

    //     // Attach features/facilities
    //     if ($request->has('features')) {
    //         $room->filterOptions()->attach($request->features);
    //     }

    //     return redirect()->route('admin.rooms.index')
    //         ->with('success', 'Room added successfully!');
    // }

    // public function edit($id)
    // {
    //     $room = Room::with('filterOptions')->findOrFail($id);
    //     $filters = Filter::with('options')->orderBy('order')->get();
    //     return view('admin.rooms.edit', compact('room', 'filters'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         // ... existing validation rules ...
    //         'filter_options' => 'nullable|array',
    //         'filter_options.*' => 'exists:filter_options,id',
    //     ]);

    //     $room = Room::findOrFail($id);

    //     // ... existing update logic ...

    //     // Sync filter options
    //     $room->filterOptions()->sync($request->filter_options ?? []);

    //     return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
    // }

    // public function create()
    // {
    //     $rooms = Room::all(); 
    //     return view('admin.rooms.create', compact('rooms'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'room_name' => 'required|string|max:255',
    //         'room_type' => 'required|string',
    //         'price' => 'required|numeric|min:0',
    //         'room_capacity' => 'required|integer|min:1',
    //         'facilities' => 'required|string',
    //         'has_view' => 'boolean',
    //         'image' => 'nullable|image|max:2048',
    //     ]);

    //     $imagePath = null;

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('assets/images/rooms'), $imageName);
    //         $imagePath = 'assets/images/rooms/' . $imageName; 
    //     }

    //     Room::create([
    //         'room_name' => $request->room_name,
    //         'room_type' => $request->room_type,
    //         'price' => $request->price,
    //         'room_capacity' => $request->room_capacity,
    //         'facilities' => $request->facilities,
    //         'has_view' => $request->has_view ?? false,
    //         'image' => $imagePath,
    //     ]);

    //     return redirect()->route('admin.rooms.index')->with('success', 'Room added successfully!');
    // }

    // public function edit($id)
    // {
    //     $room = Room::findOrFail($id);
    //     return view('admin.rooms.edit', compact('room'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'room_name' => 'required|string|max:255',
    //         'room_type' => 'required|string',
    //         'price' => 'required|numeric',
    //         'room_capacity' => 'required|integer',
    //         'facilities' => 'nullable|string',
    //         'has_view' => 'required|boolean',
    //         'image' => 'nullable|image|max:2048'
    //     ]);

    //     $room = Room::findOrFail($id);

    //     if ($request->hasFile('image')) {
    //         // Delete old image if needed (optional)
    //         if ($room->image && file_exists(public_path($room->image))) {
    //             unlink(public_path($room->image));
    //         }

    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('assets/images/rooms'), $imageName);
    //         $room->image = 'assets/images/rooms/' . $imageName; 
    //     }

    //     $room->room_name = $request->room_name;
    //     $room->room_type = $request->room_type;
    //     $room->price = $request->price;
    //     $room->room_capacity = $request->room_capacity;
    //     $room->facilities = $request->facilities;
    //     $room->has_view = $request->has_view;
    //     $room->save();

    //     return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
    // }

    // public function destroy($id)
    // {
    //     $room = Room::findOrFail($id);
    //     // Deleting the image before deleting the room record (optional)
    //     if ($room->image && file_exists(public_path($room->image))) {
    //         unlink(public_path($room->image));
    //     }
    //     $room->delete();
    //     return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully!');
    // }
}
