<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RequestsLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('Incoming request:');
        Log::info($request);
        return $next($request);
    }

    /**
     * Handle an outgiong request.
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function terminate(Request $request, JsonResponse $response)
    {
        Log::info('Outgoing response:');
        Log::info($response->getStatusCode());
        Log::info($response->getContent());
    }
}
