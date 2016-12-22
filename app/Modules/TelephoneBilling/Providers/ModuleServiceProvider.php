<?php

namespace App\Modules\TelephoneBilling\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'telephone-billing');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'telephone-billing');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'telephone-billing');
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
