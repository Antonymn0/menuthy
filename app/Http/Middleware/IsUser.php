<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
class IsUser
{
   /**
     * redirect user if he is admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == 'user') {
            return $next($request);
        }
        return Inertia::render('Errors/401');
        
    }
}
