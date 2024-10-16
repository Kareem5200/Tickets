<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Employee;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->type=="admin" && $user->status=="active";
        });
        Gate::define('driver',function($user){
            return $user->type=="driver" && $user->status=="active";
        });
        Gate::define('data_entry',function($user){
            return $user->type=="data_entry" && $user->status=="active";
        });
        Gate::define('allowed_user',function($user){
                return $user->status=="allowed";
        });
        Gate::define('panned_user',function($user){
            return $user->status=="panned";
        });





    }
}
