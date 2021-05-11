<?php

namespace Drobinetm\LaravelRedis\Http\Middleware;

use Drobinetm\LaravelRedis\Http\Services\LaravelRedisSecurityService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class LaravelRedisVerifySignature
{
    /**
     * The Laravel Redis Security Service object.
     *
     * @var LaravelRedisSecurityService
     */
    protected $laravelRedisSecurityService;

    /**
     * LaravelRedisController constructor
     **/
    public function __construct()
    {
        $this->laravelRedisSecurityService = new LaravelRedisSecurityService();
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        $sigHeader = $request->header('Laravel-Redis-Signature');
        if (!isset($sigHeader))
        {
            throw new Exception('The Laravel-Redis-Signature header is required!!!');
        }

        $isValid = $this->laravelRedisSecurityService->isSignatureValid($sigHeader);
        if (!$isValid)
        {
            throw new Exception('The Laravel-Redis-Signature header is invalid!!!');
        }

        return $next($request);
    }
}
