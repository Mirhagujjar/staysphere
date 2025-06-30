<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room; 

use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    // Show reservation form
    public function reservationform(Request $request)
    {
        $room_id = $request->input('room_id');

        $room = Room::findOrFail($room_id); 

        // $roomTypes = \App\Models\FilterOption::whereHas('filter', fn($q) => $q->where('slug', 'room-type'))->get();
         $roomTypes = \App\Models\FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type');
        })->get();

        return view('User.reservations.create', compact('room','roomTypes','room_id'));
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

        if (\Carbon\Carbon::parse($reservation->check_out)->isPast()) {
           return redirect()->route('user.reservations.edit', $id)->with('error', 'This reservation cannot be edited anymore.');
        }

        return view('user.reservations.edit', compact('reservation'));

        
    }


    // Update reservation
    // Update method
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'room_id'   => 'required|exists:rooms,id',
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|between:10,15',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'room_type' => 'required|string',
            'guests' => 'required|integer|min:1',
        ]);

        // Check room availability first
       $isBooked = Reservation::where('room_id', $request->room_id)
        ->where(function ($query) use ($request) {
            $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                ->orWhere(function ($query) use ($request) {
                    $query->where('check_in', '<', $request->check_in)
                            ->where('check_out', '>', $request->check_out);
                });
        })
        ->exists();


        if ($isBooked) {
            return back()->withInput()->with('error', 'This room is already booked for the selected dates.');
        }

        // Create only once
        $reservation = Reservation::create([
            'room_id' => $request->room_id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'room_type' => $request->room_type,
            'guests' => $request->guests,
            'status' => 'pending'
        ]);

        return redirect()->route('user.reservations.index')->with('success', 'Room booked successfully!');
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
