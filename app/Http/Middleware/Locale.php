<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Lang;
use Session;

class Locale
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('locale')) {
            session()->put('locale', config('app.locale'));
        }
        App::setLocale(session()->get('locale'));

        return $next($request);
    }
}
