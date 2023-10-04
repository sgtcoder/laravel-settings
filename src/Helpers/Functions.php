<?php

use SgtCoder\LaravelSettings\LaravelSettings;

if (!function_exists('settings')) {
    function settings($group = 'general')
    {
        $settings = LaravelSettings::settings($group);

        return $settings;
    }
}
