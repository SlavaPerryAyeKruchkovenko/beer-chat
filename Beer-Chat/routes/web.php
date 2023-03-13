<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', [RegisterController::class, 'create']) -> name('register');
Route::post('/register',[RegisterController::class, 'store']);
