<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function create():Factory|View|Application
    {
        return view('auth/forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'email' => ['required', 'string', 'email'],
            ]
        );

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', trans($status));
        }
        return back()->withInput($request->only('email'))
            ->withErrors(['email'=> trans($status)]);
    }
}
