<?php

    namespace App\Broadcasting;

    use App\Models\User;
    use Illuminate\Support\Facades\Auth;

    class UserChannel
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
         * @return bool
         */
        public function join(User $user): bool
        {
            return Auth::id() === $user->id;
        }
    }
