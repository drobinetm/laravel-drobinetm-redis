<?php

namespace Drobinetm\Redis\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Drobinetm\Redis\Http\Services\LaravelRedisService;

class LaravelRedisController extends Controller
{
    protected $laravelRedisService;

    /**
     * LaravelRedisController constructor
     *
     * @params LaravelRedisService $laravelRedisService
     *
     * **/
    public function __construct(LaravelRedisService $laravelRedisService)
    {
        $this->laravelRedisService = $laravelRedisService;
    }

    /**
     * Get info from server redis
     * **/
    public function info()
    {
        $info = $this->laravelRedisService->infoServer();
        return response()->json($info);
    }
}
