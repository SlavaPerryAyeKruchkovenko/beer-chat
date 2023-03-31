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
     * @return array|bool
     */
    public function join(User $user)
    {
        Auth::id() === $user->id;
        return true;
    }
}
