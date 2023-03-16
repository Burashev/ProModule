<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\ModulePolicy;
use Domains\Module\Models\Module;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Module::class => ModulePolicy::class
    ];

    public function boot(): void
    {
        //
    }
}
