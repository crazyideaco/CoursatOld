<?php

namespace App\Http\Middleware;

use Closure;
class lecture 
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
        if (auth()->user() &&  auth()->user()->isAdmin == 'admin' || auth()->user()->is_student==4 ||
     auth()->user()->category_id == 3 ) {
        return $next($request);
    }
    return redirect()->back();
    }
}
