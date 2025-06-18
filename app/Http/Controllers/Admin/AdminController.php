<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        if (!$user) {
            // Optionally redirect to login or show an error
            return redirect()->route('admin.login')->with('error', 'Please log in to access the admin dashboard.');
        }
    
        if ($user->role === 'super_admin') {
            return view('admin.includes.super'); // Super admin view
        }
    
        // Regular admin
        $rooms = Room::all(); 
        $reservations = Reservation::all();
        
        return view('admin.dashboard', compact('rooms', 'reservations'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }
}
