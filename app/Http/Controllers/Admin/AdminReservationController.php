<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomType;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\ReservationCancelled;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StatusNotification;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();

        // Fetch all parent reservations with children eager loaded
        $allGroups = Reservation::with(['room', 'user', 'children'])
            ->where('is_parent', true)
            ->whereDate('check_out', '>=', $today)
            ->whereNull('deleted_at')
            ->get();

        // Filter groups with 2 or more children (meaning 2+ rooms in group)
        $groupedReservations = $allGroups->filter(function ($group) {
            return $group->children->count() >= 2;
        });

        // Groups with only 1 child will be considered single reservations
        $singleChildGroups = $allGroups->filter(function ($group) {
            return $group->children->count() === 1;
        });

        // Extract the single reservations from those single-child groups
        $singleFromGroups = $singleChildGroups->map(function ($group) {
            return $group->children->first();
        });

        // Fetch single reservations that are not part of any group (no parent)
        $singleReservationsQuery = Reservation::with('room', 'user')
            ->where('is_parent', false)
            ->whereNull('parent_id')
            ->whereDate('check_out', '>=', $today)
            ->whereNull('deleted_at');

        if ($request->has('search')) {
            $search = $request->search;
            $singleReservationsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhere('room_type', 'like', "%$search%");
            });
        }

        $singleReservations = $singleReservationsQuery->get();

        // Merge single reservations from groups with single reservations
        $reservations = $singleReservations->merge($singleFromGroups);

        // The rest unchanged
        $rooms = Room::all();

        $pastReservations = Reservation::with('room')
            ->onlyTrashed()
            ->orWhereDate('check_out', '<', $today)
            ->paginate(10);

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
            'currentReservations',
            'singleReservations'
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
    $reservation = Reservation::findOrFail($id);

    $request->validate([
        'status' => 'required|string',
        'reason' => $request->status === 'cancelled' ? 'required|string' : 'nullable',
        'room_id' => $request->status === 'confirmed' ? 'required|exists:rooms,id' : 'nullable',
    ]);

    $reservation->status = $request->status;

    if ($request->status === 'cancelled') {
        $reservation->reason = $request->reason;
        $reservation->room_id = null; // clear any assigned room
    } elseif ($request->status === 'confirmed') {
        $reservation->room_id = $request->room_id;
        $reservation->reason = null; // clear reason if previously cancelled
    }

    $reservation->save();

    return redirect()->back()->with('success', 'Reservation updated successfully!');
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
                'user_id' => Auth::id()
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
                    'user_id' => Auth::id()
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
             ->whereColumn('booked_quantity', '<', 'total_quantity')
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

    // public function assignRoom(Request $request, Reservation $reservation)
    // {
    //     if ($request->has('room_id')) {
    //         $request->validate(['room_id' => 'required|exists:rooms,id']);

    //         $room = Room::find($request->room_id);
    //         $room->is_booked = true;
    //         $room->save();

    //         $reservation->room_id = $room->id;
    //         $reservation->status = 'confirmed';
    //     }

    //     if ($request->has('reason')) {
    //         $reservation->status = 'cancelled';
    //         $reservation->cancellation_reason = $request->reason;
    //     }

    //     $reservation->save();

    //     return back()->with('success', 'Reservation updated.');
    // }

    
    // public function cancel(Request $request, $id)
    // {
    //     $reservation = Reservation::findOrFail($id);

    //     $reservation->status = 'cancelled';
    //     $reservation->reason = $request->reason; // save reason
    //     $reservation->save();

    //     return redirect()->back()->with('success', 'Reservation cancelled with reason saved.');
    // }



    // public function groupDetail($id)
    // {
    //     $group = Reservation::with('children')->findOrFail($id);
    //     // pass $group to a view for showing group details
    //     return view('admin.reservations.groupdetail', compact('group'));
    // }

    // AdminReservationController.php
    public function invoice($id)
    {
        $reservation = Reservation::with(['room', 'services'])
            ->findOrFail($id);

        return view('admin.reservations.invoice', compact('reservation'));
    }

    public function downloadInvoice($id)
    {
        $reservation = Reservation::with('services', 'room')
            ->findOrFail($id);

        $roomTotal = $reservation->room->price ?? 0;
        $servicesTotal = $reservation->services->sum('price');
        $total = $roomTotal + $servicesTotal;

        $pdf = Pdf::loadView('admin.reservations.invoice_pdf', [
            'reservation' => $reservation,
            'roomTotal' => $roomTotal,
            'servicesTotal' => $servicesTotal,
            'total' => $total,
        ]);

        return $pdf->download('invoice_' . $reservation->id . '.pdf');
    }


}