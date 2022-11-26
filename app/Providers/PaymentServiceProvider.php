<?php

namespace App\Providers;

use App\Registries\PaymentGatewayRegistry;
use App\Services\Payments\HipayDriver;
use App\Services\Payments\SubscriberDriver;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewayRegistry::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->app->make(PaymentGatewayRegistry::class)
            ->register('hipay', new HipayDriver(
                user: config('hipay.user'),
                password: config('hipay.password'),
                env: config('hipay.env')
            ))
            ->register('subscriber', new SubscriberDriver);
    }
}
