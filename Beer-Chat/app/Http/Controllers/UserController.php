<?php

namespace App\Http\Controllers;

use App\Events\UserGetByName;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function user(string $id): User|null|string
    {
        try {
            return User::where('id', $id)->first();
        } catch(QueryException $ex) {
            Log::error($ex);
            return "incorect user id";
        } catch(\Exception $ex) {
            Log::error($ex);
            return "user not found";
        }
    }

    public function ban(string $id): string|bool
    {
        try {
            $user = User::where('id', $id)->first();
            $user->messages()->delete();
            $user->chats()->delete();
            return $user->delete();
        } catch(QueryException $ex) {
            Log::error($ex);
            abort(405);
        } catch(\Exception $ex){
            Log::error($ex);
            return "user not found";
        }
        return "user not found";
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
