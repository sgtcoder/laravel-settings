<?php

namespace SgtCoder\LaravelSettings\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group', 'name', 'locked', 'payload',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'date:m/d/Y',
        'updated_at' => 'date:m/d/Y',
        'payload' => 'array',
    ];
}
