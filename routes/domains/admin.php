<?php
declare(strict_types=1);

use App\Http\Controllers\Admin\UsersController;
use Domains\Shared\Enums\RolesEnum;
use Illuminate\Support\Facades\Route;

$adminRoleId = RolesEnum::ADMINISTRATOR_ID->value;

Route::middleware("roles:{$adminRoleId}")
    ->prefix('/admin')
    ->name('admin.')
    ->group(function () {
        Route::redirect('/', '/admin/users');

        Route::get('/users', [UsersController::class, 'index'])
            ->name('users');

        Route::get('/users/create', [UsersController::class, 'create'])
            ->name('users.create');

        Route::post('/users/create', [UsersController::class, 'createPost'])
            ->name('users.createPost');

        Route::post('/users/{user:id}/activate', [UsersController::class, 'activatePost'])
            ->name('users.activatePost');

        Route::delete('/users/{user:id}', [UsersController::class, 'delete'])
            ->name('users.delete');
    });
