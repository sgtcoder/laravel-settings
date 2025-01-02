<?php

namespace SgtCoder\LaravelSettings\Models;

use Illuminate\Database\Eloquent\Model;

class SettingCollection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [];

    /**
     * The attributes that are guarded.
     *
     * @var list<string>
     */
    protected $guarded = [];
}
