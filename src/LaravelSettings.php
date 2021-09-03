<?php

namespace Titanium6\LaravelSettings;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Titanium6\LaravelSettings\Models\Setting;

class LaravelSettings
{
    public static function saveSetting($group, $key, $value)
    {
        Setting::updateOrCreate(
            [
                'group'=>$group,
                'name'=>$key,
            ],
            [
                'group'=>$group,
                'name'=>$key,
                'locked'=>false,
                'payload'=>$value,
            ]
        );
    }

    public static function saveSettings($group, $settings)
    {
        foreach($settings as $key=>$value){
            Setting::updateOrCreate(
                [
                    'group'=>$group,
                    'name'=>$key,
                ],
                [
                    'group'=>$group,
                    'name'=>$key,
                    'locked'=>false,
                    'payload'=>$value,
                ]
            );
        }
    }

    public static function getSetting($group, $setting)
    {
        $settings = Setting::where('group', $group)->get()->pluck('payload', 'name')->toArray();
        return $settings[$setting] ?? NULL;
    }

    public static function getSettings($group)
    {
        $settings = Setting::where('group', $group)->get()->pluck('payload', 'name')->toArray();

        return $settings;
    }
}