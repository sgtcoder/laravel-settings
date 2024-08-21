<?php

namespace SgtCoder\LaravelSettings;

use Illuminate\Support\ServiceProvider;

// https://laravel.com/docs/10.x/packages
class LaravelSettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/settings.php' => config_path('settings.php'),
        ], 'laravel-settings');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {}
}
