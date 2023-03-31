<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function create(Request $request): Factory|View|Application
    {
        $token = $request->token;
        return view('auth/reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'token' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', 'min:8'],
            ]
        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->fill(
                    [
                        'password' => Hash::make($request->password)
                    ]
                )->save();
            }
        );

        if($status == Password::PASSWORD_RESET){
            return redirect()->route('login')->with('status',trans($status));
        }

        throw ValidationException::withMessages([
            'email'=> trans($status)
        ]);
    }
}
