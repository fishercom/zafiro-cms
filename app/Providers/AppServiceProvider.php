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
    public function boot()
    {
        Validator::extend('captcha', 'App\Rules\ReCaptcha@passes');

        setlocale(LC_TIME, config('app.locale'));
        date_default_timezone_set(config('app.timezone'));
        //Carbon::setUTF8(true);
        //Carbon::setLocale(config('app.locale'));

        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
    }
}
