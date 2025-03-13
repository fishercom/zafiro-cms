<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\UrlGenerator;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if(config('app.env') === 'development' || config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        //
        ini_set('memory_limit', '256M');
        date_default_timezone_set(config('app.timezone'));
        setlocale(LC_TIME, config('app.locale'));
        Carbon::setLocale(config('app.locale'));
        //

        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        Validator::extend('captcha', 'App\Rules\ReCaptcha@passes');

        if (app()->environment('production')) {
            $url->forceScheme('https');
        }
    }
}
