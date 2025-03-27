<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //  Admin Dashboard (Shows Both Rooms & Reservations)
    public function dashboard()
    {
        $rooms = Room::all(); 
        $reservations = Reservation::all();

        return view('admin.dashboard', compact('rooms', 'reservations'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }
}
