<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Filter;
use App\Models\FilterOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdminRoomController extends Controller
{
    public function dashboard()
    {
        $rooms = Room::with('filterOptions')->latest()->take(5)->get();
        return view('admin.dashboard', compact('rooms'));
    }

   public function index()
    {
        $rooms = Room::with('filterOptions')->paginate(10);
        $heroRoom = Room::whereNotNull('hero_title')
                    ->orWhereNotNull('hero_image')
                    ->first();
        
        return view('admin.rooms.index', compact('rooms', 'heroRoom'));
    }

     public function details($id)
    {
        $room = Room::with([
            'roomType',
            'viewType',
            'filterOptions' => function ($query) {
                $query->where('is_active', true)->with('filter');
            }
        ])->findOrFail($id);

        return view('admin.rooms.details', compact('room'));
    }

    public function create()
    {
        $roomTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type')->where('is_active', true);
        })->orderBy('order')->get();

        $viewTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'view-type')->where('is_active', true);
        })->orderBy('order')->get();

        $featureFilters = Filter::whereNotIn('slug', ['room-type', 'view-type'])
            ->where('is_active', true)
            ->with(['options' => function($q) {
                $q->where('is_active', true)->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        return view('admin.rooms.create', compact('roomTypes', 'viewTypes', 'featureFilters'));
    }

    public function edit(Room $room)
    {
        $roomTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type')->where('is_active', true);
        })->orderBy('order')->get();

        $viewTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'view-type')->where('is_active', true);
        })->orderBy('order')->get();

        $featureFilters = Filter::whereNotIn('slug', ['room-type', 'view-type'])
            ->where('is_active', true)
            ->with(['options' => function($q) {
                $q->where('is_active', true)->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        $currentFeatures = $room->filterOptions->pluck('id')->toArray();

        return view('admin.rooms.edit', compact('room', 'roomTypes', 'viewTypes', 'featureFilters', 'currentFeatures'));
    }

    public function store(Request $request)
    {
        $roomTypeFilterId = Filter::where('slug', 'room-type')->value('id');
        $viewTypeFilterId = Filter::where('slug', 'view-type')->value('id');

        $validator = Validator::make($request->all(), [
            'room_name' => 'required|string|max:255',
            'room_type' => [
                'required',
                Rule::exists('filter_options', 'value')->where('filter_id', $roomTypeFilterId),
            ],
            'price' => 'required|numeric|min:0',
            'room_capacity' => 'required|integer|min:1',
            'size' => 'required|integer|min:0',
            'view_type' => [
                'required',
                Rule::exists('filter_options', 'value')->where('filter_id', $viewTypeFilterId),
            ],
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'exists:filter_options,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Handle main image upload
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('assets/images/room_images');
            $request->file('image')->move($destinationPath, $imageName);
            $imagePath = 'assets/images/room_images/' . $imageName;

            // Handle hero image upload if exists
            $heroImagePath = null;
            if ($request->hasFile('hero_image')) {
                $heroImageName = time() . '_hero_' . $request->file('hero_image')->getClientOriginalName();
                $heroDestinationPath = public_path('assets/images/hero_images');
                $request->file('hero_image')->move($heroDestinationPath, $heroImageName);
                $heroImagePath = 'assets/images/hero_images/' . $heroImageName;
            }

            // Create the room
            $room = Room::create([
                'room_name' => $request->room_name,
                'room_type' => $request->room_type,
                'price' => $request->price,
                'room_capacity' => $request->room_capacity,
                'size' => $request->size,
                'view_type' => $request->view_type,
                'description' => $request->description,
                'image' => $imagePath,
                'hero_title' => $request->hero_title,
                'hero_description' => $request->hero_description,
                'hero_image' => $heroImagePath,
                'is_booked' => false
            ]);

            if ($request->has('features')) {
                $room->filterOptions()->attach($request->features);
            }

            return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating room: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, Room $room)
    {
        $roomTypeFilterId = Filter::where('slug', 'room-type')->value('id');
        $viewTypeFilterId = Filter::where('slug', 'view-type')->value('id');

        $validator = Validator::make($request->all(), [
            'room_name' => 'required|string|max:255',
            'room_type' => [
                'required',
                Rule::exists('filter_options', 'value')->where('filter_id', $roomTypeFilterId),
            ],
            'price' => 'required|numeric|min:0',
            'room_capacity' => 'required|integer|min:1',
            'size' => 'required|integer|min:0',
            'view_type' => [
                'required',
                Rule::exists('filter_options', 'value')->where('filter_id', $viewTypeFilterId),
            ],
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'exists:filter_options,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'room_name' => $request->room_name,
                'room_type' => $request->room_type,
                'price' => $request->price,
                'room_capacity' => $request->room_capacity,
                'size' => $request->size,
                'view_type' => $request->view_type,
                'description' => $request->description,
                'hero_title' => $request->hero_title,
                'hero_description' => $request->hero_description,
            ];

            // Handle main image update
            if ($request->hasFile('image')) {
                // Delete old image
                $existingImagePath = public_path($room->image);
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }

                // Upload new image
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $destinationPath = public_path('assets/images/room_images');
                $request->file('image')->move($destinationPath, $imageName);
                $data['image'] = 'assets/images/room_images/' . $imageName;
            }

            // Handle hero image update
            if ($request->hasFile('hero_image')) {
                // Delete old hero image if exists
                if ($room->hero_image) {
                    $existingHeroImagePath = public_path($room->hero_image);
                    if (file_exists($existingHeroImagePath)) {
                        unlink($existingHeroImagePath);
                    }
                }

                // Upload new hero image
                $heroImageName = time() . '_hero_' . $request->file('hero_image')->getClientOriginalName();
                $heroDestinationPath = public_path('assets/images/hero_images');
                $request->file('hero_image')->move($heroDestinationPath, $heroImageName);
                $data['hero_image'] = 'assets/images/hero_images/' . $heroImageName;
            }

            $room->update($data);
            $room->filterOptions()->sync($request->features ?? []);

            return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating room: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Room $room)
    {
        try {
            // Delete main image
            if ($room->image) {
                $imagePath = public_path($room->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete hero image if exists
            if ($room->hero_image) {
                $heroImagePath = public_path($room->hero_image);
                if (file_exists($heroImagePath)) {
                    unlink($heroImagePath);
                }
            }

            $room->filterOptions()->detach();
            $room->delete();

            return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting room: ' . $e->getMessage());
        }
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'hero_image' => 'nullable|image|max:2048',
            'remove_hero_image' => 'nullable|boolean'
        ]);

        // Get the first room or create a new one if none exists
        $room = Room::firstOrNew();

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old hero image manually
            if ($room->hero_image) {
                $existingHeroImagePath = public_path($room->hero_image);
                if (file_exists($existingHeroImagePath)) {
                    unlink($existingHeroImagePath);
                }
            }

            // Upload new hero image manually to public/assets/images/hero_images
            $heroImageName = time() . '_hero_' . $request->file('hero_image')->getClientOriginalName();
            $heroDestinationPath = public_path('assets/images/hero_images');
            $request->file('hero_image')->move($heroDestinationPath, $heroImageName);

            // Set public path
            $room->hero_image = 'assets/images/hero_images/' . $heroImageName;
        }
 
        elseif ($request->has('remove_hero_image')) {
            // Remove image if checkbox is checked
            if ($room->hero_image) {
                Storage::delete($room->hero_image);
                $room->hero_image = null;
            }
        }

        // Update hero content
        $room->hero_title = $request->hero_title;
        $room->hero_description = $request->hero_description;
        $room->save();

        return redirect()->route('admin.rooms.index')
                    ->with('success', 'Hero section updated successfully!');
    }
}