<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RequesterData
{
    // /**
    //  * Get the path the user should be redirected to when they are not authenticated.
    //  */
    // public function handle(Request $request, Closure $next): ?string
    // {
    // 	// dd("middleware test");
    //     return $request->has('conf') ? $next($request) : "Redirect to login";
    // }

    public function handle($request, Closure $next)
    {
        if ($request->has('age') & $request->age > 18) {
            return $next($request);
        }

        return redirect()->route('login'); // Example: redirect to login page
    }

}
