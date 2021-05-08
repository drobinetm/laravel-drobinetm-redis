<?php

namespace Drobinetm\Redis\Models;

use Illuminate\Database\Eloquent\Model;

class LaravelRedisSecurity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clientId', 'clientSecret', 'token',
    ];
}
