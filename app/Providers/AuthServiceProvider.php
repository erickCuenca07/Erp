<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Admin\Users\Domain\Model\UserModel;
use Admin\User\Infrastructure\Entrypoint\Http\Policies\UserPolicy;
use Admin\Permissions\Infrastructure\Entrypoint\Http\Policies\PermissionsPolicy;
use Admin\Permissions\Domain\Model\PermissionsModel;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        UserModel::class => UserPolicy::class,
        PermissionsModel::class => PermissionsPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('SuperAdmin') ? true : null;
        });
    }
}
