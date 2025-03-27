<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{

    public function index()
    {
        $reservations = Reservation::with('user', 'room')->get();
        return view('admin.reservations.index', compact('reservations'));

    }
    
    

    // ✅ Show Single Reservation
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    // ✅ Edit Reservation
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.edit', compact('reservation'));
    }

    // ✅ Update Reservation
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        // ✅ Validation (Ensure `room_type` Exists in Database)
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

        $reservation->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'room_type' => $request->room_type,
            'guests' => $request->guests,
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully!');
    }
}
