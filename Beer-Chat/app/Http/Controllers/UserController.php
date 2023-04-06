<?php

namespace App\Http\Controllers;

use App\Events\UserGetByName;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
{
    public function user(string $id): User|null
    {
        return User::where('id', $id)->first();
    }

    public function ban(string $id)
    {
        $user = User::where('id', $id)->get();
        $user->messages()->delete();
        $user->chats()->delete();
        return $user->delete();
    }

    public function userByName(string $name = null): string|Collection
    {
        if ($name !== null) {
            $users = User::where('name', 'like', '%' . $name . '%')->get();
            if (count($users) > 0) {
                broadcast(new UserGetByName($users));
            }
            return $name;
        }
        return "user not found";
    }
}
