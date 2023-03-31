<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function user(string $id): User
    {
        return User::where('id', $id)->first();
    }
}
