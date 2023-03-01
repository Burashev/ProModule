<?php
declare(strict_types=1);

use App\Http\Controllers\Catalog\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/catalog', [CatalogController::class, 'index'])
    ->name('catalog');
