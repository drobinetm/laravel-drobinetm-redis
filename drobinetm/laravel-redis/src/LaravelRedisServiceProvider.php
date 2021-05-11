<?php

namespace Drobinetm\LaravelRedis;

use Drobinetm\LaravelRedis\Console\Commands\LaravelRedisInstall;
use Drobinetm\LaravelRedis\Http\Middleware\LaravelRedisVerifySignature;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LaravelRedisServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     * @throws BindingResolutionException
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
     * @throws BindingResolutionException
     */
    public function register()
    {
        // Controller
        $this->app->make('Drobinetm\LaravelRedis\Http\Controllers\LaravelRedisController');
     }
}
