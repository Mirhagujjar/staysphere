<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\ReservationRoom; // Assuming you have a model for the pivot table
use App\Models\Room;
use App\Models\RoomType;


use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    // Show reservation form
public function reservationform(Request $request)
{
    $room_id = $request->input('room_id');

    $room = Room::findOrFail($room_id);

    // ✅ Saare room types (FilterOption se)
    $roomTypes = \App\Models\FilterOption::whereHas('filter', function($q) {
        $q->where('slug', 'room-type');
    })->get();

    // ✅ Services
    $services = Service::all();

    // ✅ Auth user ka name/email auto-fill
    $user = auth()->user();

    return view('User.reservations.create', compact('room', 'roomTypes', 'services', 'user'));
}




    // public function reservationform()
    // {

    //     $roomTypes = \App\Models\FilterOption::whereHas('filter', fn($q) => $q->where('slug', 'room-type'))->get();
    //     return view('user.reservations.create', compact('roomTypes'));
    // }

    // Show all reservations
   public function index()
    {
        $reservations = Reservation::with('room') // eager load the room
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.reservations.index', compact('reservations'));
    }


    // Show reservation details
    public function show($id)
    {
        $reservation = Reservation::with('room')->findOrFail($id);
        return view('user.reservations.show', compact('reservation'));
    }

    // Edit reservation
    public function edit($id)
{
    $reservation = Reservation::with('room')->findOrFail($id);

    $user = auth()->user();

    $roomTypes = \App\Models\FilterOption::whereHas('filter', function($q) {
        $q->where('slug', 'room-type');
    })->get();

    $services = \App\Models\Service::all(); // ✅ Load services!

    if (\Carbon\Carbon::parse($reservation->check_out)->isPast()) {
        return redirect()->route('user.reservations.index')
            ->with('error', 'This reservation cannot be edited anymore.');
    }

    return view('user.reservations.edit', compact('reservation', 'roomTypes', 'services', 'user'));
}




    // Update reservation
    // Update method
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservation = Reservation::findOrFail($id);

        // Check if the reservation can still be edited
        if (\Carbon\Carbon::parse($reservation->check_out)->isPast()) {
            return redirect()->route('user.reservations.edit', $id)
                ->with('error', 'This reservation cannot be edited anymore.');
        }

        // Proceed with the update if all validations pass
        // Check room availability
        $isBooked = Reservation::where('room_id', $validated['room_id'])
            ->where('id', '!=', $id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                    ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']]);
            })
            ->exists();

        if ($isBooked) {
            return back()->withInput()->with('error', 'Room already booked for these dates.');
        }

        try {
            $reservation->update($validated);
            return redirect()->route('user.reservations.index')
                ->with('success', 'Reservation updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating reservation: '.$e->getMessage());
        }
    }

    // Delete reservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('user.reservations.index')->with('success', 'Reservation deleted successfully!');
    }

    // Store reservation
public function store(Request $request)
{
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'required|string|max:20',
        'rooms.*.room_type' => 'required',
        'rooms.*.guests'    => 'required|integer|min:1',
        'check_in'          => 'required|date',
        'check_out'         => 'required|date|after:check_in',
    ]);

    foreach ($request->rooms as $roomData) {
        Reservation::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'room_id'   => null, // ✅ abhi admin allot karega
            'room_type' => $roomData['room_type'],
            'guests'    => $roomData['guests'],
            'service_id'=> $roomData['service_id'] ?? null,
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'user_id'   => Auth::id(),
            'status'    => 'pending'
        ]);
    }

    return redirect()->route('user.reservations.index')->with('success', 'Rooms booked successfully!');
}










    public function myBookings()
    {
        $reservations = Reservation::where('user_id', auth()->id())->orderBy('check_in', 'desc')->get();
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


  

      
}
