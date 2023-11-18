<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\User;


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
        //
        Paginator::useBootstrap();
        
        View::composer('*', function ($view) {
            $global_variable = User::select('users.name as name', 'roles.role as role', 'users.id as id', 'centers.name as center_name')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('centers', 'users.id', '=', 'centers.hod_id')
            ->get()
            ;
            $view->with('global_variable', $global_variable);
        });
    }
}