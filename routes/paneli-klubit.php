<?php

use App\Http\Controllers\PaneliKlubitController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach',
])
    ->prefix('paneli-klubit')
    ->name('paneli-klubit.')
    ->group(function () {

        Route::get(
            '/',
            [PaneliKlubitController::class, 'index']
        )->name('index');

    });
