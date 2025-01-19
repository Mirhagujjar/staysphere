<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
class RoomsController extends Controller
{
    // public function index() {
    //     return view('rooms');
    // }
    public function showRooms()
    {
        return view('rooms'); // Ensure 'resources/views/rooms.blade.php' exists
    }
    public function index() {
        $rooms = Rooms::all();
        return view('rooms', compact('rooms'));
    }
    public function showRoom() {
        $rooms = Room::all(); // Assuming you have a Room model and data in your database
        return view('rooms', compact('rooms'));
    }
    
}
