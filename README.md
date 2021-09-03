# Titanium6 Laravel Settings #

A simple way to manage your settings.

## Install ##
- Add to your composer.json
```
"require": {
    "titanium-6/laravel-settings": "1.*"
}

"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/titanium-6/laravel-settings.git"
    }
]
```
- Then Run
```
composer update
```

## Configuration ##
- Publish Migration
```
php artisan vendor:publish --provider="Titanium6\LaravelSettings\LaravelSettingsServiceProvider" --tag="migrations"

php artisan migrate
```

- Publish Config - Not Used Currently
```
php artisan vendor:publish --provider="Titanium6\LaravelSettings\LaravelSettingsServiceProvider" --tag="settings"
```

## Usage ##

- Save Settings
```php
use Titanium6\LaravelSettings\LaravelSettings;

LaravelSettings::saveSettings('group_name', request('group_name'));
```

- Get Settings
```php
use Titanium6\LaravelSettings\LaravelSettings;

$settings = ['group_name'=>LaravelSettings::getSettings('group_name')];
```

- Get Single Setting
```php
get_setting('group_name', 'setting_name');
```