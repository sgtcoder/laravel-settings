<?php

namespace SgtCoder\LaravelSettings\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SgtCoder\LaravelSettings\LaravelSettings
 */
class LaravelSettings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \SgtCoder\LaravelSettings\LaravelSettings::class;
    }
}
