<?php

    namespace App\Events;

    use App\Models\Chat;
    use App\Models\Message;
    use Illuminate\Broadcasting\Channel;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    class MessageDelete implements ShouldBroadcast
    {
        use Dispatchable;
        use InteractsWithSockets;
        use SerializesModels;

        public Message $message;

        /**
         * Create a new event instance.
         *
         * @param Message $message
         */
        public function __construct(Message $message)
        {
            $this->message = $message;
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
