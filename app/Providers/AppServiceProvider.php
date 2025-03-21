<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // ✅ Import Schema
use Illuminate\Support\Facades\View; // ✅ Import View
use App\Models\Reservation;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // ✅ Check if the 'reservations' table exists before querying
        if (Schema::hasTable('reservations')) {
            View::composer('admin.includes.sidebar', function ($view) {
                $view->with('reservations', Reservation::all());
            });
        }
    }
}
