<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelAbout; // Import the missing model

class HotelController extends Controller
{
    public function home()
    {
       return view('hotel.home'); // Ensure file exists in resources/views/hotel/home.blade.php
    }

    // Show all hotel bookings
    public function index()  
    {
        $hotels = Hotel::all(); // Fetch all hotel records
        return view('hotel.index', compact('hotels'));
    }

    // Show the form for creating a new booking
    public function create()  
    {
        return view('hotel.create');
    }

    // Store a new hotel booking
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
        Hotel::create($request->all());

        // Redirect with success message
        return redirect()->route('hotel.index')->with('success', 'Booking Successful!');
    }

    // Show the form for editing a booking
    public function edit(Hotel $hotel)  
    {
        return view('hotel.edit', compact('hotel'));
    }

    // Update the booking details
    public function update(Request $request, Hotel $hotel)
    {
        // Validate the updated fields
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'phone' => 'required|string|max:15',
        //     'check_in' => 'required|date|after:today',
        //     'check_out' => 'required|date|after:check_in',
        //     'room_type' => 'required|string',
        //     'guests' => 'required|integer|min:1',
        // ]);

        // Update the record
        $hotel->update($request->all());

        return redirect()->route('hotel.index')->with('success', 'Booking Updated Successfully!');
    }

    // Delete a booking
    public function destroy(Hotel $hotel)  
    { 
        $hotel->delete(); // Delete the record
        return redirect()->route('hotel.index')->with('success', 'Booking Deleted!');
    }

    // Show rooms
    public function showRooms()
    {
        $hotel = Hotel::all(); // Fetch all hotel bookings or rooms
        return view('hotel.rooms', compact('rooms'));  // Return view with rooms
    }
    public function showRoomDetails($id)
    {
        $room = Hotel::findOrFail($id);
        return view('hotel.room_details', compact('room'));
    }

    // Show About Us page
    public function aboutUs()  
    {
        $aboutSections = HotelAbout::all();
        return view('hotel.aboutUs', compact('aboutSections'));
    }

    // Show a detailed About Us section
    public function detailaboutUs($id)
    {
        $about = HotelAbout::findOrFail($id);
        return view('hotel.detailaboutUs', compact('about'));
    }

    public function show($id)
{
    $hotel = Hotel::findOrFail($id);  
    return view('hotel.show', compact('hotel'));  
}


   

}
