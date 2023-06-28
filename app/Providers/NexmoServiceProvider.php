<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Nexmo\Client;

class NexmoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client([
                'api_key' => config('nexmo.api_key'),
                'api_secret' => config('nexmo.api_secret'),
            ]);
        });
    }
}
