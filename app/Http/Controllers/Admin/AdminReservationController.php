<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomType;

use App\Models\User;
use App\Notifications\ReservationCancelled;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StatusNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminReservationController extends Controller
{
  public function index(Request $request)
    {
                $today = Carbon::today();

                $query = Reservation::with(['room', 'user'])
                    ->whereDate('check_out', '>=', $today)
                    ->whereNull('deleted_at')
                    ->where('is_parent', false);

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

                $rooms = Room::with('roomType')
                            ->where('is_booked', false)
                            ->get();

                $groupedReservations = Reservation::with(['room', 'user', 'children'])
                    ->where('is_parent', true)
                    ->whereDate('check_out', '>=', $today)
                    ->whereNull('deleted_at')
                    ->paginate(10);

                $pastReservations = Reservation::with('room')
                    ->onlyTrashed()
                    ->orWhereDate('check_out', '<', $today)
                    ->paginate(10);

                $reservations = $query->get();

                $parentReservations = Reservation::where('is_parent', 1)
                    ->whereDate('check_out', '>=', now()->toDateString())
                    ->paginate(10);
                    

                $currentReservations = Reservation::where('is_parent', 0)
                    ->whereDate('check_out', '>=', now()->toDateString())
                    ->paginate(10);

                return view('admin.reservations.index', compact(
                    'reservations',
                    'rooms',
                    'pastReservations',
                    'groupedReservations',
                    'parentReservations',
                    'currentReservations'
                ));
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

        // Release room if assigned
        if ($reservation->room_id) {
            $room = Room::find($reservation->room_id);
            if ($room) {
                $room->is_booked = false;
                $room->save();
            }
        }

        $reservation->delete();

        return redirect()->route('admin.reservations.index')
                         ->with('success', 'Reservation deleted successfully.');
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
        //  dd($request->all());
        $reservation = Reservation::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,checked_out',
            'reason' => 'nullable|string|max:255',
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        DB::transaction(function () use ($request, $reservation) {
            $oldStatus = $reservation->status; // get BEFORE changing
            $reservation->status = $request->status;

            if ($request->status === 'confirmed' && $request->filled('room_id')) {
                // If already assigned, free old room
                if ($reservation->room_id) {
                    $oldRoom = Room::find($reservation->room_id);
                    if ($oldRoom) {
                        $oldRoom->is_booked = false;
                        $oldRoom->save();
                    }
                }

                // Assign new room
                $reservation->room_id = $request->room_id;
                $room = Room::find($request->room_id);
                $room->is_booked = true;
                $room->save();

                // Notify user
                if ($reservation->user) {
                    $reservation->user->notify(new StatusNotification(
                        'Room Assigned',
                        'Your reservation has been confirmed and room '.$room->name.' has been assigned to you.',
                        route('user.reservations.show', $reservation->id)
                    ));
                }
            }

            elseif ($request->status === 'cancelled') {
                $reservation->reason = $request->reason;

                if ($reservation->room_id) {
                    $room = Room::find($reservation->room_id);
                    if ($room) {
                        $room->is_booked = false;
                        $room->save();
                    }
                    $reservation->room_id = null; // optional: clear assignment
                }
            }

            $reservation->save();
        });

        return back()->with('success', 'Reservation status updated.');
    }

     public function createGroupReservation(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|array|min:1',
            'rooms.*.type' => 'required|string',
            'rooms.*.guests' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $parentReservation = Reservation::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'is_parent' => true,
                'status' => 'pending',
                'user_id' => auth()->id()
            ]);

            foreach ($request->rooms as $room) {
                Reservation::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    'room_type' => $room['type'],
                    'guests' => $room['guests'],
                    'parent_id' => $parentReservation->id,
                    'status' => 'pending',
                    'user_id' => auth()->id()
                ]);
            }
        });

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Group reservation created successfully!');
    }

    public function availableRooms($type)
    {
        try {
            $decodedType = urldecode($type);

            $typeValue = DB::table('filter_options')
                ->join('filters', 'filter_options.filter_id', '=', 'filters.id')
                ->where('filters.slug', 'room-type')
                ->where('filter_options.label', $decodedType)
                ->value('filter_options.value');

            if (!$typeValue) {
                return response()->json([
                    'message' => 'Invalid room type',
                    'rooms' => []
                ], 200);
            }

            $rooms = Room::where('room_type', $typeValue)
                        ->where('is_booked', false)
                        ->get(['id', 'room_name', 'room_type']);

            return response()->json([
                'message' => $rooms->isEmpty() ? 'No available rooms found' : 'Rooms found',
                'rooms' => $rooms
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function assignRoom(Request $request, Reservation $reservation)
    {
        if ($request->has('room_id')) {
            $request->validate(['room_id' => 'required|exists:rooms,id']);

            $room = Room::find($request->room_id);
            $room->is_booked = true;
            $room->save();

            $reservation->room_id = $room->id;
            $reservation->status = 'confirmed';
        }

        if ($request->has('reason')) {
            $reservation->status = 'cancelled';
            $reservation->cancellation_reason = $request->reason;
        }

        $reservation->save();

        return back()->with('success', 'Reservation updated.');
    }
}