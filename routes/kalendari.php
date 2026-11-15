<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KalendariController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach,player'
])->prefix('kalendari')
    ->name('kalendari.')
    ->group(function () {

        Route::get('/', [
            KalendariController::class,
            'index'
        ])->name('index');

        Route::get('/events', [
            KalendariController::class,
            'events'
        ])->name('events');

    });
