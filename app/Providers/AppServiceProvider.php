<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    public function boot(): void
    {
        // --- TAMBAHAN BARU: Memaksa HTTPS jika environment adalah production ---
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        // ---------------------------------------------------------------------

        Gate::define('accessFilament', function ($user) {
            $allowed = array_filter(array_map('trim', explode(',', env('ADMIN_EMAILS', ''))));
            return in_array($user->email, $allowed, true);
        });
    }
}
