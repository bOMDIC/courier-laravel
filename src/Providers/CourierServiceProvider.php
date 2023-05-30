<?php

namespace GoMore\LaravelCourier\Providers;

use GoMore\LaravelCourier\Courier;
use Illuminate\Support\ServiceProvider;

class CourierServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('Courier', fn () => new Courier());
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/courier.php', 'courier'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return string[]
     */
    public function providers(): array
    {
        return ['Courier'];
    }
}
