<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager,coach,player'
])->prefix('profile')
    ->name('profile.')
    ->group(function () {

        Route::get('/', [
            ProfileController::class,
            'index'
        ])->name('index');

        Route::put('/', [
            ProfileController::class,
            'update'
        ])->name('update');

        Route::put('/password', [
            ProfileController::class,
            'updatePassword'
        ])->middleware('throttle:5,1')
            ->name('password');

        Route::post('/photo', [
            ProfileController::class,
            'updatePhoto'
        ])->middleware('throttle:10,1')
            ->name('photo.update');

        Route::get('/photo', [
            ProfileController::class,
            'photo'
        ])->name('photo.show');

        Route::delete('/photo', [
            ProfileController::class,
            'destroyPhoto'
        ])->name('photo.destroy');

    });
