<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            dd(auth()->guard("website_student")->check());
            if(auth()->guard("website_student")->check()){
                return route('courses_website');
            }else{
                return route('login_website');
            }
        // if ($request->is('website') || $request->is('website/*')) {
        //     return route('login_website');
        // }
        // else{
        //     return route('dashlogin');
        // }
    }
    }
}
