<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\PackageBooking;
use App\Models\UserEvent;
use App\Models\ServiceRequest;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /** ───── User Counts ───── */
        $totalBookings = Reservation::where('user_id', $user->id)->count();
        $totalPackages = PackageBooking::where('user_id', $user->id)->count();
        $totalServices = ServiceRequest::where('user_id', $user->id)->count();
        $totalEvents   = UserEvent::where('email', $user->email)->count(); 
        // 👆 If you add user_id in UserEvent later → switch to ->where('user_id',$user->id)

        /** ───── Booking Trend (last 6 months) ───── */
        $bookingData = Reservation::selectRaw("MONTH(created_at) as month, COUNT(*) as total")
            ->where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 6))->map(function ($i) {
            return now()->subMonths(6 - $i)->format('M');
        });

        $bookingMonths = $months->values();
        $bookingCounts = $months->map(function ($month) use ($bookingData) {
            $monthNum = date('n', strtotime($month));
            return $bookingData[$monthNum] ?? 0;
        });

        /** ───── Package Distribution ───── */
        // $packageTypes = ['Standard', 'Deluxe', 'Suite'];
        // $packageCounts = [
        //     PackageBooking::whereHas('package', fn($q) => $q->where('type', 'Standard'))
        //                   ->where('user_id', $user->id)->count(),
        //     PackageBooking::whereHas('package', fn($q) => $q->where('type', 'Deluxe'))
        //                   ->where('user_id', $user->id)->count(),
        //     PackageBooking::whereHas('package', fn($q) => $q->where('type', 'Suite'))
        //                   ->where('user_id', $user->id)->count(),
        // ];

        /** ───── Return to Dashboard View ───── */
        return view('user.dashboard', compact(
            'totalBookings',
            'totalPackages',
            'totalServices',
            'totalEvents',
            'bookingMonths',
            'bookingCounts',
            // 'packageTypes',
            // 'packageCounts'
        ));
    }
}
