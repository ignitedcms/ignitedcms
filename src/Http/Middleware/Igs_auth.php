<?php

/*
|---------------------------------------------------------------
| Auth middleware for system
|---------------------------------------------------------------
|
| Custom middleware for auth
| Note we are appending an argument
| This will refer to a permission_map the user has access to
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Middleware;

use Closure;
use Ignitedcms\Ignitedcms\Models\admin\Permissions;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Igs_auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $arg): Response
    {
        //check if use has permission access
        $pass = Permissions::permission_middleware($arg);

        //check if logged in
        if (session('logged_in') == 1) {
            if ($pass) {
                //can access
            }
            else {
               return redirect('login');
            }
        } else {
            return redirect('login');
        }

        return $next($request);
    }
}
