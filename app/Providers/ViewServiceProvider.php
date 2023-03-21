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
        View::composer('layouts.*', function (\Illuminate\View\View $view) {
            $user = auth()->user();

            $view->with(
                'menu',
                (new Menu())
                    ->addItem(new MenuItem("Главная", route("home")))
                    ->addItemIf(auth()->check(), new MenuItem("Каталог", route("catalog")))
                    ->addItemIf(
                        $user?->role_id->isAdministrator() || $user?->role_id->isExpert(),
                        new MenuItem("Создание модуля", route("module.create"))
                    )
                    ->addItemIf(auth()->guest(), new MenuItem("Вход", route("login")))
            );
        });

        View::composer('layouts.admin', function (\Illuminate\View\View $view) {
            $view->with(
                'adminMenu',
                (new Menu())
                    ->addItem(new MenuItem("Пользователи", route("admin.users")))
                    ->addItem(new MenuItem("Модули", route("admin.modules")))
            );
        });
    }
}
