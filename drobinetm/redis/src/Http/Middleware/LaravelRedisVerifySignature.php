<?php

namespace Drobinetm\Redis\Http\Middleware;

use Drobinetm\Redis\Http\Services\LaravelRedisSecurityService;
use Closure;
use Exception;

class LaravelRedisVerifySignature
{
    protected $laravelRedisSecurityService;

    /**
     * LaravelRedisController constructor
     *
     * @params LaravelRedisSecurityService $laravelRedisSecurityService
     *
     **/
    public function __construct(LaravelRedisSecurityService $laravelRedisSecurityService)
    {
        $this->laravelRedisSecurityService = $laravelRedisSecurityService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $sigHeader = $request->header('Laravel-Redis-Signature');
        if (!isset($sigHeader))
        {
            throw new Exception('El encabezado Laravel-Redis-Signature es requerido');
        }

        $isValid = $this->laravelRedisSecurityService->isSignatureValid($sigHeader);
        if ($isValid) {
            return $next($request);
        }
    }
}
