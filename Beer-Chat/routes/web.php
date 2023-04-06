<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
    use App\Http\Controllers\ChatController;
    use App\Http\Controllers\MessageController;
    use App\Http\Controllers\MessengerController;
    use App\Http\Controllers\UserController;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Support\Facades\Route;

    Route::get(
        RouteServiceProvider::HOME,
        function () {
            return view('index');
        }
    );

    Route::get(RouteServiceProvider::MESSENGER, [MessengerController::class, 'create'])->
    middleware('auth')->name('messenger');

    Route::controller("Auth\LoginController")->group(
        function () {
            Route::get('/login', 'create')->middleware('guest')->name('login');
            Route::post('/login', 'store')->middleware('guest');
            Route::post('logout', 'destroy')->middleware('auth')->name('logout');
        }
    );
    Route::controller("Auth\RegisterController")->group(
        function () {
            Route::get('/register', 'create')->middleware('guest')->name('register');
            Route::post('/register', 'store')->middleware('guest');
        }
    );

    Route::controller("Auth\ForgotPasswordController")->group(
        function () {
            Route::get('/forgot-password', 'create')->middleware('guest')->name(
                'password.request'
            );
            Route::post('/forgot-password', 'store')->middleware('guest')->name(
                'password.email'
            );
        }
    );
    Route::prefix("user")->controller("UserController")->group(
        function () {
            Route::get('/{name?}', 'userByName')->middleware('auth')->name(
                'user.name'
            );
            Route::get('/', 'userByName')->middleware('auth')->name(
                'user.name.default'
            );
            Route::get('/id/{id}', 'user')->middleware('auth')->name(
                'user.id'
            );
            Route::delete('/{id}', 'ban')->middleware('auth')->name(
                'user.ban'
            );
        }
    );
    Route::prefix("reset-password")->controller("Auth\ResetPasswordController")->group(
        function () {
            Route::get('/', 'create')->
            middleware('guest')->name('password.reset');
            Route::post('/', 'store')->
            middleware('guest')->name('password.update');
        }
    );
    Route::controller("ChatController")->group(
        function () {
            Route::get('/chats/{user_id}', 'getAllChats')->
            middleware('auth')->name('user.chats');
            Route::post('/chat', 'store')->
            middleware('auth')->name('chat.create');
        }
    );

    Route::controller("MessageController")->group(
        function () {
            Route::delete("/message/{message_id}", 'delete')
                ->middleware('auth')->name('message.delete');

            Route::post("/message", 'store')
                ->middleware('auth')->name('message.send');

            Route::get("/messages/{chat_id}", 'getAllMessages')
                ->middleware('auth')->name('chat.id');
        }
    );

    Route::prefix("admin")->controller("Admin\AdminController")->group(
        function () {
            Route::get('/', 'index')->
            middleware(['auth','admin'])->name('admin.index');
        }
    );

