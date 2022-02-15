<?php

namespace App\Http\Middleware;

use Closure;
class basic 
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
        if (auth()->user() &&  (auth()->user()->isAdmin == 'admin' || auth()->user()->is_student==2 ||
        auth()->user()->category_id == 1)) {
        return $next($request);
    }
    return redirect()->back();
    }
}
