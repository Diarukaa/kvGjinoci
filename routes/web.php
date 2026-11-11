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

