<?php

namespace SgtCoder\LaravelSettings;

use SgtCoder\LaravelSettings\Models\{
    Setting,
    SettingGroup
};

final class LaravelSettings
{
    /**
     * Holds Group
     */
    private static $group;

    /**
     * Holds Settings
     */
    private static $settings;

    /**
     * Holds Grouped
     */
    private static $grouped;

    /**
     * Private Construct
     */
    private function __construct($group)
    {
        self::$group = $group;
        self::$settings = Setting::where('group', $group)->pluck('payload', 'name');
    }

    /**
     * Global Function Instantiator
     *
     * @return static
     */
    public static function settings($group)
    {
        return new self($group);
    }

    /**
     * Chained Group
     *
     * @return static
     */
    public static function grouped()
    {
        self::$grouped = true;

        return new self(self::$group);
    }

    /**
     * Chained Get
     *
     * @return static
     */
    public static function get($setting = NULL, $media = false)
    {
        $settings = self::$settings;
        $group = self::$group;
        $grouped = self::$grouped;

        if ($setting) {
            $settings = $settings[$setting] ?? NULL;

            if ($settings && $media) {
                // @phpstan-ignore-next-line
                $MediaService = (new \App\Services\MediaService);

                // @phpstan-ignore-next-line
                $media = \Plank\Mediable\Media::find($settings);

                // @phpstan-ignore-next-line
                $settings = $MediaService->get_signed_url($media);
            }
        }

        if ($grouped) {
            $setting_group = new SettingGroup;
            $setting_group->setAttribute($group, $settings);

            $settings = $setting_group;
        }

        return $settings;
    }

    /**
     * Chained Get
     *
     * @return static
     */
    public static function replace($replace_settings)
    {
        $settings = self::$settings;
        $group = self::$group;

        // Remove Old Settings
        $delete_settings = $settings->diffKeys($replace_settings);
        self::delete($delete_settings);

        // Set New Settings
        self::set($replace_settings);

        return new self(self::$group);
    }

    /**
     * Chained Set
     *
     * @return  object
     */
    public static function set($settings)
    {
        $group = self::$group;

        // Update Individual Settings
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                [
                    'group' => $group,
                    'name' => $key,
                ],
                [
                    'locked' => false,
                    'payload' => $value,
                ]
            );
        }

        return new self(self::$group);
    }

    /**
     * Chained Set Attribute
     *
     * @return static
     */
    public static function setAttribute($key, $value)
    {
        self::set([$key => $value]);

        return new self(self::$group);
    }

    /**
     * Chained Delete
     *
     * @return static
     */
    public static function delete($settings = [])
    {
        $group = self::$group;

        if (empty($settings)) {
            Setting::where('group', $group)->delete();
        } else {
            if (!is_array($settings)) $settings = [$settings];

            foreach ($settings as $key => $value) {
                Setting::where('group', $group)->where('name', $key)->delete();
            }
        }

        return new self(self::$group);
    }
}
