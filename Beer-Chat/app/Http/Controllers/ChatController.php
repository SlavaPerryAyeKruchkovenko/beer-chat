<?php

    namespace App\Http\Controllers;

    use App\Events\MessageDelete;
    use App\Events\MessageSend;
    use App\Models\Message;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Validation\ValidationException;


    class ChatController extends Controller
    {
        public function messages(string $chat_id): Collection|array
        {
            return Message::query()
                ->where('chat_id', '=', $chat_id)
                ->with('user')
                ->get();
        }

        public function store(Request $request): Message
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
            $message->user = Auth::user();
            broadcast(new MessageSend($request->user(), $message));
            return $message;
        }

        public function delete(string $message_id)
        {
            $message = Message::where('id', $message_id)->first();
            if ($message !== null) {
                broadcast(new MessageDelete($message));
                return $message;
            }
            throw ValidationException::withMessages(
                [
                    'message_id' => ['message is not defined'],
                ]
            );
        }
    }
