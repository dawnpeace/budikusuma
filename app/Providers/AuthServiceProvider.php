<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\enums\Type;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-verified', function($user) {
            return !is_null($user->is_verified);
        });

        Gate::define('access-common-page', function($user) {
            return $user->type == Type::COMMON;
        });

        Gate::define('access-admin-page', function($user) {
            return $user->type = Type::ADMIN;
        });
    }
}
