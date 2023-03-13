<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::get('/register', [RegisterController::class, 'create']) -> middleware('guest') -> name('register');
Route::post('/register',[RegisterController::class, 'store']) -> middleware('guest');

Route::get('/messenger',function () {
    return view('messenger');
})->middleware('auth')->name('messenger');
