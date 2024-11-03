<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if (Auth::user()->Role !== 'U') {
                return redirect('/Admin/dashboard'); // or any other redirection
            }
        } else {
            return redirect('/'); // or any other redirection
        }

        return $next($request);
    }
}
