<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ApiAuthenticate extends Middleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */

    public function handle($request, Closure $next, ...$guards)
    {
        if ('Bearer ' . \Config::get('app.api_token') != $request->header('Authorization')) {
            return response('Unauthenticated', 401);
        }

        return $next($request);
    }
}
