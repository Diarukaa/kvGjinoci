<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin'
])->prefix('activity')
    ->name('activity.')
    ->group(function () {

        Route::get('/', [
            ActivityLogController::class,
            'index'
        ])->name('index');

        Route::get('/{activityLog}', [
            ActivityLogController::class,
            'show'
        ])->name('show');

    });
