<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormacionController;
use App\Http\Controllers\FormacionPrintController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach',
])
    ->prefix('formacionet')
    ->name('formacionet.')
    ->group(function () {

        // LISTA E NDESHJEVE

        Route::get(
            '/',
            [
                FormacionController::class,
                'lista',
            ]
        )->name('lista');

        // PRINTIMI I TE GJITHA SETEVE

        Route::get(
            '/ndeshja/{ndeshja}/print',
            [
                FormacionPrintController::class,
                'index',
            ]
        )->name('print');

        // FORMACIONI INTERAKTIV

        Route::get(
            '/ndeshja/{ndeshja}',
            [
                FormacionController::class,
                'index',
            ]
        )->name('index');

        // RUAJTJA E FORMACIONIT

        Route::post(
            '/ndeshja/{ndeshja}',
            [
                FormacionController::class,
                'store',
            ]
        )
            ->middleware('throttle:30,1')
            ->name('store');

        // KOPJIMI NGA NJE SET NE TJETRIN

        Route::post(
            '/ndeshja/{ndeshja}/kopjo',
            [
                FormacionController::class,
                'kopjo',
            ]
        )
            ->middleware('throttle:20,1')
            ->name('kopjo');
    });
