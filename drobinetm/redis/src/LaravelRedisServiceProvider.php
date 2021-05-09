<?php

namespace Drobinetm\Redis;

use Drobinetm\Redis\Console\Commands\LaravelRedisInstall;
use Drobinetm\Redis\Http\Middleware\LaravelRedisVerifySignature;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

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
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([LaravelRedisInstall::class,]);
        }

        // Middleware
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('laravel-redis-middleware', LaravelRedisVerifySignature::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Controller
        $this->app->make('Drobinetm\Redis\Http\Controllers\LaravelRedisController');
     }
}
