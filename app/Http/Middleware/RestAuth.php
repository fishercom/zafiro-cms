<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Config;
use Log;

class RestAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Log::info($request->bearerToken());
        //Log::info(Config::get('auth.api_token'));

        if ($request->bearerToken()!==Config::get('auth.api_token')) {
            abort(403, 'Unauthorized token.');
        }

        return $next($request);
    }
}
