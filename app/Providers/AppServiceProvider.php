<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Gate::before(function ( User $user, $ability) {
            if(!$user->isAdmin()){
                if($user->habilidades()->contains($ability)){
                    return true;
                }
                return false;
            }
            else{
                return true;
            }

        });
    }
}
