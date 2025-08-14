<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Facility;
use App\Models\Filter;
use App\Models\FilterOption;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Pagination\Paginator;


class UserRoomController extends Controller 
{
    public function index(Request $request)
    {
        $filters = Filter::where('is_active', true)
            ->with(['options' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        $filterParams = [
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'room_type' => $request->input('room_type'),
            'view_type' => $request->input('view_type'),
            'features'  => $request->input('filters', [])
        ];

        $query = Room::with(['filterOptions'])
                     ->whereRaw('total_quantity > booked_quantity');

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

        if (!empty($filterParams['features'])) {
            foreach ($filterParams['features'] as $slug => $optionIds) {
                if (!empty($optionIds)) {
                    $query->whereHas('filterOptions', function ($q) use ($optionIds) {
                        $q->whereIn('filter_option_id', (array) $optionIds);
                    });
                }
            }
        }

        $rooms = $query->paginate(12)->appends($request->query());

        $heroRoom = Room::whereNotNull('hero_image')
                    ->orWhereNotNull('hero_title')
                    ->orderBy('updated_at', 'desc')
                    ->first();

        $facilities = Facility::where('is_active', true)
                            ->orderBy('sort_order')
                            ->get();

        $facilitiesBackground = Facility::whereNotNull('background_image')
                                    ->value('background_image');

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
        $room = Room::with([
            'roomType',
            'viewType',
            'filterOptions' => function ($query) {
                $query->where('is_active', true)->with('filter');
            }
        ])->findOrFail($id);

        // ✅ Load all room types for the dropdown
        $roomTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type');
        })->get();

        return view('user.rooms.details', compact('room', 'roomTypes'));
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
            'quantity' => 'required|integer|min:1'
        ]);

        $room = Room::findOrFail($request->room_id);

        if ($room->booked_quantity + $request->quantity > $room->total_quantity) {
            return redirect()->back()->with('error', 'Not enough rooms available for your requested quantity.');
        }

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'pending',
            'quantity' => $request->quantity
        ]);

        $room->increment('booked_quantity', $request->quantity);

        return redirect()->route('user.reservations.show', $reservation->id)
                         ->with('success', 'Room booked successfully!');
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive(); // or Paginator::useBootstrapFour();
    }

}
