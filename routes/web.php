<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {return view('dashboard');});
Route::view('/login', 'login');
Route::post('/login', function () {return back()->with('error', 'Invalid credentials');})->name('login.submit');
