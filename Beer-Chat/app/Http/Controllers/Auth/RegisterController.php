<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('auth/register');
    }

    public function store(Request $request){
        $request->validate(
            [
                'name' => ['required', 'string', 'unique:users', 'min:3'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', 'confirmed', 'min:8'],
                'username' => ['string']
            ]
        );

        $user = User::create(
            [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );

        Auth::login($user);

        return redirect()->route('messenger');
    }
}
