<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::view('register', 'auth.register');
Route::post('signup', [AuthController::class, 'register']);

Route::view('login', 'auth.login' )->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::resource('author', AuthorController::class);

Auth::routes(['register' => false, 'login' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
