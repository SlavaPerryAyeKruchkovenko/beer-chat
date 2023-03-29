<?php

namespace App\Http\Controllers;

class MessengerController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $url = "https://www.gravatar.com/avatar/" . md5($user->email) .
            "?d=https://ui-avatars.com/api/" .
            $user->username .
            "/128/random";
        return view('messenger', ['user' => $user, 'url' => $url]);
    }
}
