<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\MSGraph\Facades\MSGraph;

class MSGraphAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (MSGraph::getTokenData() === null) {
            return MSGraph::connect();
        }

        return $next($request);
    }
}
