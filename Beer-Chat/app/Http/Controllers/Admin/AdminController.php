<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\Request;

    class AdminController extends Controller
    {
        public function index(): Factory|View|Application
        {
            $user = auth()->user();
            $url = "https://www.gravatar.com/avatar/" . md5($user->email) .
                "?d=https://ui-avatars.com/api/" .
                $user->username .
                "/128/random";
            return view("admin/index", ['user' => $user, 'url' => $url]);
        }
    }
