<?php

namespace App\Http\Controllers;

use App\Events\UserGetByName;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
{
    public function user(string $id): User|null
    {
        return User::where('id', $id)->first();
    }
    public function userByName(string $name = null): string | Collection
    {
        if($name !== null){
            $users = User::where('name', 'LIKE', '%'.$name.'%')->get();
            if(count($users)>0){
                broadcast(new UserGetByName($users));
            }
            return $users;
        }
        return "user not found";
    }
}
