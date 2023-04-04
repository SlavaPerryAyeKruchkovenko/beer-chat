<?php

    namespace App\Events;

    use App\Models\Chat;
    use App\Models\Message;
    use App\Models\User;
    use Illuminate\Broadcasting\Channel;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PresenceChannel;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Support\Facades\Log;
    use Symfony\Component\Console\Output\ConsoleOutput;

    class MessageSend implements ShouldBroadcast
    {
        use Dispatchable;
        use InteractsWithSockets;
        use SerializesModels;

        public User $user;
        public Message $message;

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
         * Check translate.
         *
         * @return bool
         */
        public function broadcastWhen(): bool
        {
            $chat = Chat::where("id",$this->message->chat_id)->first();
            return $chat->first_user_id === $this->user->id || $chat->second_user_id === $this->user->id;
        }
        /**
         * Get the channels the event should broadcast on.
         *
         * @return Channel|PrivateChannel|array
         */
        public function broadcastOn(): Channel|PrivateChannel|array
        {
            $chat = Chat::where("id",$this->message->chat_id)->first();
            return new PrivateChannel('chat.'.$chat->id);
        }
    }
