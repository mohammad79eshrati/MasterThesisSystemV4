<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsOwner
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
        if(!Auth::check()){
            return redirect(route('login'));
        }
        if ( Auth::user()->role !== 'admin'){
            return redirect()->back();
        }
        if (!Auth::user()->admin->is_owner){
            return redirect()->back();

        }
        return $next($request);
    }
}
