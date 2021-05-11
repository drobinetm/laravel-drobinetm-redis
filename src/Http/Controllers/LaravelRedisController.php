<?php

namespace Drobinetm\LaravelRedis\Http\Controllers;

use App\Http\Controllers\Controller;
use Drobinetm\LaravelRedis\Http\Services\LaravelRedisService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function info(Request $request)
    {
        $section = $request->get('section') ?? '';

        $info = $this->laravelRedisService->infoServer($section);
        return response()->json($info, JsonResponse::HTTP_OK);
    }

    /**
     * Get keys from server redis
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function keys(Request $request)
    {
        $pattern = $request->get('pattern') ?? '*';

        $keys = $this->laravelRedisService->keys($pattern);
        return response()->json($keys, JsonResponse::HTTP_OK);
    }

    /**
     * Get slow queries log
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function slowLog(Request $request)
    {
        $argument = $request->get('argument') ?? -1;

        $logs = $this->laravelRedisService->slowLogs($argument);
        return response()->json($logs, JsonResponse::HTTP_OK);
    }
}
