<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('nav_btn', function ($user){
            if($user->name_roles == 'user'){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('admin', function($user){
            if ($user->name_roles == 'admin') {
                return true;
            } else {
                return false;
            }
        });
        
        Gate::define('client_inte', function($user){
            if($user->name_roles == 'user'){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('admin_manager_staff', function($user){
            if($user->name_roles == 'user'){
                return false;
            }else{
                return true;
            }
        });
        
        Gate::define('admin_manager', function($user){
            if($user->name_roles == 'admin'){
                return true;
            }elseif($user->name_roles == 'manager'){
                return true;
            }else{
                return false;
            }
        });
    }
}
