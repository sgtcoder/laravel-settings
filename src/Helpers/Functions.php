<?php

use SgtCoder\LaravelSettings\LaravelSettings;

if (!function_exists('get_setting')) {
    function get_setting($group, $setting = NULL)
    {
        $settings = LaravelSettings::getSettings($group, $setting);

        return $settings;
    }
}

if (!function_exists('get_settings')) {
    function get_settings($group, $setting = NULL)
    {
        $settings = LaravelSettings::getSettings($group, $setting);

        return $settings;
    }
}

if (!function_exists('save_setting')) {
    function save_setting($group, $key, $value)
    {
        LaravelSettings::saveSetting($group, $key, $value);
    }
}

if (!function_exists('save_settings')) {
    function save_settings($group, $setting)
    {
        LaravelSettings::saveSettings($group, $setting);
    }
}
