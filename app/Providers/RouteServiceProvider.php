<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // parent::boot();
        Route::middleware('web')
            ->group(function () {
                require base_path('routes/faiza.php');
                require base_path('routes/fozia.php');
                require base_path('routes/sidra.php');
            });
    }

}
