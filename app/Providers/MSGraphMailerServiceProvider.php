<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MSGraph\MSGraphMailerTransport;

class MSGraphMailerServiceProvider extends ServiceProvider
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
        $this->app->get('mail.manager')->extend('msgraph', function (array $config) {
            if (!isset($config['client']) || !isset($config['secret']) || !isset($config['transport'])) {
                return new static('The mail.php configuration is missing from address, transport, client and/or secret key configuration');
            }

            return new MSGraphMailerTransport();
        });
    }
}
