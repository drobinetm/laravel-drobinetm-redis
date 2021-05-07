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
        // Route
        $this->loadRoutesFrom(__DIR__ . '/routes/route.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Drobinetm\Redis\Http\Controllers\LaravelRedisController');
     }
}
