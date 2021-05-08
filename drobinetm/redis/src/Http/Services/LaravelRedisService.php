<?php

namespace Drobinetm\Redis\Http\Services;

use Illuminate\Support\Facades\Redis;

class LaravelRedisService
{
    public function __construct() {}

    /**
     * Access to info of the server redis
     **/
    public function infoServer()
    {
        return Redis::info();
    }

    /**
     * Get keys of the server redis
     *
     * @params string $pattern
     **/
    public function keys($pattern='*')
    {
        return Redis::keys($pattern);
    }

    /**
     * Read the Redis slow queries log
     *
     * @params int $n
     **/
    public function slowLogs($n = -1)
    {
        if ($n > 0) {
            return Redis::slowlog('GET', $n);
        }

        return Redis::slowlog('GET');
    }
}
