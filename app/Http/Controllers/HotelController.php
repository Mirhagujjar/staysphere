<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    
    public function index()
    {
        $hotel = Hotel::all(); // Fetch all records
        return view('hotel.index', compact('hotel'));
    }
   
   

    public function create()
    {
        return view('hotel.create');
    }

    public function store(Request $request)
    {
        // Validate input fields
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'phone' => 'required|string|max:15',
        //     'check_in' => 'required|date|after:today',
        //     'check_out' => 'required|date|after:check_in',
        //     'room_type' => 'required|string',
        //     'guests' => 'required|integer|min:1',
        // ]);

        // Store data in the database
        Hotel::create($request->all()
            // [
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'phone' => $request->phone,
            // 'check_in' => $request->check_in,
            // 'check_out' => $request->check_out,
            // 'room_type' => $request->room_type,
            // 'guests' => $request->guests,
        // ]
    );

        // Redirect with success message
        // return redirect()->route('hotel.create')->with('success', 'Room Booking successfully!');
       // return redirect()->back()->with('success', 'Room Booking successfully!');
        return redirect()->route('hotel.index')->with('success', 'Booking Successful!');

        // return redirect('/')->with('success', 'Booking successful!');

    }
            // return redirect('/')->with('success', 'Booking successful!');


      public function edit(Hotel $hotel)
            {
                return view('hotel.edit', compact('hotel'));
            }  
     // public function update(Request $request, Hotel $hotel)
            // {
            //     $hotel->update($request->all());
            //     return redirect()->route('hotel.index')->with('success', 'Booking Updated Successfully!');
            // }
      
     public function showRooms()
            {
                $hotel = Hotel::all(); // Sab booked rooms fetch karein
                return view('hotel.rooms', compact('hotel')); // Rooms ka view load karein
            }
                  
            
      public function update(Request $request, Hotel $hotel)
            {
                // $request->validate([
                //     'name' => 'required',
                //     'email' => 'required|email',
                //     'phone' => 'required',
                //     'check_in' => 'required|date',
                //     'check_out' => 'required|date',
                //     'room_type' => 'required',
                //     'guests' => 'required|integer'
                // ]);
                $hotel->update($request->all()); // Update Record

                return redirect()->route('hotel.index')->with('success', 'Booking Updated Successfully!');
            }
        
            // Delete Data
            public function destroy(Hotel $hotel)
            {
                $hotel->delete(); // Delete Record
                return redirect()->route('hotel.index')->with('success', 'Booking Deleted!');
            }          
}



