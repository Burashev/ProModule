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
                    ->addItemIf(auth()->check(), new MenuItem("Каталог", route("catalog")))
                    ->addItemIf(auth()->guest(), new MenuItem("Вход", route("login")))
            );
        });
    }
}
