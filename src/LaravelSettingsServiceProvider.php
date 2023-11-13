<?php

namespace SgtCoder\LaravelSettings;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSettingsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('laravel-settings');

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Config
        $this->publishes([
            __DIR__ . '/../config/laravel-settings.php' => config_path('laravel-settings.php'),
        ], 'laravel-settings');
    }
}
