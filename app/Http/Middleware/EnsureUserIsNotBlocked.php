<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EnsureUserIsNotBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle($request, Closure $next)
    {


        $user = Auth::user();
        $isBlock = false;
        if($user) {
            if (($user->role === "admin") && $user->admin->is_blocked) {
                $isBlock = true;
            }
            if (($user->role === "student") && $user->student->is_blocked) {
                $isBlock = true;
            }
            if (($user->role === "professor") && $user->professor->is_blocked) {
                $isBlock = true;
            }
            if ($isBlock) {
                return redirect(route('login'));
            }
        }
        return $next($request);
    }
}
