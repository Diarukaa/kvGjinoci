<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Middleware\RoleMiddleware;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CoachDashboardController;
use App\Http\Controllers\CoachSportController;
use App\Http\Controllers\CoachTrainingController;
use App\Http\Controllers\CoachMatchController;
use App\Http\Controllers\CoachPerformanceController;
use App\Http\Controllers\PlayerDashboardController;
use App\Http\Controllers\TrajnerController;
use App\Http\Controllers\LojtarController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\EkipiController;
use App\Http\Controllers\NdeshjaController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\StatistikaLojtaritController;
use App\Http\Controllers\PlayerPerformanceController;
use App\Http\Controllers\SezoniController;
use App\Http\Controllers\KlubiController;
use App\Http\Controllers\KampionatiController;
use App\Http\Controllers\NdeshjaLigesController;
use App\Http\Controllers\NdeshjaLigaSyncController;
use App\Http\Controllers\StervitjaController;
use App\Http\Controllers\PrezencaController;
use App\Http\Controllers\UserController;

// FAQJA KRYESORE

Route::get('/', function () {
    return view('welcome');
});

// LOGIN

Route::middleware('guest')->group(function () {

    Route::get('/login', function () {

        return response()
            ->view('login')
            ->header(
                'Cache-Control',
                'no-store, no-cache, must-revalidate, max-age=0'
            )
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');

    })->name('login');

    Route::post('/login', function (Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (!in_array(Auth::user()->role, [
                'admin',
                'manager',
                'coach',
                'player',
            ], true)) {

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Llogaria jote ende nuk eshte aktivizuar.',
                ])->onlyInput('email');

            }

            if (Auth::user()->role === 'admin') {

                return redirect()->intended(
                    route('dashboard')
                );

            }

            $request->session()->forget('url.intended');

            return redirect()->route('dashboard');

        }

        return back()->withErrors([
            'email' => 'Emaili ose fjalekalimi eshte gabim.',
        ])->onlyInput('email');

    })->middleware('throttle:5,1')->name('login.store');

});

// LOGOUT

Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()
        ->route('login')
        ->with('success', 'Ke dale me sukses nga sistemi.');

})->middleware('auth')->name('logout');

// DASHBOARD SIPAS ROLIT

Route::get('/dashboard', function (Request $request) {

    return match ($request->user()->role) {

        'admin' => app()->call([
            app(DashboardController::class),
            'index'
        ]),

        'manager' => redirect()->route('manager.dashboard'),

        'coach' => redirect()->route('coach.dashboard'),

        'player' => redirect()->route('player.dashboard'),

        default => abort(403, 'Llogaria nuk eshte aktive.')

    };

})->middleware('auth')->name('dashboard');

// MENAXHERI

Route::get('/manager/dashboard', function () {

    return view('dashboards.manager');

})->middleware([
    'auth',
    RoleMiddleware::class . ':manager'
])->name('manager.dashboard');

// VOLEJBOLLISTJA

Route::middleware([
    'auth',
    RoleMiddleware::class . ':player'
])->prefix('player')->name('player.')->group(function () {

    Route::get('/dashboard', [
        PlayerDashboardController::class,
        'index'
    ])->name('dashboard');

});

// TRAJNERI

Route::middleware([
    'auth',
    RoleMiddleware::class . ':coach'
])->prefix('coach')->name('coach.')->group(function () {

    // DASHBOARD

    Route::get('/dashboard', [
        CoachDashboardController::class,
        'index'
    ])->name('dashboard');

    // NDESHJET

    Route::get('/ndeshjet', [
        CoachSportController::class,
        'ndeshjet'
    ])->name('ndeshjet');

    Route::get('/ndeshjet/create', [
        CoachMatchController::class,
        'create'
    ])->name('ndeshjet.create');

    Route::post('/ndeshjet', [
        CoachMatchController::class,
        'store'
    ])->name('ndeshjet.store');

    Route::get('/ndeshjet/{ndeshja}/edit', [
        CoachMatchController::class,
        'edit'
    ])->name('ndeshjet.edit');

    Route::put('/ndeshjet/{ndeshja}', [
        CoachMatchController::class,
        'update'
    ])->name('ndeshjet.update');

    // STATISTIKAT INDIVIDUALE

    Route::get('/ndeshjet/{ndeshja}/statistikat', [
        CoachSportController::class,
        'statistikat'
    ])->name('statistikat');

    Route::post('/ndeshjet/{ndeshja}/statistikat', [
        CoachSportController::class,
        'ruajStatistikat'
    ])->name('statistikat.store');

    Route::delete('/ndeshjet/{ndeshja}/statistikat/{statistika}', [
        CoachSportController::class,
        'fshiStatistikat'
    ])->name('statistikat.destroy');

    // PERFORMANCE

    Route::get('/performance', [
        CoachPerformanceController::class,
        'index'
    ])->name('performance');

    // STERVITJET

    Route::get('/stervitjet', [
        CoachTrainingController::class,
        'index'
    ])->name('stervitjet');

    Route::get('/stervitjet/create', [
        CoachTrainingController::class,
        'create'
    ])->name('stervitjet.create');

    Route::post('/stervitjet', [
        CoachTrainingController::class,
        'store'
    ])->name('stervitjet.store');

    Route::get('/stervitjet/{stervitja}/edit', [
        CoachTrainingController::class,
        'edit'
    ])->name('stervitjet.edit');

    Route::put('/stervitjet/{stervitja}', [
        CoachTrainingController::class,
        'update'
    ])->name('stervitjet.update');

    // PREZENCA

    Route::get('/stervitjet/{stervitja}/prezenca', [
        CoachTrainingController::class,
        'prezenca'
    ])->name('prezenca.edit');

    Route::put('/stervitjet/{stervitja}/prezenca', [
        CoachTrainingController::class,
        'ruajPrezencen'
    ])->name('prezenca.update');

});

