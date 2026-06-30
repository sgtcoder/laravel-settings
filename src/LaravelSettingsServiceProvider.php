<?php

namespace SgtCoder\LaravelSettings;

use Illuminate\Support\ServiceProvider;

class LaravelSettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-settings.php',
            'laravel-settings'
        );
    }

    public function boot(): void
    {
        if (! config('laravel-settings.ignore_migrations', false)) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        $this->publishes([
            __DIR__ . '/../config/settings.php' => config_path('settings.php'),
            __DIR__ . '/../config/laravel-settings.php' => config_path('laravel-settings.php'),
        ], 'laravel-settings');
    }
}
