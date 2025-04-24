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

    public function boot()
    {
        // parent::boot();
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
