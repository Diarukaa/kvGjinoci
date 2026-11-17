<?php

use App\Http\Controllers\MatchCenterController;
use App\Http\Controllers\MatchCenterOverviewController;
use App\Http\Middleware\ProtectExistingMatchResult;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach',
])
    ->prefix('match-center')
    ->name('match-center.')
    ->group(function () {

        // Lista me ndeshjet e vjetra dhe te reja

        Route::get(
            '/',
            [MatchCenterOverviewController::class, 'index']
        )->name('index');

        // Detajet e ndeshjes

        Route::get(
            '/{ndeshja}',
            [MatchCenterController::class, 'show']
        )->name('show');

        // Gjendja aktuale e LIVE

        Route::get(
            '/{ndeshja}/state',
            [MatchCenterController::class, 'state']
        )->name('state');

        // Regjistrimi manual
        // Mbrohen rezultatet e perfunduara me heret

        Route::post(
            '/{ndeshja}/manual',
            [MatchCenterController::class, 'manual']
        )
            ->middleware([
                ProtectExistingMatchResult::class,
                'throttle:20,1',
            ])
            ->name('manual');

        // Aktivizimi i LIVE
        // Nuk aktivizohet mbi nje ndeshje te perfunduar

        Route::post(
            '/{ndeshja}/start',
            [MatchCenterController::class, 'start']
        )
            ->middleware([
                ProtectExistingMatchResult::class,
                'throttle:10,1',
            ])
            ->name('start');

        Route::post(
            '/{ndeshja}/point',
            [MatchCenterController::class, 'point']
        )
            ->middleware('throttle:120,1')
            ->name('point');

        Route::post(
            '/{ndeshja}/undo',
            [MatchCenterController::class, 'undo']
        )
            ->middleware('throttle:30,1')
            ->name('undo');
    });
