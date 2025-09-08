<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
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
        Gate::define('is_admin', function (User $user) {
            return $user->role->role_name === 'Admin'
                ? Response::allow()
                : Response::denyAsNotFound();
        });

        Gate::define('is_rektor', function ($user) {
            return $user->role->role_name === 'Rektor'
                ? Response::allow()
                : Response::denyAsNotFound();
        });
        Gate::define('is_warek', function ($user) {
            return $user->role->role_name === 'Wakil Rektor I' || $user->role->role_name === 'Wakil Rektor II' || $user->role->role_name === 'Wakil Rektor III' || $user->role->role_name === 'Wakil Rektor IV'
                ? Response::allow()
                : Response::denyAsNotFound();
        });
        Gate::define('is_mahasiswa', function ($user) {
            return $user->role->role_name === 'Mahasiswa'
                ? Response::allow()
                : Response::denyAsNotFound();
        });
        Gate::define('is_adminOrRektor', function ($user) {
            return $user->role->role_name === 'Admin' || $user->role->role_name === 'Rektor'
                ? Response::allow()
                : Response::denyAsNotFound();
        });
        Gate::define('is_adminOrWarek', function ($user) {
            return $user->role->role_name === 'Admin' || $user->role->role_name === 'Wakil Rektor I' || $user->role->role_name === 'Wakil Rektor II' || $user->role->role_name === 'Wakil Rektor III' || $user->role->role_name === 'Wakil Rektor IV' || $user->role->role_name === 'Rektor'
                ? Response::allow()
                : Response::denyAsNotFound();
        });
        Gate::define('is_adminOrWarekOrRektor', function ($user) {
            return $user->role->role_name === 'Admin' || $user->role->role_name === 'Wakil Rektor I' || $user->role->role_name === 'Wakil Rektor II' || $user->role->role_name === 'Wakil Rektor III' || $user->role->role_name === 'Wakil Rektor IV' || $user->role->role_name === 'Rektor'
                ? Response::allow()
                : Response::denyAsNotFound();
        });
    }
}
