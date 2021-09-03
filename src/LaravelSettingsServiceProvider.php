<?php

namespace Titanium6\LaravelSettings;

use Illuminate\Support\ServiceProvider;

// https://laravel.com/docs/8.x/packages
// https://darkghosthunter.medium.com/composer-using-your-own-local-package-2b252670d429
class LaravelSettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/settings.php' => config_path('settings.php'),
            ], 'settings');

            if (!class_exists('CreateSettingsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_settings_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_settings_table.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__.'/Helpers.php';
    }
}