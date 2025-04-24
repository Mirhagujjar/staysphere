<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Reservation;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
       
        if (Schema::hasTable('reservations')) {
            View::composer('admin.includes.sidebar', function ($view) {
                $view->with('reservations', Reservation::all());
            });
        }
    }
}
