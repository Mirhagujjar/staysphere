<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Reservation;
class ReservationController extends Controller
{
      // Show reservation form
      public function reservationform()
      {
          return view('reservations.reservation');
      }
  
      // Show all reservations
      public function index()
      {
          $reservation = Reservation::all();
          return view('reservations.reservations_list', compact('reservation'));
      }
  
      // Show reservation details
      public function show($id)
      {
          $reservation = Reservation::findOrFail($id);
          return view('reservations.show', compact('reservation'));
      }
  
      // Edit reservation
      public function edit($id)
      {
          $reservation = Reservation::findOrFail($id);
          return view('reservations.edit', compact('reservation'));
      }
  
      // Update reservation
      public function update(Request $request, $id)
      {
          $reservation = Reservation::findOrFail($id);
          $reservation->update($request->all());
          return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
      }
  
      // Delete reservation
      public function destroy($id)
      {
          $reservation = Reservation::findOrFail($id);
          $reservation->delete();
          return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
      }
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email',
        //     'phone' => 'required',
        //     'check_in' => 'required|date',
        //     'check_out' => 'required|date|after:check_in',
        //     'room_type' => 'required|string',
        //     'guests' => 'required|integer|min:1',
        // ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully');
    }
}
