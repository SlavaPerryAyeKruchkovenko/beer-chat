<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Administrator extends  Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @return string
     */
    protected function redirectTo($request): string
    {
        $user = Auth::user()->with('role');
        dd($user);
        if ($user) {
            return route('login');
        }
    }
}
