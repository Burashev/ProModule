<?php
declare(strict_types=1);

use App\Http\Controllers\Admin\ModulesController;
use App\Http\Controllers\Admin\UsersController;
use Domains\Shared\Enums\RolesEnum;
use Illuminate\Support\Facades\Route;

$adminRoleId = RolesEnum::ADMINISTRATOR_ID->value;

Route::middleware("roles:{$adminRoleId}")
    ->prefix('/admin')
    ->name('admin.')
    ->group(function () {
        Route::redirect('/', '/admin/users');

        Route::prefix('/users')
            ->group(function () {
                Route::get('/', [UsersController::class, 'index'])
                    ->name('users');

                Route::get('/create', [UsersController::class, 'create'])
                    ->name('users.create');

                Route::post('/create', [UsersController::class, 'createPost'])
                    ->name('users.createPost');

                Route::post('/{user:id}/activate', [UsersController::class, 'activatePost'])
                    ->name('users.activatePost');

                Route::delete('/{user:id}', [UsersController::class, 'delete'])
                    ->name('users.delete');
            });

        Route::prefix('/modules')
            ->group(function () {
                Route::get('/', [ModulesController::class, 'index'])
                    ->name('modules');

                Route::get('/create', [ModulesController::class, 'create'])
                    ->name('modules.create');

                Route::post('/create', [ModulesController::class, 'createPost'])
                    ->name('modules.createPost');

                Route::delete('/{module:id}', [ModulesController::class, 'delete'])
                    ->name('modules.delete');
            });


    });
