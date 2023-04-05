<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return string
     */
    public function handle(Request $request, Closure $next)
    {

        $user = User::where('id',Auth::user()->id)->with('role')->first();
        if ($user->role_id !== 2) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
