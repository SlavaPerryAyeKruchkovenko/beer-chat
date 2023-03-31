<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
    use App\Http\Controllers\ChatController;
    use App\Http\Controllers\MessengerController;
    use App\Http\Controllers\UserController;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\RegisterController;

    Route::get(
        RouteServiceProvider::HOME,
        function () {
            return view('index');
        }
    );

    Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('guest');
    Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

    Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->middleware('guest')->name(
        'password.request'
    );
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest')->name(
        'password.email'
    );
    Route::get('/user/{id}', [UserController::class, 'user'])->whereNumber('id')->
    middleware('auth')->name('user');

    Route::get('/reset-password', [ResetPasswordController::class, 'create'])->
    middleware('guest')->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->
    middleware('guest')->name('password.update');

    Route::get(RouteServiceProvider::MESSENGER, [MessengerController::class, 'create'])->
    middleware('auth')->name('messenger');

    Route::get("/messages/{chat_id}", [ChatController::class, 'messages'])->
    middleware('auth')->name('chat.messages');

    Route::delete("/message/{message_id}", [ChatController::class, 'delete'])->
    middleware('auth')->name('chat.messages');

    Route::post("/message", [ChatController::class, 'store'])->
    middleware('auth')->name('message.send');




