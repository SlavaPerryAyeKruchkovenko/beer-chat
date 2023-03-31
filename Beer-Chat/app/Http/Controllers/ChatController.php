<?php

    namespace App\Http\Controllers;

    use App\Events\MessageSend;
    use App\Models\Message;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;


    class ChatController extends Controller
    {
        public function messages(string $chat_id)
        {
            return Message::query()
                ->where('chat_id', '=', $chat_id)
                ->with('user')
                ->get();
        }

        public function store(Request $request)
        {
            $request->validate(
                [
                    'message' => ['required', 'string', 'min:1']
                ]
            );

            $message = Message::create(
                [
                    "text" => $request->message,
                    "chat_id" => 1,
                    "user_id" => Auth::id(),
                ]
            );
            $message->user=Auth::user();
            broadcast(new MessageSend($request->user(), $message));
            return $message;
        }
    }
