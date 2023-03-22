<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

//use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::define('is_admin',function(User $user){
            return $user->role_id==1;
        });
        
        Gate::define('is_reg_cordinator', function(User $user){
            return $user->role_id==2|| $user->role_id==1;
        });

        Gate::define('is_hoc', function(User $user){
            return $user->role_id==3 || $user->role_id==1 ;
        });
    
}
}