// ADMINISTRATORI

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin'
])->group(function () {

    // PERDORUESIT

    Route::resource(
        'users',
        UserController::class
    )->except(['show']);

    // TRAJNERET

    Route::resource(
        'trajner',
        TrajnerController::class
    )->except(['show']);

    // VOLEJBOLLISTET

    Route::resource(
        'lojtar',
        LojtarController::class
    );

    // MENAXHERET

    Route::resource(
        'managers',
        ManagerController::class
    );

    // EKIPET

    Route::resource(
        'ekipet',
        EkipiController::class
    )->parameters([
        'ekipet' => 'ekipi'
    ]);

    // NDESHJET

    Route::resource(
        'ndeshjet',
        NdeshjaController::class
    )->parameters([
        'ndeshjet' => 'ndeshja'
    ]);

    // STATISTIKAT

    Route::get('/statistics', [
        StatisticsController::class,
        'index'
    ])->name('statistics.index');

    // STATISTIKAT INDIVIDUALE

    Route::get('/ndeshjet/{ndeshja}/statistikat/create', [
        StatistikaLojtaritController::class,
        'create'
    ])->name('statistikat-lojtareve.create');

    Route::post('/ndeshjet/{ndeshja}/statistikat', [
        StatistikaLojtaritController::class,
        'store'
    ])->name('statistikat-lojtareve.store');

    Route::delete('/ndeshjet/{ndeshja}/statistikat/{statistika}', [
        StatistikaLojtaritController::class,
        'destroy'
    ])->name('statistikat-lojtareve.destroy');

    // PERFORMANCE

    Route::get('/performance', [
        PlayerPerformanceController::class,
        'index'
    ])->name('performance.index');

    // SEZONET

    Route::get('/sezonet', [
        SezoniController::class,
        'index'
    ])->name('sezonet.index');

    Route::post('/sezonet', [
        SezoniController::class,
        'store'
    ])->name('sezonet.store');

    Route::put('/sezonet/{sezoni}', [
        SezoniController::class,
        'update'
    ])->name('sezonet.update');

    Route::delete('/sezonet/{sezoni}', [
        SezoniController::class,
        'destroy'
    ])->name('sezonet.destroy');

    // KLUBET

    Route::resource(
        'klubet',
        KlubiController::class
    )->parameters([
        'klubet' => 'klubi'
    ])->only([
        'index',
        'store',
        'update',
        'destroy'
    ]);

    // KAMPIONATET

    Route::resource(
        'kampionatet',
        KampionatiController::class
    )->parameters([
        'kampionatet' => 'kampionati'
    ])->only([
        'index',
        'store',
        'show',
        'update',
        'destroy'
    ]);

    // LIGA

    Route::get('/kampionatet/{kampionati}/liga', [
        NdeshjaLigesController::class,
        'index'
    ])->name('liga.index');

    Route::post('/kampionatet/{kampionati}/liga', [
        NdeshjaLigesController::class,
        'store'
    ])->name('liga.store');

    Route::put('/kampionatet/{kampionati}/liga/{ndeshja}', [
        NdeshjaLigesController::class,
        'update'
    ])->name('liga.update');

    Route::delete('/kampionatet/{kampionati}/liga/{ndeshja}', [
        NdeshjaLigesController::class,
        'destroy'
    ])->name('liga.destroy');

    // LIDHJA ME LIGEN

    Route::get('/ndeshjet/{ndeshja}/lidh-ligen', [
        NdeshjaLigaSyncController::class,
        'create'
    ])->name('ndeshjet.lidh-ligen');

    Route::post('/ndeshjet/{ndeshja}/lidh-ligen', [
        NdeshjaLigaSyncController::class,
        'store'
    ])->name('ndeshjet.lidh-ligen.store');

    // STERVITJET

    Route::resource(
        'stervitjet',
        StervitjaController::class
    )->parameters([
        'stervitjet' => 'stervitja'
    ]);

    // PREZENCA

    Route::get('/stervitjet/{stervitja}/prezenca', [
        PrezencaController::class,
        'edit'
    ])->name('prezencat.edit');

    Route::put('/stervitjet/{stervitja}/prezenca', [
        PrezencaController::class,
        'update'
    ])->name('prezencat.update');

    Route::get('/lojtar/{lojtar}/prezenca', [
        PrezencaController::class,
        'historiku'
    ])->name('prezencat.historiku');

});
