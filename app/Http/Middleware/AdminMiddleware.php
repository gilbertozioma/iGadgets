<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user's role is not '1' (not an admin)
        if (!Auth::user()->role_as == '1') {

            // Redirect the user to the '/home' route with an error message
            return redirect('/home')->with('status', 'Access Denied. As you are not Admin');
        }

        // If the user is an admin, proceed with the request as usual
        return $next($request);
    }
}
