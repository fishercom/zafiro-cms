<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

use App\Http\Middleware\MSGraphAuthenticated;
use App\Services\MSGraph\MSGraph;

class MSGraphServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        // Register the service the package provides.
        $this->app->singleton('MSGraph', function ($app) {
            return new MSGraph;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        //
        $this->registerMiddleware($router);
    }

    public function registerMiddleware($router)
    {
        $router->aliasMiddleware('MSGraphAuthenticated', MSGraphAuthenticated::class);
    }
}
