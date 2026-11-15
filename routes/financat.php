<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\TransaksioniController;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin,manager'
])->prefix('financat')
    ->name('financat.')
    ->group(function () {

        // DASHBOARD FINANCIAR

        Route::get('/', [
            FinanceController::class,
            'index'
        ])->name('index');

        // KONTRATAT

        Route::post('/kontratat', [
            FinanceController::class,
            'storeKontrata'
        ])->name('kontratat.store');

        // PAGAT

        Route::post('/kontratat/{kontrata}/paga', [
            FinanceController::class,
            'gjeneroPagen'
        ])->name('paga.store');

        Route::put('/pagesat/{pagesa}/paguaj', [
            FinanceController::class,
            'paguaj'
        ])->name('pagesat.paguaj');

        Route::put('/pagesat/{pagesa}/anulo', [
            FinanceController::class,
            'anuloPagesen'
        ])->name('pagesat.anulo');

        // TE HYRAT DHE SHPENZIMET

        Route::get('/transaksionet', [
            TransaksioniController::class,
            'index'
        ])->name('transaksionet.index');

        Route::post('/transaksionet', [
            TransaksioniController::class,
            'store'
        ])->name('transaksionet.store');

        Route::get('/transaksionet/{transaksioni}/edit', [
            TransaksioniController::class,
            'edit'
        ])->name('transaksionet.edit');

        Route::put('/transaksionet/{transaksioni}', [
            TransaksioniController::class,
            'update'
        ])->name('transaksionet.update');

        Route::delete('/transaksionet/{transaksioni}', [
            TransaksioniController::class,
            'destroy'
        ])->name('transaksionet.destroy');

    });

// FINANCAT PERSONALE

Route::get('/financat-e-mia', [
    FinanceController::class,
    'financatEMia'
])->middleware([
    'auth',
    RoleMiddleware::class . ':coach,player,manager'
])->name('financat.mine');
