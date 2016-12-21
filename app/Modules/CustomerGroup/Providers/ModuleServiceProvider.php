<?php

namespace App\Modules\CustomerGroup\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'customer-group');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'customer-group');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'customer-group');
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
