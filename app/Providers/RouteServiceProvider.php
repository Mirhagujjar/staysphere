<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    // public function boot()
    // {
    //     Route::middleware('web')
    //         ->prefix('admin')
    //         ->name('admin.')
    //         ->group(base_path('routes/web.php'));

    //     Route::middleware('web')
    //         ->prefix('user')
    //         ->name('user.')
    //         ->group(base_path('routes/web.php'));
    // }
    public function boot(): void
    {
        // Just group them under the 'web' middleware
        Route::middleware('web')
            ->group(function () {
                require base_path('routes/faiza.php');
                require base_path('routes/fozia.php');
                require base_path('routes/sidra.php');
            });
    }

}
