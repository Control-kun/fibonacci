<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ApiAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function handle($request, Closure $next)
    {
        if ('Bearer ' . \Config::get('app.api_token') != $request->header('Authorization')) {
            return response('Unauthenticated', 401);
        }

        return $next($request);
    }
}
