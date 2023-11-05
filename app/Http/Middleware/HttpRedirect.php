<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class HttpRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the client connected to the frontend (load balancer) via https
        // redirection is not necessary

        // if ($request->headers->has('X-Forwarded-Proto')) {
        //     if (strcmp($request->header('X-Forwarded-Proto'), 'https') === 0) {
        //         return $next($request);
        //     }
        // }

        if (!$request->secure()) {
            return redirect()->secure($request->getRequestUri(), 301);
    }
        return $next($request);
    }
}
