<?php

    namespace App\Events;

    use Illuminate\Broadcasting\Channel;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PresenceChannel;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    class UserGetByName implements ShouldBroadcast
    {
        use Dispatchable;
        use InteractsWithSockets;
        use SerializesModels;
        public Collection $users;
        /**
         * Create a new event instance.
         *
         * @param $users
         */
        public function __construct(Collection  $users)
        {
            $this->users=$users;
        }

        /**
         * Get the channels the event should broadcast on.
         *
         * @return Channel|PrivateChannel|array
         */
        public function broadcastOn(): Channel|PrivateChannel|array
        {
            return new PrivateChannel('users');
        }
    }
