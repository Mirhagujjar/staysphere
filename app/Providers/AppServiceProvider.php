<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB; 


class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (Schema::hasTable('reservations')) {
            // Share latest reservations across all admin views
            View::composer('admin.*', function ($view) {
                $latestReservations = Reservation::with(['user', 'room'])
                    ->latest()
                    ->take(5)
                    ->get();

                $view->with('latestReservations', $latestReservations);
            });
        }

        if (Schema::hasTable('rooms')) {
            View::composer('admin.dashboard', function ($view) {
                $totalRooms = Room::count();
                $typeWiseCounts = Room::select('room_type', DB::raw('count(*) as total'))
                    ->groupBy('room_type')
                    ->get();

                $view->with([
                    'totalRooms' => $totalRooms,
                    'typeWiseCounts' => $typeWiseCounts,
                ]);
            });
        }
    }

}
