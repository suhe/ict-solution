<?php

namespace App\Modules\PaymentMethod\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'payment-method');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'payment-method');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'payment-method');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
