<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin',function($user){
            return $user->tipe === "admin";
        });

        Gate::define('isSuper',function($user){
            return $user->tipe === "super";
        });

        Gate::define('isUser',function($user){
            return $user->tipe === "user";
        });
        Gate::define('isAdminOrSuper',function($user){
            if ($user->tipe === 'super' || $user->tipe === 'admin') {
                return true;
            }
        });
        Passport::routes();
    }
}
