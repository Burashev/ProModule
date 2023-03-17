<?php
declare(strict_types=1);

use App\Http\Controllers\Module\ModuleController;
use Illuminate\Support\Facades\Route;

$expertRoleId = \Domains\Shared\Enums\RolesEnum::EXPERT_ID->value;
$administratorRoleId = \Domains\Shared\Enums\RolesEnum::ADMINISTRATOR_ID->value;

Route::middleware("roles:{$expertRoleId},{$administratorRoleId}")->group(function () {
    Route::get('/module/create', [ModuleController::class, 'create'])
        ->name('module.create');

    Route::post('/module/create', [ModuleController::class, 'createPost'])
        ->name('module.createPost');
});

Route::get('/module/{module:slug}', [ModuleController::class, 'index'])
    ->name('module');

