<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{
    public function reservationform(Request $request)
    {
        $room_id = $request->input('room_id');
        $room = Room::findOrFail($room_id);
        $roomTypes = \App\Models\FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type');
        })->get();
        $services = Service::all();
        $user = auth()->user();

        return view('User.reservations.create', compact('room', 'roomTypes', 'services', 'user'));
    }

    public function index()
    {
        $reservations = Reservation::with(['room', 'services', 'roomType'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.reservations.index', compact('reservations'));
    }

    public function show($id)
    {
        // $reservation = Reservation::with(['room', 'roomType'])->findOrFail($id);
        $reservation = Reservation::with(['room', 'roomType', 'services'])->findOrFail($id);

        // Only show room number if status is confirmed
        if ($reservation->status !== 'confirmed') {
            $reservation->room_number = null;
        }
        
        return view('user.reservations.show', compact('reservation'));
    }

    public function edit($id)
    {
        $reservation = Reservation::with('room')->findOrFail($id);
        $user = auth()->user();
        $roomTypes = \App\Models\FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type');
        })->get();
        $services = Service::all();

        if (Carbon::parse($reservation->check_out)->isPast()) {
            return redirect()->route('user.reservations.index')
                ->with('error', 'This reservation cannot be edited anymore.');
        }

        return view('user.reservations.edit', compact('reservation', 'roomTypes', 'services', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservation = Reservation::findOrFail($id);

        if (Carbon::parse($reservation->check_out)->isPast()) {
            return redirect()->route('user.reservations.edit', $id)
                ->with('error', 'This reservation cannot be edited anymore.');
        }

        // Only allow updates to pending reservations
        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Only pending reservations can be edited.');
        }

        $reservation->update($validated);

        return redirect()->route('user.reservations.index')
            ->with('success', 'Reservation updated successfully!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        // Only allow deletion of pending reservations
        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Only pending reservations can be cancelled.');
        }
        
        $reservation->delete();
        return redirect()->route('user.reservations.index')->with('success', 'Reservation cancelled successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|array|min:1',
            'rooms.*.room_type' => 'required|string',
            'rooms.*.guests' => 'required|integer|min:1',
        ]);

        $room = Room::findOrFail($request->room_id);

        foreach ($request->rooms as $roomData) {
            $reservation = Reservation::create([
                'user_id' => auth()->id(),
                'room_id' => null, // Admin will assign later
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'room_type' => $roomData['room_type'],
                'guests' => $roomData['guests'],
                'status' => 'pending',
            ]);

            // if (!empty($roomData['services'])) {
            //     $reservation->services()->attach($roomData['services']);
            // }
            if ($request->has('services')) {
                $reservation->services()->attach($request->services);
            }
        }

        return redirect()->route('user.reservations.index')->with('success', 'Reservation created successfully!');
    }

    public function myBookings()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->orderBy('check_in', 'desc')
            ->get();
            
        return view('User.profile.show', compact('reservations'));
    }

    public function checkAvailability(Request $request)
    {
        $rooms = Room::where('room_type', $request->room_type)->get();
        $available = 0;

        foreach ($rooms as $room) {
            $overlap = Reservation::where('room_id', $room->id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                        ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                        ->orWhere(function ($q) use ($request) {
                            $q->where('check_in', '<', $request->check_in)
                              ->where('check_out', '>', $request->check_out);
                        });
                })
                ->exists();

            if (!$overlap) $available++;
        }

        return response()->json(['available' => $available]);
    }

    // invoice generation
    public function invoice($id)
    {
        $reservation = Reservation::with(['room', 'services'])->findOrFail($id);

        return view('user.reservations.invoice', compact('reservation'));
    }

    // App\Http\Controllers\User\ReservationController.php

public function downloadInvoice($id)
{
    $reservation = Reservation::with('services', 'room')->findOrFail($id);

    // Room total price calculate karo
    $roomTotal = $reservation->room->price ?? 0;

    // Services total calculate karo (example: sum of all services' prices)
    $servicesTotal = $reservation->services->sum('price'); // assuming services have 'price' field

    // Total = room + services
    $total = $roomTotal + $servicesTotal;

    // View ko data pass karo
    $pdf = \PDF::loadView('User.reservations.invoice_pdf', [
        'reservation' => $reservation,
        'roomTotal' => $roomTotal,
        'servicesTotal' => $servicesTotal,
        'total' => $total,
    ]);

    return $pdf->download('invoice_' . $reservation->id . '.pdf');
}


}