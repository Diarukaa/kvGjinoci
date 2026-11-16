<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormacionController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach',
])
    ->prefix('formacionet')
    ->name('formacionet.')
    ->group(function () {

        Route::get(
            '/',
            [
                FormacionController::class,
                'lista',
            ]
        )->name('lista');

        Route::get(
            '/ndeshja/{ndeshja}',
            [
                FormacionController::class,
                'index',
            ]
        )->name('index');

        Route::post(
            '/ndeshja/{ndeshja}',
            [
                FormacionController::class,
                'store',
            ]
        )
            ->middleware('throttle:30,1')
            ->name('store');
    });
