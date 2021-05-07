<?php

use Drobinetm\Redis\Http\Controllers\LaravelRedisController;

Route::get('info', [LaravelRedisController::class, 'info']);
