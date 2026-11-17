<?php

use App\Http\Controllers\NdeshjetV2Controller;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach',
])
    ->prefix('ndeshjet-v2')
    ->name('ndeshjet-v2.')
    ->group(function () {

        Route::get(
            '/',
            [NdeshjetV2Controller::class, 'index']
        )->name('index');

    });
