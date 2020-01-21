<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        If (env('APP_ENV') !== 'local') {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }

        // if ($this->app->environment() === 'production') {
        //     \URL::forceScheme('https');
        //     $this->app['request']->server->set('HTTPS', true);
        // } else {
        //     \URL::forceScheme('http');
        //     $this->app['request']->server->set('HTTPS', false);
        // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
