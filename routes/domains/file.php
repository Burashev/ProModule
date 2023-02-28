<?php
declare(strict_types=1);

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/file/{file_link:uuid}', [FileController::class, 'file'])
    ->name('file.download');
