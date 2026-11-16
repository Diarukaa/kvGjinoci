<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;

use App\Http\Middleware\RoleMiddleware;

Route::middleware([

    'auth',

    RoleMiddleware::class
    . ':admin,manager,coach,player'

])->prefix('profile')

    ->name('profile.')

    ->group(function () {

        // PROFILI PERSONAL

        Route::get('/', [

            ProfileController::class,

            'index'

        ])->name('index');

        Route::put('/', [

            ProfileController::class,

            'update'

        ])->middleware('throttle:5,1')

            ->name('update');

        // PASSWORD

        Route::put('/password', [

            ProfileController::class,

            'updatePassword'

        ])->middleware('throttle:5,1')

            ->name('password');

        // PROFILE PHOTO

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

        // ACTIVE SESSIONS

        Route::get('/sessions', [

            SessionController::class,

            'index'

        ])->name('sessions.index');

        // LOGOUT ALL OTHER DEVICES

        Route::delete('/sessions/others', [

            SessionController::class,

            'destroyOthers'

        ])->middleware('throttle:5,1')

            ->name('sessions.destroyOthers');

        // LOGOUT SPECIFIC DEVICE

        Route::delete('/sessions/{device}', [

            SessionController::class,

            'destroy'

        ])->where('device', '[a-f0-9]{64}')

            ->middleware('throttle:5,1')

            ->name('sessions.destroy');

    });
