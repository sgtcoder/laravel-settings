<?php

if (!function_exists('settings')) {
    /**
     * Get the settings for the given group.
     *
     * @param string $group
     * @return \SgtCoder\LaravelSettings\LaravelSettings
     */
    function settings($group = 'general')
    {
        $settings = \SgtCoder\LaravelSettings\LaravelSettings::settings($group);

        return $settings;
    }
}
