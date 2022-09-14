<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Mailer\GoogleMailerTransport;

class GoogleMailerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->get('mail.manager')->extend('google', function (array $config) {
            if (!isset($config['transport'])) {
                return new static('The mail.php configuration is missing from address, transport, client and/or secret key configuration');
            }

            return new GoogleMailerTransport($config);
        });
    }
}
