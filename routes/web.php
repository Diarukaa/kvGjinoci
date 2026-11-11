
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrajnerController;
use App\Http\Controllers\LojtarController;
use App\Http\Controllers\ManagerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::view('/login', 'login');

Route::post('/login', function () {
    return back()->with('error', 'Invalid credentials');
})->name('login');

Route::resource('trajner', TrajnerController::class)
    ->except(['show']);

Route::resource('lojtar', LojtarController::class);

Route::resource('managers', ManagerController::class);
