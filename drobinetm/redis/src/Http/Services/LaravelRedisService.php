<?php

namespace Drobinetm\Redis\Http\Services;

use Illuminate\Support\Facades\Redis;

class LaravelRedisService
{
    public function __construct() {}

    /**
     * Access to info of the server redis
     * **/
    public function infoServer()
    {
        return Redis::info();
    }
}
