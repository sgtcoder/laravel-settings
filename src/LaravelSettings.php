<?php

namespace SgtCoder\LaravelSettings;

use SgtCoder\LaravelSettings\Models\{
    Setting,
    SettingCollection,
    SettingGroup
};

final class LaravelSettings
{
    /**
     * Holds Group
     */
    private $group;

    /**
     * Holds Settings
     */
    private $settings;

    /**
     * Holds Grouped
     */
    private $grouped = false;

    /**
     * Private Construct
     */
    private function __construct($group)
    {
        $this->group = $group;
        $this->settings = Setting::where('group', $group)->pluck('payload', 'name');
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
     * @return $this
     */
    public function grouped()
    {
        $this->grouped = true;
        return $this;
    }

    /**
     * Chained Get
     *
     * @return mixed
     */
    public function get($setting = null, $media = false)
    {
        $settings = $this->settings;
        $group = $this->group;
        $grouped = $this->grouped;

        if ($setting) {
            $settings = $settings[$setting] ?? null;

            if ($settings && $media) {
                // @phpstan-ignore-next-line
                $MediaService = (new \App\Services\MediaService);

                // @phpstan-ignore-next-line
                $media = \Plank\Mediable\Media::find($settings);

                // @phpstan-ignore-next-line
                $settings = $MediaService->get_signed_url($media);
            }
        } else {
            if ($media) {
                // @phpstan-ignore-next-line
                $MediaService = (new \App\Services\MediaService);

                foreach ($settings as $setting_key => $setting_value) {
                    if (str_contains($setting_key, '_media') && !is_array($setting_value)) {
                        // @phpstan-ignore-next-line
                        $media = \Plank\Mediable\Media::find($setting_value);

                        if ($media) {
                            // @phpstan-ignore-next-line
                            $settings[str_replace('_media', '_url', $setting_key)] = $MediaService->get_signed_url($media);
                        }
                    }
                }
            }

            $settings_collection = new SettingCollection;
            $settings_collection->fill($settings->toArray());
            $settings = $settings_collection;
        }

        if ($grouped) {
            $setting_group = new SettingGroup;
            $setting_group->setAttribute($group, $settings);

            $settings = $setting_group;
        }

        return $settings;
    }

    /**
     * Chained Replace
     *
     * @return $this
     */
    public function replace($replace_settings)
    {
        $settings = $this->settings;
        $group = $this->group;

        // Remove Old Settings
        $delete_settings = $settings->diffKeys($replace_settings);
        $this->delete($delete_settings);

        // Set New Settings
        $this->set($replace_settings);

        return $this;
    }

    /**
     * Chained Set
     *
     * @return $this
     */
    public function set($settings)
    {
        $group = $this->group;

        // Filter Nullables
        $settings = collect($settings)->map(function ($value, $key) {
            return $value === null ? '' : $value;
        });

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

        return $this;
    }

    /**
     * Chained Set Attribute
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        $this->set([$key => $value]);
        return $this;
    }

    /**
     * Chained Delete
     *
     * @return $this
     */
    public function delete($settings = [])
    {
        $group = $this->group;

        if (empty($settings)) {
            Setting::where('group', $group)->delete();
        } else {
            if (!is_array($settings)) $settings = [$settings];

            foreach ($settings as $key => $value) {
                Setting::where('group', $group)->where('name', $key)->delete();
            }
        }

        return $this;
    }
}
