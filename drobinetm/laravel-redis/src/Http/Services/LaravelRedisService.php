<?php

namespace Drobinetm\LaravelRedis\Http\Services;

use Predis\Client;

class LaravelRedisService
{
    protected $redis;

    public function __construct() {
        $this->redis = new Client();
    }

    /**
     * Access to info of the server redis
     *
     * @param string $section
     * @return array
     */
    public function infoServer(string $section='')
    {
        if (empty($section)) {
            return $this->redis->info();
        }

        return $this->redis->info($section);
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
        return $this->redis->keys($pattern);
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
            return $this->redis->slowlog('GET', $n);
        }

        return $this->redis->slowlog('GET');
    }
}
