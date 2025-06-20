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
        return view('admin.rooms.index', compact('rooms'));
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
            'features' => 'nullable|array',
            'features.*' => 'exists:filter_options,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('assets/images/room_images');
            $request->file('image')->move($destinationPath, $imageName);
            $imagePath = 'assets/images/room_images/' . $imageName;

            $room = Room::create([
                'room_name' => $request->room_name,
                'room_type' => $request->room_type,
                'price' => $request->price,
                'room_capacity' => $request->room_capacity,
                'size' => $request->size,
                'view_type' => $request->view_type,
                'description' => $request->description,
                'image' => $imagePath,
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
            ];

            if ($request->hasFile('image')) {
                $existingImagePath = public_path($room->image);
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }

                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $destinationPath = public_path('assets/images/room_images');
                $request->file('image')->move($destinationPath, $imageName);
                $data['image'] = 'assets/images/room_images/' . $imageName;
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
            if ($room->image) {
                $imagePath = public_path($room->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $room->filterOptions()->detach();
            $room->delete();

            return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting room: ' . $e->getMessage());
        }
    }
}
