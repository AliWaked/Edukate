<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class SetAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $locale = request('locale', Cookie::get('locale', config('app.locale')));
        // $locale = request('locale', Session::get('locale', config('app.locale')));
        // url(URL::current(), ['locale' => $locale]);
        // Session::put('locale', $locale, 60 * 24 * 365);
        // App::setLocale($locale);
        // LaravelLocalization::setLocale($locale);
        // Route::prefix($locale);
        // LaravelLocalization::getLocalizedURL($locale);

        return $next($request);
    }
}
