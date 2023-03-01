<?php

namespace Domains\Shared\Providers;

use Domains\Shared\Filters\FilterManager;
use Illuminate\Support\ServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FilterManager::class);
    }
}
