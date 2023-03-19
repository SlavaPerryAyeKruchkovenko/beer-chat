<?php

use App\Http\Controllers\Auth\LoginController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
Route::get(RouteServiceProvider::HOME, function () {
    return view('index');
});

Route::get('/login', [LoginController::class, 'create']) -> middleware('guest') -> name('login');
Route::post('/login',[LoginController::class, 'store']) -> middleware('guest');
Route::post('logout', [LoginController::class, 'destroy'])-> middleware('auth')->name('logout');

Route::get('/register', [RegisterController::class, 'create']) -> middleware('guest') -> name('register');
Route::post('/register',[RegisterController::class, 'store']) -> middleware('guest');

Route::get('/forgot-password', [ForgotPassword::class, 'create']) -> middleware('guest') -> name('forgot-password');
Route::post('/forgot-password', [ForgotPassword::class, 'change']) -> middleware('guest');

Route::get(RouteServiceProvider::MESSENGER,function () {
    return view('messenger');
})->middleware('auth')->name('messenger');
