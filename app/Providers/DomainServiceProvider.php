<?php

namespace App\Providers;

use Domains\Catalog\Providers\CatalogServiceProvider;
use Domains\Shared\Providers\SharedServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->register(SharedServiceProvider::class);
        app()->register(CatalogServiceProvider::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
