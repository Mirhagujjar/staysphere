<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
class RoomController extends Controller
{
    public function index() {
        return view('home');
    }
    // public function index() {
    //     $rooms = Room::all();
    //     return view('rooms', compact('rooms'));
    // }

    // public function show($id) {
    //     $room = Room::findOrFail($id);
    //     return view('room_details', compact('room'));
    // }
}
