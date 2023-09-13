<?php

namespace App\Providers;

use App\Actions\Fortify\AuthenticationUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ((request()->is('instructor/*'))) {
            Config::set('fortify.prefix', 'instructor');
            Config::set('fortify.guard', 'instructor');
            Config::set('fortify.passwords', 'instructors');
            // Config::set('fortify.home', 'instructor/dashboard');
        } elseif (request()->is('admin/*')) {
            Config::set('fortify.prefix', 'admin');
            Config::set('fortify.guard', 'admin');
            Config::set('fortify.passwords', '');
            // Config::set('fortify.home', 'dashboard/admin');
        }

        // redirect
        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {
                if (Config::get('fortify.guard') == 'admin') {
                    return Redirect::intended('/admin/dashboard');
                } elseif (Config::get('fortify.guard') == 'instructor') {
                    return Redirect::intended('/instructor/dashboard');
                }
                return Redirect::intended('/');
            }
        });


        // $this->app->instance(LogoutResponse::class, new class implements LogoutResponse
        // {
        //     public function toResponse($request)
        //     {
        //         return redirect('/');
        //     }
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fortify::authenticateUsing([new AuthenticationUser(), 'authtication']);
        // if (($config = Config::get('fortify.guard')) == 'web') {
        // dd(Config::get('fortify.prefix'));
        //     Fortify::viewPrefix('auth.');
        // } elseif ($config == 'instructor') {
        //     Fortify::viewPrefix('auth.instructor.');
        // Fortify::viewPrefix('auth.');
        // } elseif ($config == 'admin') {
        //     Fortify::viewPrefix('auth.admin.');
        // }
        Fortify::viewPrefix('auth.');
        // Fortify::authenticateUsing();
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
