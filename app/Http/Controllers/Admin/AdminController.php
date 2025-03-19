<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        $rooms = Room::all(); // Fetch all rooms from the database
    
        return view('admin.dashboard', compact('rooms')); // Pass it to the view
    }

    // Create Room Page
    public function create()
    {
        return view('admin.rooms.create');
    }
}
