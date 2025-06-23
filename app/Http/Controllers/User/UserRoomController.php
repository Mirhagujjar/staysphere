<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Facility;

use App\Models\Filter;

class UserRoomController extends Controller 
{
   public function index(Request $request)
    {
        // Get all active filters with their active options
        $filters = Filter::where('is_active', true)
            ->with(['options' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        // Collect query parameters
        $filterParams = [
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'room_type' => $request->input('room_type'),
            'view_type' => $request->input('view_type'),
            'features'  => $request->input('filters', [])
        ];

        // Build base query
        $query = Room::with(['filterOptions']);

        // Static filter logic
        if (!empty($filterParams['min_price'])) {
            $query->where('price', '>=', $filterParams['min_price']);
        }

        if (!empty($filterParams['max_price'])) {
            $query->where('price', '<=', $filterParams['max_price']);
        }

        if (!empty($filterParams['room_type'])) {
            $query->where('room_type', $filterParams['room_type']);
        }

        if (!empty($filterParams['view_type'])) {
            $query->where('view_type', $filterParams['view_type']);
        }

        // Dynamic filters (extra features)
        if (!empty($filterParams['features'])) {
            foreach ($filterParams['features'] as $slug => $optionIds) {
                if (!empty($optionIds)) {
                    $query->whereHas('filterOptions', function ($q) use ($optionIds) {
                        $q->whereIn('filter_option_id', (array) $optionIds);
                    });
                }
            }
        }

        // Paginate and retain filter params in URL
        $rooms = $query->paginate(12)->appends($request->query());

        // Get featured room for hero section
        $heroRoom = Room::whereNotNull('hero_image')
                    ->orWhereNotNull('hero_title')
                    ->inRandomOrder()
                    ->first();

        // Get active facilities
        $facilities = Facility::where('is_active', true)
                            ->orderBy('sort_order')
                            ->get();

        // Get facilities background image
        $facilitiesBackground = Facility::whereNotNull('background_image')
                                    ->value('background_image');

        // Prepare hero section data with fallbacks
        $heroData = [
            'hero_title' => $heroRoom->hero_title ?? 'Our Rooms',
            'hero_description' => $heroRoom->hero_description ?? 'Indulge in the ultimate blend of elegance and comfort',
            'hero_image' => $heroRoom->hero_image ?? 'build/assets/images/r.jpg'
        ];

        return view('user.rooms.index', array_merge(
            compact('rooms', 'filters', 'facilities', 'facilitiesBackground'),
            $heroData
        ));
    }



   public function show($id)
    {
        $room = Room::with(['roomType', 'viewType', 'filterOptions.filter'])->findOrFail($id);
        return view('user.rooms.details', compact('room'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservation = Reservation::create([
            'room_id' => $request->room_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'confirmed'
        ]);

        Room::where('id', $request->room_id)->update(['is_booked' => true]);

        return redirect()->route('user.reservations.show', $reservation->id)
                         ->with('success', 'Room booked successfully!');
    }

    /**
     * Ensure required default filters exist
     */
    protected function ensureDefaultFiltersExist(&$filters)
    {
        $requiredFilters = ['room-type', 'view-type'];
        
        foreach ($requiredFilters as $slug) {
            if ($filters->where('slug', $slug)->isEmpty()) {
                $filter = Filter::firstOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => ucwords(str_replace('-', ' ', $slug)),
                        'type' => 'dropdown',
                        'is_active' => true,
                        'order' => Filter::max('order') + 1
                    ]
                );
                
                if (!$filters->contains('id', $filter->id)) {
                    $filters->push($filter);
                }
            }
        }
    }

    /**
     * Prepare filter parameters from request
     */
    protected function prepareFilterParams(Request $request)
    {
        $filterParams = [];
        
        // Price range
        if ($request->filled('min_price')) {
            $filterParams['min_price'] = $request->min_price;
        }
        if ($request->filled('max_price')) {
            $filterParams['max_price'] = $request->max_price;
        }

        // Room type
        if ($request->filled('room_type')) {
            $filterParams['room_type'] = $request->room_type;
        }

        // View type
        if ($request->filled('view_type')) {
            $filterParams['view_type'] = $request->view_type;
        }

        // Other filters
        if ($request->filled('filters')) {
            foreach ($request->filters as $filterSlug => $options) {
                if (!empty($options)) {
                    $filterParams[$filterSlug] = $options;
                }
            }
        }

        return $filterParams;
    }

    /**
     * Get filtered rooms based on parameters
     */
    protected function getFilteredRooms(array $filterParams)
    {
        return Room::available()
            ->withFilters($filterParams)
            ->with('filterOptions')
            ->select(['id', 'room_name', 'room_type', 'price', 'room_capacity', 'size', 'image', 'is_booked'])
            ->paginate(12);
    }
}