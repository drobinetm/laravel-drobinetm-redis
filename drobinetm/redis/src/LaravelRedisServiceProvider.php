<?php

namespace Drobinetm\Redis;

use Illuminate\Support\ServiceProvider;

class LaravelRedisServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Routes
        include __DIR__ . '/routes/route.php';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
