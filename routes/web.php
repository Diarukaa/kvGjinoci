<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::view('/login', 'login');

Route::post('/login', function () {
    return back()->with('error', 'Invalid credentials');
})->name('login');

Route::resource('trajner', TrajnerController::class)
    ->except(['show']);

Route::resource('lojtar', LojtarController::class);

Route::resource('managers', ManagerController::class);

Route::resource('ekipet', EkipiController::class)
    ->parameters(['ekipet' => 'ekipi']);

Route::resource('ndeshjet', NdeshjaController::class)
    ->parameters(['ndeshjet' => 'ndeshja']);

Route::get('/statistics', [StatisticsController::class, 'index'])
    ->name('statistics.index');


Route::get(
    '/ndeshjet/{ndeshja}/statistikat/create',
    [StatistikaLojtaritController::class, 'create']
)->name('statistikat-lojtareve.create');

Route::post(
    '/ndeshjet/{ndeshja}/statistikat',
    [StatistikaLojtaritController::class, 'store']
)->name('statistikat-lojtareve.store');

Route::delete(
    '/ndeshjet/{ndeshja}/statistikat/{statistika}',
    [StatistikaLojtaritController::class, 'destroy']
)->name('statistikat-lojtareve.destroy');

Route::get('/performance', [
    PlayerPerformanceController::class,
    'index'
])->name('performance.index');

Route::get('/sezonet', [SezoniController::class, 'index'])
    ->name('sezonet.index');

Route::post('/sezonet', [SezoniController::class, 'store'])
    ->name('sezonet.store');

Route::put('/sezonet/{sezoni}', [SezoniController::class, 'update'])
    ->name('sezonet.update');

Route::delete('/sezonet/{sezoni}', [SezoniController::class, 'destroy'])
    ->name('sezonet.destroy');


Route::resource('klubet', KlubiController::class)
    ->parameters(['klubet' => 'klubi'])
    ->only(['index', 'store', 'update', 'destroy']);

Route::resource('kampionatet', KampionatiController::class)
    ->parameters(['kampionatet' => 'kampionati'])
    ->only(['index', 'store', 'show', 'update', 'destroy']);

Route::get(
    '/kampionatet/{kampionati}/liga',
    [NdeshjaLigesController::class, 'index']
)->name('liga.index');

Route::post(
    '/kampionatet/{kampionati}/liga',
    [NdeshjaLigesController::class, 'store']
)->name('liga.store');

Route::put(
    '/kampionatet/{kampionati}/liga/{ndeshja}',
    [NdeshjaLigesController::class, 'update']
)->name('liga.update');

Route::delete(
    '/kampionatet/{kampionati}/liga/{ndeshja}',
    [NdeshjaLigesController::class, 'destroy']
)->name('liga.destroy');


Route::get(
    '/ndeshjet/{ndeshja}/lidh-ligen',
    [NdeshjaLigaSyncController::class, 'create']
)->name('ndeshjet.lidh-ligen');

Route::post(
    '/ndeshjet/{ndeshja}/lidh-ligen',
    [NdeshjaLigaSyncController::class, 'store']
)->name('ndeshjet.lidh-ligen.store');
