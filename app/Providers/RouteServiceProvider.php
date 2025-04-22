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
    public function boot()
    {
<<<<<<< HEAD
        // parent::boot();
=======
>>>>>>> 0900f7dc8239da7e6e9291a57244a77ed138bc85

    
        Route::middleware('web')
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/web.php'));
    
        Route::middleware('web')
            ->prefix('user')
            ->name('user.')
            ->group(base_path('routes/web.php'));
    }

}
