<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaportiController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach,player'
])->prefix('raportet')
    ->name('raportet.')
    ->group(function () {

        Route::get('/', [
            RaportiController::class,
            'index'
        ])->name('index');

        // RAPORTI FINANCIAR

        Route::get('/financiar', [
            RaportiController::class,
            'financiar'
        ])->middleware(
            RoleMiddleware::class . ':admin,manager'
        )->name('financiar');

        // RAPORTI I EKIPIT

        Route::get('/ekipi/{ekipi}', [
            RaportiController::class,
            'ekipi'
        ])->middleware(
            RoleMiddleware::class . ':admin,manager,coach'
        )->name('ekipi');

        // RAPORTI INDIVIDUAL

        Route::get('/lojtar/{lojtar}', [
            RaportiController::class,
            'lojtari'
        ])->name('lojtar');

        // RAPORTI I PREZENCES

        Route::get('/prezenca', [
            RaportiController::class,
            'prezenca'
        ])->name('prezenca');

    });
