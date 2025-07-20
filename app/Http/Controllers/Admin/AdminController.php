<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\ServiceRequest;
use App\Models\Facility;
use App\Models\User;

use App\Models\Notification;

class AdminController extends Controller
{
   public function dashboard()
    {
        $user = Auth::user(); 
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

    // In AdminLoginController.php
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if user is admin/super_admin
            if (!in_array($user->role, ['admin', 'super_admin'])) {
                Auth::logout(); // Log out if not admin
                return redirect()->route('admin.login')
                    ->with('error', 'You do not have admin access');
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->route('admin.login')
            ->with('error', 'Invalid credentials');
    }


     public function banAdmin(User $admin)
    {
        // Verify current user is super admin
        if (Auth::user()->role !== 'super_admin') {
            return back()->with('error', 'Only super admins can perform this action.');
        }

        // Prevent banning self or other super admins
        if ($admin->id === Auth::id()) {
            return back()->with('error', 'You cannot ban yourself.');
        }

        if ($admin->role === 'super_admin') {
            return back()->with('error', 'Cannot ban other super admins.');
        }

        // Only allow banning admins (not regular users)
        if ($admin->role !== 'admin') {
            return back()->with('error', 'You can only ban admin users.');
        }

        $admin->update(['is_banned' => true]);
        return back()->with('success', 'Admin has been banned successfully.');
    }

    /**
     * Unban an admin (accessible only to super admin)
     */
    public function unbanAdmin(User $admin)
    {
        // Verify current user is super admin
        if (Auth::user()->role !== 'super_admin') {
            return back()->with('error', 'Only super admins can perform this action.');
        }

        // Only allow unbanning admins (not regular users)
        if ($admin->role !== 'admin') {
            return back()->with('error', 'You can only unban admin users.');
        }

        $admin->update(['is_banned' => false]);
        return back()->with('success', 'Admin has been unbanned successfully.');
    }

    /**
     * Toggle admin ban status (accessible only to super admin)
     */
    public function toggleAdminBan(User $admin)
    {
        // Verify current user is super admin
        if (Auth::user()->role !== 'super_admin') {
            return back()->with('error', 'Only super admins can perform this action.');
        }

        // Prevent toggling ban on self or other super admins
        if ($admin->id === Auth::id()) {
            return back()->with('error', 'You cannot modify your own status.');
        }

        if ($admin->role === 'super_admin') {
            return back()->with('error', 'Cannot modify other super admins.');
        }

        // Only allow toggling for admins
        if ($admin->role !== 'admin') {
            return back()->with('error', 'You can only modify admin users.');
        }

        $admin->is_banned = !$admin->is_banned;
        $admin->save();

        $status = $admin->is_banned ? 'banned' : 'unbanned';
        return back()->with('success', "Admin has been $status successfully.");
    }

    
}
