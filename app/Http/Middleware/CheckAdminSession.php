<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminSession
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
        if (!\Session::has('admin')) {
            return \Redirect::route('admin.login.index');
        }
        return $next($request);
    }
}
