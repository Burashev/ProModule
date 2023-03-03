<?php
declare(strict_types=1);

use App\Http\Controllers\Module\ModuleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/module/{module:slug}', [ModuleController::class, 'index'])
        ->name('module');
});
