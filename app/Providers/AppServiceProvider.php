<?php

namespace App\Providers;



use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


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
        // Администратор может управлять товарами
        Gate::define('manage-products', function (User $user) {
            return $user->role === 'admin';
        });

        // Создатель может делать вообще всё
        Gate::define('manage-all', function (User $user) {
            return $user->role === 'creator';
        });

        Paginator::defaultView('pagination::default');
    }
}
