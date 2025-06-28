<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureJsonRequest
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->hasHeader('Accept') || $request->header('Accept') !== 'application/json') {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
