<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;
use Config;
use App;

class Languages
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
        if ($request->session()->has('locale')){
            App::setLocale($request->session()->get('locale'));
        } else {
            App::setLocale(Config::get('app.locale'));
        }
        return $next($request);
    }
}
