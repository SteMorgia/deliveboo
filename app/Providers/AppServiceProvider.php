<?php

namespace App\Providers;

use Braintree\Gateway;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'n8xdwv2y7trywpsw',
                    'publicKey' => 'ms49ktfjtc9zq7r4',
                    'privateKey' => 'f3be8c1473550e15ca30b0f5458084b2'
                ]
            );
        });

        // $gateway = new \Braintree\Gateway([
        //     'environment' => 'sandbox',
        //     'merchantId' => 'n8xdwv2y7trywpsw',
        //     'publicKey' => 'ms49ktfjtc9zq7r4',
        //     'privateKey' => 'f3be8c1473550e15ca30b0f5458084b2'
        // ]);
    }
}

