<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminReservationController extends Controller
{

//    public function index()
//     {
//         $reservations = Reservation::with('room')->get();
        
//         // Debug output - remove after testing
//         foreach ($reservations as $res) {
//             if ($res->room) {
//                 $path = 'storage/'.$res->room->image;
//                 logger()->info('Image Path:', [
//                     'db_value' => $res->room->image,
//                     'full_path' => public_path($path),
//                     'exists' => file_exists(public_path($path)),
//                     'url' => asset($path)
//                 ]);
//             }
//         }
        
//         return view('admin.reservations.index', compact('reservations'));
//     }


    // public function index()
    // {
    //     $today = Carbon::today();

    //     $reservations = Reservation::with('room')
    //         ->whereDate('check_out', '>=', $today)
    //         ->whereNull('deleted_at')
    //         ->get();

    //     return view('admin.reservations.index', compact('reservations'));
    // }

    public function index(Request $request)
    {
        $today = Carbon::today();

        // Start query builder with conditions
        $query = Reservation::with('room')
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

        // Execute the query
        $reservations = $query->get();

        return view('admin.reservations.index', compact('reservations'));
    }



    
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.edit', compact('reservation'));
    }

   public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'room_type' => $request->room_type,
            'guests' => $request->guests,
            // status will remain unchanged unless you want to include it here
        ]);

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
        $today = \Carbon\Carbon::today();

        $pastReservations = Reservation::with('room')
            ->onlyTrashed() // if soft-deleted
            ->orWhereDate('check_out', '<', $today) // OR expired
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
        $reservation->status = $request->status;
        $reservation->save();

        return back()->with('success', 'Reservation status updated successfully.');
    }

}
