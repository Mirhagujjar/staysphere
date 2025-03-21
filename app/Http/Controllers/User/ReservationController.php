<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room; // Import Room model

class ReservationController extends Controller
{
    // Show reservation form
    public function reservationform(Request $request)
    {
        $room_id = $request->room_id;
        return view('user.reservations.create', compact('room_id'));
    }

    // Show all reservations
    public function index()
    {
        $reservations = Reservation::with('room')->get(); // Load room details
        return view('user.reservations.reservations_list', compact('reservations'));
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
        return view('user.reservations.edit', compact('reservation'));
    }

    // Update reservation
    public function update(Request $request, $id)
    {
        $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservation = Reservation::findOrFail($id);

        // Check if the room is available for the new dates
        $isBooked = Reservation::where('room_id', $request->room_id)
            ->where('id', '!=', $id) // Exclude current reservation
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
            })
            ->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'This room is already booked for the selected dates.');
        }

        // Update reservation
        $reservation->update($request->all());

        return redirect()->route('user.reservations.index')->with('success', 'Reservation updated successfully!');
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
        Reservation::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'status' => 'pending',
        ]);

        // Check if the room is already booked for these dates
        $isBooked = Reservation::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
            })
            ->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'This room is already booked for the selected dates.');
        }

        // Store Reservation
        Reservation::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'room_id'   => $request->room_id,
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'room_type' => $request->room_type,
            'guests'    => $request->guests,
            'status'    => 'pending', // Default status
        ]);

        return redirect()->route('user.reservations.index')->with('success', 'Room booked successfully!');
    }
}
