<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\NotificationController;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach,player'
])->prefix('njoftimet')
    ->name('njoftimet.')
    ->group(function () {

        Route::get('/', [
            NotificationController::class,
            'index'
        ])->name('index');

        Route::post('/lexo-krejt', [
            NotificationController::class,
            'lexoKrejt'
        ])->name('lexo-krejt');

        Route::post('/{id}/lexo', [
            NotificationController::class,
            'lexo'
        ])->name('lexo');

        Route::post('/{id}/hap', [
            NotificationController::class,
            'hap'
        ])->name('hap');

        Route::delete('/{id}', [
            NotificationController::class,
            'destroy'
        ])->name('destroy');
    });
