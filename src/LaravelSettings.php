<?php

namespace SgtCoder\LaravelSettings;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SgtCoder\LaravelSettings\Models\Setting;

class LaravelSettings
{
    public static function saveSettings($group, $settings)
    {
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                [
                    'group' => $group,
                    'name' => $key,
                ],
                [
                    'group' => $group,
                    'name' => $key,
                    'locked' => false,
                    'payload' => $value,
                ]
            );
        }
    }

    public static function saveSetting($group, $key, $value)
    {
        $this->saveSettings($group, [[$key => $value]]);
    }

    public static function getSettings($group, $setting = NULL)
    {
        $settings = Setting::where('group', $group)->pluck('payload', 'name');

        if ($setting) return $settings->$setting ?? NULL;

        return $settings;
    }
}
