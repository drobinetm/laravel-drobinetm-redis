<?php

namespace Drobinetm\LaravelRedis\Http\Services;

use Illuminate\Support\Facades\Redis;

class LaravelRedisService
{
    public function __construct() {}

    /**
     * Access to info of the server redis
     *
     * @return mixed
     */
    public function infoServer()
    {
        return Redis::info();
    }

    /**
     * Get keys of the server redis
     *
     * @params string $pattern
     * @param string $pattern
     * @return mixed
     */
    public function keys(string $pattern='*')
    {
        return Redis::keys($pattern);
    }

    /**
     * Read the Redis slow queries log
     *
     * @params int $n
     * @param int $n
     * @return mixed
     */
    public function slowLogs(int $n = -1)
    {
        if ($n > 0) {
            return Redis::slowlog('GET', $n);
        }

        return Redis::slowlog('GET');
    }
}
