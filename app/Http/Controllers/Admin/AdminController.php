<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Room;
use App\Models\Reservation;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\Package;
use App\Models\Event;
use App\Models\Review;
use App\Models\Blog;
use App\Models\ContactMessage; // use the model you actually have

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Please log in.');
        }

        // Totals
        $totalRooms            = Room::count();
        $totalReservations     = Reservation::count();
        $totalServiceRequests  = ServiceRequest::count();
        $totalUsers            = User::count();
        $totalPackages         = Package::count();
        $totalEvents           = Event::count();
        $totalReviews          = Review::count();
        $totalBlogs            = Blog::count();
        $totalContactMessages  = ContactMessage::count();

        // Room type stats
        $typeWiseCounts = Room::select('room_type', DB::raw('COUNT(*) as total'))
            ->groupBy('room_type')
            ->get();

        // Latest
        $latestReservations = Reservation::with(['user', 'room'])
            ->latest()
            ->take(5)
            ->get();

        $latestServiceRequests = ServiceRequest::latest()->take(5)->get();

        $viewData = compact(
            'totalRooms',
            'totalReservations',
            'totalServiceRequests',
            'totalUsers',
            'totalPackages',
            'totalEvents',
            'totalReviews',
            'totalBlogs',
            'totalContactMessages',
            'typeWiseCounts',
            'latestReservations',
            'latestServiceRequests'
        );

        // super admin vs normal admin view
        if ($user->role === 'super_admin') {
            return view('admin.includes.super', $viewData);
        }

        return view('admin.dashboard', $viewData);
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (!in_array($user->role, ['admin', 'super_admin'])) {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', 'You do not have admin access');
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->route('admin.login')->with('error', 'Invalid credentials');
    }
}
