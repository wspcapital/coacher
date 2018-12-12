<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckBlockedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$user = User::where('email', $request->email)->first();
        /*if ($user->blocked == 1) {
            return redirect()->back()->with('blocked', trans('auth.blocked'));
        }*/

        return $next($request);
    }
}
