<?php

namespace App\Http\Middleware;
use Closure;

class IsAdmin
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

        if ($request->user() && $request->user()->hasAnyRole("Administrators")) {
            return $next($request);
        } else {
           //return response("Permissions denied", 401);
           return abort(401, "Permissions denied");
        }
    }
}
