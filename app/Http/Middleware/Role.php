<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()){//if logged
            if(auth()->user()->role =="manager" || auth()->user()->role =="admin" ){// the user role is manager or admin
                return $next($request);
            }else{// the user role is user
                return redirect()->route("home");
            }
        }else{//if not logged
            return redirect()->route("home");
        }

    }
}
