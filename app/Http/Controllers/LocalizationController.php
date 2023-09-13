<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocalizationController extends Controller
{
    public function changeLanguage(Request $request)
    {
        // $request->validate(['locale' => 'required|string|max:2|min:2']);
        // dd($request);
        // $locale = $request->query('locale');
        // if (array_key_exists($locale, config('app.locales'))) {
        // Session::put('locale', $locale);
        // LaravelLocalization::setLocale($locale);
        // LaravelLocalization::getLocalizedURL($locale);

        // Config::set('translatable.locale', $locale);
        // App::setLocale('en');
        // Config::set('app.locale', 'en');
        // dd($request->locale,$locale);
        // }
        // return back();
    }
}
