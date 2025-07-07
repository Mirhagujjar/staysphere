<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Notifications\ReservationCancelled;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StatusNotification;

class AdminReservationController extends Controller
{
    public function index(Request $request)
{
    $today = Carbon::today();

    // Start query builder with conditions
    $query = Reservation::with(['room', 'user'])
        ->whereDate('check_out', '>=', $today)
        ->whereNull('deleted_at');

    // Apply search filter if present
    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('phone', 'like', "%$search%")
              ->orWhere('status', 'like', "%$search%")
              ->orWhere('room_type', 'like', "%$search%");
        });
    }

    // Get all available rooms for assignment
    $rooms = Room::with('roomType')
                ->where('is_booked', false)
                ->get();

    // Execute the query
    $reservations = $query->get();

    return view('admin.reservations.index', compact('reservations', 'rooms'));
}

    public function show($id)
    {
        $reservation = Reservation::with('room')->findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'room_type' => $request->room_type,
            'guests' => $request->guests,
        ];

        // Only update status if it's being changed
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }

        $reservation->update($data);

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully!');
    }

    public function pastReservations()
    {
        $today = Carbon::today();

        $pastReservations = Reservation::with('room')
            ->onlyTrashed()
            ->orWhereDate('check_out', '<', $today)
            ->get();

        return view('admin.reservations.past', compact('pastReservations'));
    }

    public function forceDelete($id)
    {
        $reservation = Reservation::withTrashed()->findOrFail($id);
        $reservation->forceDelete();

        return back()->with('success', 'Reservation permanently deleted!');
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'reason' => 'nullable|string|max:255',
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        // Update status
        $reservation->status = $request->status;
        
        // If confirming, assign room
        if ($request->status === 'confirmed' && $request->filled('room_id')) {
            $reservation->room_id = $request->room_id;
            
            // Mark room as booked
            $room = Room::find($request->room_id);
            $room->is_booked = true;
            $room->save();
            
            // Notify user
            $reservation->user->notify(new StatusNotification(
                "Your room has been assigned successfully!",
                $reservation->id,
                'room'
            ));
        }
        elseif ($request->status === 'cancelled') {
            $reservation->reason = $request->reason;
            
            // Free up the room if it was assigned
            if ($reservation->room_id) {
                $room = Room::find($reservation->room_id);
                $room->is_booked = false;
                $room->save();
            }
            
            // Notify user
            $reservation->user->notify(new ReservationCancelled($reservation));
        }

        $reservation->save();

        return back()->with('success', 'Reservation status updated.');
    }
}