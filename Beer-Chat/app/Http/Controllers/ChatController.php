<?php

    namespace App\Http\Controllers;

    use App\Events\MessageSend;
    use App\Models\Message;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;


    class ChatController extends Controller
    {
        public function messages()
        {
            return Message::query()
                ->with('users')
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
                    "chat_id" => 0,
                    "user_id" => Auth::id(),
                ]
            );

            broadcast(new MessageSend($request->user(), $message));
            return $message;
        }
    }
