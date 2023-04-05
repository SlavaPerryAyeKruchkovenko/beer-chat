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
    use App\Http\Controllers\Auth\RegisterController;

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
    Route::controller("Auth\RegisterController")->middleware('guest')->group(
        function () {
            Route::get('/register', 'create')->name('register');
            Route::post('/register', 'store');
        }
    );

    Route::controller("Auth\ForgotPasswordController")->name('password.')->middleware('guest')->group(
        function () {
            Route::get('/forgot-password', 'create')->name(
                'request'
            );
            Route::post('/forgot-password', 'store')->name(
                'email'
            );
        }
    );
    Route::prefix("user")->name("user.")->
    controller("UserController")->middleware('auth')->
    group(
        function () {
            Route::get('/{name?}', 'userByName')->name(
                'name'
            );
            Route::get('/', 'userByName')->name(
                'name.default'
            );
        }
    );
    Route::prefix("reset-password")->controller("Auth\ResetPasswordController")->
    middleware('guest')->group(
        function () {
            Route::get('/', 'create')->name('password.reset');
            Route::post('/', 'store')->name('password.update');
        }
    );
    Route::controller("ChatController")->
    middleware('auth')->group(
        function () {
            Route::get('/chats/{user_id}', 'getAllChats')->name('user.chats');
            Route::post('/chat', 'store')->name('chat.create');
        }
    );

    Route::controller("MessageController")->
    middleware('auth')->group(
        function () {
            Route::delete("/message/{message_id}", 'delete')->name('message.delete');

            Route::post("/message", 'store')->name('message.send');

            Route::get("/messages/{chat_id}", 'getAllMessages')->name('chat.id');
        }
    );

    Route::prefix("admin")->controller("Admin\AdminController")->name("admin.")->
    middleware('admin')->group(
        function () {
            Route::get('/', 'index')->name('index');
        }
    );

