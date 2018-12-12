<?php

namespace App\Http\Middleware;

use App\Models\User,
    Closure,
    Illuminate\Support\Facades\Auth;

class LocalizationMiddleware
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
        if (Auth::check()) {
            $lang = Auth::user()->lang;
        } else {
            $browser_lang = preg_replace('/[-].+$/', '', \Request::server('HTTP_ACCEPT_LANGUAGE'));
            if (preg_match('/^(en|fr|nl|)$/', $browser_lang)) {
                $lang = $browser_lang;
            } else {
                $lang = 'en';
            }
        }
        app()->setLocale($lang);
        return $next($request);
    }
}
