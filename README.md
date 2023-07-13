# SgtCoder Laravel Settings #

A simple way to manage your settings.

## Install ##
- Add to your composer.json
```
"require": {
    "sgtcoder/laravel-settings": "1.*"
}

"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/sgtcoder/laravel-settings"
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
php artisan vendor:publish --provider="SgtCoder\LaravelSettings\LaravelSettingsServiceProvider" --tag="migrations"

php artisan migrate
```

## Usage ##
- Save Settings
```php
save_settings($group, $setting)
```

- Save Single Setting
```php
save_setting($group, $key, $value)
```

- Get Settings
```php
$settings = getSettings($group, $setting = NULL);
```