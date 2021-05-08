<?php

namespace Drobinetm\Redis\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Drobinetm\Redis\Http\Services\LaravelRedisService;
use Illuminate\Http\JsonResponse;

class LaravelRedisController extends Controller
{
    protected $laravelRedisService;

    /**
     * LaravelRedisController constructor
     *
     * @params LaravelRedisService $laravelRedisService
     *
     **/
    public function __construct(LaravelRedisService $laravelRedisService)
    {
        $this->laravelRedisService = $laravelRedisService;
    }

    /**
     * Get info from server redis
     **/
    public function info()
    {
        $info = $this->laravelRedisService->infoServer();
        return response()->json($info, JsonResponse::HTTP_OK);
    }

    /**
     * Get keys from server redis
     **/
    public function keys()
    {
        $keys = $this->laravelRedisService->keys();
        return response()->json($keys, JsonResponse::HTTP_OK);
    }

    /**
     * Get slow queries log
     **/
    public function slowLog()
    {
        $logs = $this->laravelRedisService->slowLogs();
        return response()->json($logs, JsonResponse::HTTP_OK);
    }
}
