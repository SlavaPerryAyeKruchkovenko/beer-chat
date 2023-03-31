<?php

    namespace App\Events;

    use App\Models\Message;
    use App\Models\User;
    use Illuminate\Broadcasting\Channel;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PresenceChannel;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    class MessageSend implements ShouldBroadcast
    {
        use Dispatchable;
        use InteractsWithSockets;
        use SerializesModels;

        public $user;
        public $message;

        /**
         * Create a new event instance.
         *
         * @param User $user
         * @param Message $message
         */
        public function __construct(User $user, Message $message)
        {
            $this->user = $user;
            $this->message = $message;
        }

        /**
         * Get the channels the event should broadcast on.
         *
         * @return Channel|PrivateChannel|array
         */
        public function broadcastOn(): Channel|PrivateChannel|array
        {
            return new PrivateChannel('chat');
        }
    }
