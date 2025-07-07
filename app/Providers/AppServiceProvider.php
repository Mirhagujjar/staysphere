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
            View::composer('admin.includes.sidebar', function ($view) {
                $view->with('reservations', Reservation::all());
            });
        }

         View::composer('admin.dashboard', function ($view) {
            $totalRooms = Room::count();
            $typeWiseCounts = Room::select('room_type', DB::raw('count(*) as total'))
                ->groupBy('room_type')
                ->get();

            $view->with('totalRooms', $totalRooms)
                ->with('typeWiseCounts', $typeWiseCounts);
        });

    }
}
