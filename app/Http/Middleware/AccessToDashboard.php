<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessToDashboard
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
        if(auth()->check()){//the user is login
            if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2){ //role_id is 1 => Super Admin  OR role_id is 2 => Admin
                return $next($request);
            }else{// role_id is 3 => User
                return redirect()->route("profile",["id"=>auth()->id()]);
            }
        }else{//the user is not login
            return redirect()->route("login");
        }

    }
}
