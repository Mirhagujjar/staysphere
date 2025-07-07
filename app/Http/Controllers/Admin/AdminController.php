<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\ServiceRequest;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function dashboard()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Please log in.');
        }

        $totalRooms = Room::count();
        $reservations = Reservation::all();
        $typeWiseCounts = Room::select('room_type', DB::raw('COUNT(*) as total'))
            ->groupBy('room_type')
            ->get();
        $rooms = Room::all();
        $totalServiceRequests = ServiceRequest::count();

        if ($user->role === 'super_admin') {
            return view('admin.includes.super', compact(
                'totalRooms',
                'reservations',
                'typeWiseCounts',
                'rooms',
                'totalServiceRequests'  
            ));
        }

        return view('admin.dashboard', compact(
            'totalRooms',
            'reservations',
            'typeWiseCounts',
            'rooms',
            'totalServiceRequests'
        ));
    }




    public function create()
    {
        return view('admin.rooms.create');
    }

    
}
