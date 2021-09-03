<?php
use Titanium6\LaravelSettings\LaravelSettings;

if(!function_exists('get_setting')){
    function get_setting($group, $setting){
        $setting = LaravelSettings::getSetting($group, $setting);

        return $setting;
    }
}