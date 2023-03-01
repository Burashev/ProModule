<?php

namespace App\Providers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with(
                'menu',
                (new Menu())
                    ->addItem(new MenuItem("Главная", route("home")))
                    ->addItem(new MenuItem("Каталог", route("catalog")))
                    ->addItem(new MenuItem("Вход", route("login")))
            );
        });
    }
}
