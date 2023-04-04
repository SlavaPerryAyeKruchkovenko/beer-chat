<?php

    namespace App\Http\Controllers;

    use App\Events\MessageDelete;
    use App\Events\MessageSend;
    use App\Models\Message;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Validation\ValidationException;

    class MessageController extends Controller
    {
        public function getAllMessages(string $chat_id): Collection|array
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
                    'message' => ['required', 'string', 'min:1'],
                    'chat_id' => ['required', 'int', 'min:1'],
                    'user_id' => ['required', 'int', 'min:1']
                ]
            );

            $message = Message::create(
                [
                    "text" => $request->message,
                    "chat_id" => $request->chat_id,
                    "user_id" => $request->user_id,
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
                $res = $message->delete();
                if ($res) {
                    return $message;
                }
            }
            throw ValidationException::withMessages(
                [
                    'message_id' => ['message is not defined'],
                ]
            );
        }
    }
