<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
class RoomsController extends Controller
{
    public function index() {
        return view('rooms');
    }
    public function showRooms()
    {
        return view('rooms'); // Ensure 'resources/views/rooms.blade.php' exists
    }
}
