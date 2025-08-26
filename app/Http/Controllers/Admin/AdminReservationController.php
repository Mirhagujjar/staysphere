<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\NotificationHelper;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();

        // Fetch all parent reservations with children
        $allGroups = Reservation::with(['room', 'children'])
            ->where('is_parent', true)
            ->whereNull('deleted_at')
            ->whereDate('check_out', '>=', $today)
            ->get();

        // Groups with 2+ children
        $groupedReservations = $allGroups->filter(fn($group) => $group->children->count() >= 2);

        // Single reservations from groups with only 1 child
        $singleFromGroups = $allGroups->filter(fn($group) => $group->children->count() === 1)
            ->map(fn($group) => $group->children->first());

        // Standalone single reservations
        $singleReservationsQuery = Reservation::with('room')
            ->where('is_parent', false)
            ->whereNull('parent_id')
            ->whereNull('deleted_at')
            ->whereDate('check_out', '>=', $today);

        if ($request->filled('search')) {
            $search = $request->search;
            $singleReservationsQuery->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%")
                ->orWhere('room_type', 'like', "%$search%");
            });
        }

        $singleReservations = $singleReservationsQuery->get();

        // Merge: single from groups + standalone singles
        $reservations = $singleReservations->merge($singleFromGroups);

        // Past reservations (history)
        $pastReservations = Reservation::with('room')
            ->where(function($q) use ($today) {
                $q->onlyTrashed()
                ->orWhereDate('check_out', '<', $today);
            })
            ->get();

        // Available rooms for assigning
        $availableRooms = Room::whereIn('status', ['active', 'draft'])
            ->whereColumn('booked_quantity', '<', 'total_quantity')
            ->get();

        return view('admin.reservations.index', compact(
            'groupedReservations',
            'reservations',
            'pastReservations',
            'availableRooms'
        ));
    }


    public function show($id)
    {
        $reservation = Reservation::with('room', 'children')->findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $data = $request->only(['name','email','phone','check_in','check_out','room_type','guests']);
        if($request->has('status')) {
            $data['status'] = $request->status;
        }

        $reservation->update($data);

        return redirect()->route('admin.reservations.index')->with('success','Reservation updated successfully!');
    }

     public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if($reservation->room_id) {
            $room = Room::find($reservation->room_id);
            if($room) {
                $room->is_booked = false;
                $room->save();
            }
        }

        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success','Reservation deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $request->validate([
            'status' => 'required|string',
            // 'reason' => $request->status === 'cancelled' ? 'required|string' : 'nullable',
            // 'room_id' => $request->status === 'confirmed' ? 'required|exists:rooms,id' : 'nullable',
        ]);

        $reservation->status = $request->status;

        if ($request->status === 'cancelled') {
            $reservation->reason = $request->reason;
            $reservation->room_id = null;
        } elseif ($request->status === 'confirmed') {
            $reservation->room_id = $request->room_id;
            $reservation->reason = null;
        }

        $reservation->save();

        // Send notification to user (optional)
        NotificationHelper::sendNotificationWithPayload('u-'.$reservation->user_id, "Booking Status Update", "Your booking is now ".$request->status);

        return redirect()->back()->with('success','Reservation updated successfully!');
    }

    public function availableRooms($type)
    {
        try {
            $decodedType = urldecode($type);

            $rooms = Room::where('room_type', $decodedType)
                ->whereColumn('booked_quantity','<','total_quantity')
                ->get(['id','room_name','room_type']);

            return response()->json([
                'message' => $rooms->isEmpty() ? 'No available rooms found' : 'Rooms found',
                'rooms' => $rooms
            ]);
        } catch(\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function showGrouped($id)
    {
        $group = Reservation::with(['children.room'])->findOrFail($id);

        return view('admin.reservations.grouped-reservations', compact('group'));
    }


    public function invoice($id)
    {
        $reservation = Reservation::with(['room','services'])->findOrFail($id);
        return view('admin.reservations.invoice', compact('reservation'));
    }

    public function downloadInvoice($id)
    {
        $reservation = Reservation::with(['room','services'])->findOrFail($id);

        $roomTotal = $reservation->room->price ?? 0;
        $servicesTotal = $reservation->services->sum('price');
        $total = $roomTotal + $servicesTotal;

        $pdf = Pdf::loadView('admin.reservations.invoice_pdf', [
            'reservation' => $reservation,
            'roomTotal' => $roomTotal,
            'servicesTotal' => $servicesTotal,
            'total' => $total
        ]);

        return $pdf->download('invoice_'.$reservation->id.'.pdf');
    }
}
