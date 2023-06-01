<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage-users', function($user){
            return $user->hasAnyRole(['auteur', 'admin']);
        });

        Gate::define('edit-users', function($user){
            return $user->hasAnyRole(['auteur', 'admin']);
        });

        Gate::define('delete-users', function($user){
            return $user->isAdmin();
        });
    }
}
