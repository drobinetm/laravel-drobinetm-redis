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

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/2021_05_08_133134_create_laravel_redis_securities_table.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Middleware
        $this->app->make('Drobinetm\Redis\Http\Middleware\LaravelRedisVerifySignature');

        // Controller
        $this->app->make('Drobinetm\Redis\Http\Controllers\LaravelRedisController');
     }
}
