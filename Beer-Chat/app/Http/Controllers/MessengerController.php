<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MessengerController extends Controller
{
    public function create(): Factory|View|Application
    {
        $user = auth()->user();
        $url = "https://www.gravatar.com/avatar/" . md5($user->email) .
            "?d=https://ui-avatars.com/api/" .
            $user->username .
            "/128/random";
        return view('messenger', ['user' => $user, 'url' => $url]);
    }
}
