<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Braintree\Gateway; // importo il gateway;

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
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'ksqt4zkwdxxnp6qz',
                    'publicKey' => 'x644ydrhbbt2xdwm',
                    'privateKey' => '503a9b2e8c7db844d0ff77a995f48fcb'
                ]
            );
        });
    }
}
