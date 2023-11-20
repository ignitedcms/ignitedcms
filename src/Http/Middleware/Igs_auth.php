<?php

/*
|---------------------------------------------------------------
| Auth middleware for system
|---------------------------------------------------------------
|
| Custom middleware for auth
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Igs_auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check if logged in

        if (session('logged_in') == 1) {
            //echo 'good';
        } else {
            return redirect('login');
        }

        return $next($request);
    }
}
