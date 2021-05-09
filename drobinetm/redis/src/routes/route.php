<?php

use Drobinetm\Redis\Http\Controllers\LaravelRedisController;
use Illuminate\Support\Facades\Route;


Route::middleware('laravel-redis-middleware')->prefix('redis')->group(function () {
    Route::get('/', [LaravelRedisController::class, 'info']);
    Route::get('info', [LaravelRedisController::class, 'info']);
    Route::get('keys', [LaravelRedisController::class, 'keys']);
    Route::get('slow-log', [LaravelRedisController::class, 'slowLog']);
});
