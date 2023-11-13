<?php

namespace App\Http\Middleware;

use Closure;
class college 
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
        if (auth()->user() &&  (auth()->user()->isAdmin == 'admin' || auth()->user()->is_student==3 ||
     auth()->user()->category_id == 2)) {
        return $next($request);
    }
    return back();
    }
}
