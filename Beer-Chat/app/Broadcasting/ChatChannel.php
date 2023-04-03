<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param User $user
     * @param string $chat
     * @return bool
     */
    public function join(User $user, string $chat) : bool
    {
        Auth::id() === $user->id;
        return true;
    }
}
