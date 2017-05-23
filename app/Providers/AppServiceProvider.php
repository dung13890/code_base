<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'dev') {
            $this->app->register(\Lord\Laroute\LarouteServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
        if (env('APP_ENV') === 'mongo') {
            $this->app->register(\Jenssegers\Mongodb\MongodbServiceProvider::class);
        }

        $this->app->bind(
            \App\Contracts\Services\PassportInterface::class,
            \App\Services\PassportService::class
        );
    }
}
