<?php

namespace App\Http\Middleware;

use Closure;

class LoaderMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('X-Loader', 'true'); // Agrega una cabecera personalizada al response

        return $response;
    }
}
