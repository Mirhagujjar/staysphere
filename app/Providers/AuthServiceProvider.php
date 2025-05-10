<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [

    ];

    public function boot(): void
    {
       

        $this->registerPolicies();

        Gate::define('access-admin', function ($user) {
            return in_array($user->role, ['admin', 'super_admin']);
        });
    
        Gate::define('access-super-admin', function ($user) {
            return $user->role === 'super_admin';
        });
    }
}
