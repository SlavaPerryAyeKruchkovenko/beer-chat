<?php

    use App\Broadcasting\ChatChannel;
    use App\Broadcasting\UserChannel;
    use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chat}',ChatChannel::class);
Broadcast::channel('users',UserChannel::class);
