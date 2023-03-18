<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create(){
        return view('auth/login');
    }

    public function store(Request $request){

        $request->validate([
            'email' => ['required','string','email'],
            'password'=>['required','string'],
        ]);
        if(!Auth::attempt($request->only('email','password'))){
            throw ValidationException::withMessages([
                'email'=> 'These credential don\'t match our records'
            ]);

        }

        return redirect()->intended(RouteServiceProvider::MESSENGER);
    }
}
