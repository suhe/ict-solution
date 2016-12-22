<?php

namespace App\Modules\UserGroup\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'user-group');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'user-group');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'user-group');
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
